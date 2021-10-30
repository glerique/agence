<?php

namespace App\Doctrine\Listener;

use App\Entity\Chalet;
use Symfony\Component\String\Slugger\SluggerInterface;

class ChaletSlugListener
{

    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {

        $this->slugger = $slugger;
    }

    public function prePersist(Chalet $entity)
    {
        if (empty($entity->getSlug())) {
            $entity->setSlug(strtolower($this->slugger->slug($entity->getName())));
        }
    }
}
