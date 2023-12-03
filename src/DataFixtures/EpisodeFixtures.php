<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const DATAS = [
        [1,'Quand vous êtes perdu dans l\'obscurité','Synopsis saison 1 épisode 1', 'saison1_The_last_of_Us'],
        [2,'Infectés','Synopsis saison 1 épisode 2', 'saison1_The_last_of_Us'],
        [3,'Pour l\'éternité','Synopsis saison 1 épisode 3', 'saison1_The_last_of_Us'],
        [1,'Passé décomposé','Synopsis saison 1 épisode 1', 'saison1_Walking_dead'],
        [2,'Tripes','Synopsis saison 1 épisode 2', 'saison1_Walking_dead'],
        [3,'T\'as qu\'à discuter avec les grenouilles','Synopsis saison 1 épisode 3', 'saison1_Walking_dead'],
        [1,'La Règle du jeu','Synopsis saison 1 épisode 1', 'saison1_The_Boys'],
        [2,'Cerise','Synopsis saison 1 épisode 2', 'saison1_The_Boys'],
        [3,'Prends ça','Synopsis saison 1 épisode 3', 'saison1_The_Boys'],
        [1,'L\'Ombre du passé','Synopsis saison 1 épisode 1', 'saison1_The_Rings_of_Power'],
        [2,'À la dérive','Synopsis saison 1 épisode 2', 'saison1_The_Rings_of_Power'],
        [3,'Adar','Synopsis saison 1 épisode 3', 'saison1_The_Rings_of_Power'],
        [1,'Fitoussi','Synopsis saison 1 épisode 1', 'saison1_D\'argent_et_de_sang'],
        [2,'Borderline','Synopsis saison 1 épisode 2', 'saison1_D\'argent_et_de_sang'],
        [3,'Numéro 26','Synopsis saison 1 épisode 3', 'saison1_D\'argent_et_de_sang'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DATAS as $data) {
            $episode = new Episode();
            $episode->setNumber($data[0]);
            $episode->setTitle($data[1]);
            $episode->setSynopsis($data[2]);
            $episode->setSeason($this->getReference($data[3]));
            $manager->persist($episode);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
