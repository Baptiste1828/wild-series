<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const DATAS = [
        [2023, 'First saison of The Last of Us', 'The_last_of_Us'],
        [2010, 'First saison of Walking dead', 'Walking_dead'],
        [2019, 'First saison of The Boys', 'The_Boys'],
        [2022, 'First saison of The Rings of Power', 'The_Rings_of_Power'],
        [2023, 'First saison of D\'argent et de sang', 'D\'argent_et_de_sang'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DATAS as $data) {
            $season = new Season();
            $season->setNumber(1);
            $season->setYear($data[0]);
            $season->setDescription($data[1]);
            $season->setProgram($this->getReference('program_' . $data[2]));
            $manager->persist($season);
            $this->addReference('saison1_' . $data[2], $season);
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
