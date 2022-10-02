<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Trick;

class TrickFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <=4; $i++){
            $trick = new Trick();
            $trick->setName("Trick $i")
            ->setSlug("trick$i")
            ->setContent("Plein 'écriture")
            ->setCreatedAte(new \DateTime())
            ->setUpDating(new \DateTime())
            ->setAuthor("Moi")
            ->setAuthorUp("")
            ->setCategory("$i");

            $manager->persist($trick);
        }

        $manager->flush();
    }
}
