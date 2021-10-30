<?php

namespace App\Controller;

use App\Entity\Chalet;
use App\Form\ChaletType;
use App\Service\FileUploader;
use App\Repository\ChaletRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChaletController extends AbstractController
{

    /**
     * @Route("/chalets/new", name="chalets_new")
     */
    public function create(Request $request, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {
        $chalet = new Chalet;
        $form = $this->createForm(ChaletType::class, $chalet);



        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('coverImage')->getData();
            if ($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $chalet->setCoverImage($imageFileName);
            }

            foreach ($chalet->getPictures() as $picture) {
                $fileName = $fileUploader->upload($picture->getFile());
                $picture->setUrl($fileName);
                $picture->setChalet($chalet);

                $em->persist($picture);
            }

            $em->persist($chalet);
            $em->flush();

            $this->addFlash(
                'success',
                "Le chalet a bien été enregistré !"
            );

            return $this->redirectToRoute('chalets_show', [
                'slug' => $chalet->getSlug()
            ]);
        }
        return $this->render('chalet/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/chalets/{id}/edit", name = "chalet_edit")
     *
     * @param [type] $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function edit($id, Request $request, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {
        $chalet = $em->find(Chalet::class, $id);
        $form = $this->createForm(ChaletType::class, $chalet);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('coverImage')->getData();

            if ($imageFile) {
                $fileUploader->removeFile($chalet->getCoverImage());
                $imageFileName = $fileUploader->upload($imageFile);
                $chalet->setCoverImage($imageFileName);
            }

            foreach ($chalet->getPictures() as $picture) {
                $file = $picture->getFile();
                if ($file) {
                    if ($picture->getUrl()) {
                        $fileUploader->removeFile($picture->getUrl());
                    }
                    $fileName = $fileUploader->upload($picture->getFile());
                    $picture->setUrl($fileName);
                    $picture->setChalet($chalet);

                    $em->persist($picture);
                }
            }




            $em->persist($chalet);
            $em->flush();

            $this->addFlash(
                'success',
                "Le chalet a bien été modifié !"
            );

            return $this->redirectToRoute('chalets_show', [
                'slug' => $chalet->getSlug()
            ]);
        }
        return $this->render('chalet/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }



    /**
     * @Route("/chalets", name="chalets_index")
     */
    public function index(ChaletRepository $chaletRepository): Response
    {
        $chalets = $chaletRepository->findAll();

        return $this->render('chalet/index.html.twig', [
            'chalets' => $chalets
        ]);
    }


    /**
     * @Route("/chalets/{slug}", name="chalets_show")
     */
    public function show(Chalet $chalet): Response
    {
        return $this->render('chalet/show.html.twig', [
            'chalet' => $chalet
        ]);
    }
}
