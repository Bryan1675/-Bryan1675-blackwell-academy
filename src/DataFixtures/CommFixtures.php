<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Commentaires;

class CommFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i=0; $i <=5; $i++) { 
            $commentaire = new Commentaires();
            $commentaire ->setUserName("personne n°$i")
                        ->setCommContent("Commentaire de la personne $i")
                        ->setCreatedAt(new \DateTime());

                        $manager->persist($commentaire);
        }

        

        $manager->flush();
    }
}
