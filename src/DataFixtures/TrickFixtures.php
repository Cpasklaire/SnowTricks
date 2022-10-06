<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Trick;
use App\Entity\Media;
use App\Entity\Comment;


class TrickFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for($i = 1; $i <=5; $i++){
            $trick = new Trick();
            $trick->setName("trick$i")
            ->setSlug("trick$i")
            ->setContent("plein d'écriture")
            ->setCreatedAte(new \DateTime())
            ->setUpDating(new \DateTime())
            ->setCategory("2");
            //->addMedium($medium)
            //->addComments($comments);

            $manager->persist($trick);

            for($j = 1; $j <=5; $j++){
                $media = new Media();
                $media->setUrl("www.hello.fr")
                ->setType("0")
                ->setCreatedAte(new \DateTime())
                ->setUpDating(new \DateTime())
                ->setTrickRelation($trick);

                $manager->persist($media);
            }

            for($k = 1; $k <=5; $k++){
                $comment = new Comment();
                $comment->setContent("lalalalala")
                ->setCreatedAte(new \DateTime())
                ->setTrickRelation($trick);

                $manager->persist($comment);
            }


        }

        $manager->flush();
    }
}
