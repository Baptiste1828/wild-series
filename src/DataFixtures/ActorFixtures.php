<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use function Symfony\Component\String\u;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const DATAS = [
        'program_The_last_of_Us',
        'program_Walking_dead',
        'program_The_Boys',
        'program_The_Rings_of_Power',
        'program_D\'argent_et_de_sang',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create();
        for ($actorNumber = 0; $actorNumber < 10; $actorNumber++) {
            $actor = new Actor();
            $actor->setName($faker->name());
            $this->addReference('actor_' . u($actor->getName())->replace(' ', '_'), $actor);
            for ($i = 0; $i < 3; $i++) {
                $actor->addProgram($this->getReference(self::DATAS[rand(0, 4)]));
            }
            $manager->persist($actor);
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
