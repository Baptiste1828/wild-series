<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const DATAS = [
        'The_last_of_Us',
        'Walking_dead',
        'The_Boys',
        'The_Rings_of_Power',
        'D\'argent_et_de_sang',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create();

        foreach (self::DATAS as $data) {
            for ($i = 1; $i < 6; $i++) {
                $season = new Season();
                $season->setNumber($i);
                $season->setYear($faker->year());
                $season->setDescription($faker->text());
                $season->setProgram($this->getReference('program_' . $data));
                $manager->persist($season);
                $this->addReference('saison' . $i . '_' . $data, $season);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
