<?php

namespace App\Controller;

use App\Repository\ChaletRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(ChaletRepository $chaletRepository): Response
    {
        $chalets = $chaletRepository->findBy([], [], 3);
        return $this->render('home/index.html.twig', [
            'chalets' => $chalets
        ]);
    }
}
