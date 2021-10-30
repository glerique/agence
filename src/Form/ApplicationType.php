<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;



class ApplicationType extends AbstractType
{


    /**
     * Configuration des champs du formulaire
     * @param string $label
     * @param string $placeholder
     * 
     */

    protected function getConfiguration($label, $placeholder)
    {
        return
            [
                'label' => $label,
                'attr' => [
                    'placeholder' => $placeholder
                ]
            ];
    }
}
