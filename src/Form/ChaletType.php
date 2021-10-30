<?php

namespace App\Form;

use App\Entity\Chalet;
use App\Form\PictureType;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ChaletType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->getConfiguration('Nom du chalet :', 'Nom du chalet'))
            ->add('description', TextareaType::class, $this->getConfiguration('Description du chalet :', 'Description du chalet'))

            ->add('coverImage', FileType::class,  [
                'label' => 'Image de couverture :',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Image de couverture'
                ],
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader une image jpeg ou png',
                    ])
                ]
            ])
            ->add('bedrooms', IntegerType::class, $this->getConfiguration('Nombre de chambre :', 'Nombre de chambre'))
            ->add('bathrooms', IntegerType::class, $this->getConfiguration('Nombre de salles de baim :', 'Nombre de salles de baim'))
            ->add('price', MoneyType::class, $this->getConfiguration('Prix de la location', 'Prix de la location'))
            ->add(
                'pictures',
                CollectionType::class,
                [
                    'entry_type' => PictureType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'label' => 'Ajoutez les images du chalet :'

                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chalet::class,
        ]);
    }
}
