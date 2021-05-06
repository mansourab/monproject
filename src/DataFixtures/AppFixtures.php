<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 30; $i++) {
            $item= new Item();
            $item->setTitle('Mon titre ' .$i);
            $item->setDescription('Description de mon article ' .$i);

            $manager->persist($item);

            for ($c = 0; $c < 4; $i++) {
                $category = new Category();
                $category->setName('Nom de la category ' .$c);
                $category->setItem($item);

                $manager->persist($category);
            }
        }

        $manager->flush();
    }

}
