<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Symfony\Component\String\Slugger\SluggerInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create();

        foreach (SeasonFixtures::DATAS as $data) {
            for ($i = 1; $i < 6; $i++) {
                for ($episodeNumber = 1; $episodeNumber < 11; $episodeNumber++) {
                    $episode = new Episode();
                    $episode->setNumber($episodeNumber);
                    $episode->setTitle($faker->word());
                    $episode->setSynopsis($faker->paragraphs(2, true));
                    $episode->setDuration($faker->numberBetween(50, 80));
                    $episode->setSlug($this->slugger->slug($episode->getTitle()));
                    $episode->setSeason($this->getReference('saison' . $i . '_' . $data));
                    $manager->persist($episode);
                }
            }
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
