<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const DATAS = [
        'Action',
        'Aventure',
        'Animation',
        'Fantastique',
        'Horreur',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DATAS as $data) {
            $category = new Category();
            $category->setName($data);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
