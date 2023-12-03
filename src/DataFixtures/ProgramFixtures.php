<?php

namespace App\DataFixtures;

use function Symfony\Component\String\u;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Program;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const DATAS = [
        ['The last of Us', 'The title takes place in a post-apocalyptic universe after a pandemic caused by a fungus, cordyceps, which takes control of its human hosts. The two main characters are named Joel and Ellie and must survive together as they travel across the ruined United States.', 'category_Aventure'],
        ['Walking dead', 'The story follows the character of Rick Grimes (played by Andrew Lincoln), a sheriff\'s deputy in Kings County (Georgia). He wakes up from a coma of several weeks to discover that the population has been ravaged by an unknown epidemic that transforms human beings into undead, called "walkers".', 'category_Action'],
        ['The Boys', 'In a fictional world where superheroes have allowed themselves to be corrupted by fame and glory and have little by little revealed the dark side of their personalities, a team of vigilantes who call themselves "The Boys" decide to move on to action and take down these once beloved superheroes.', 'category_Action'],
        ['The Rings of Power', 'The series will focus on the creation of the Rings of Power forged by the Elf Celebrimbor, on that of the One Ring by Sauron, on the wars opposing the latter to the alliance of Elves, Men and Dwarves, and will interest the legendary kingdom of Númenor, on the island of Ouistrenesse.', 'category_Fantastique'],
        ['D\'argent et de sang', 'At least two billion euros embezzled under the nose of the State on the back of environmental rights and casino capitalism. It was ten years ago. But after the epiphany of money came the decadence of blood. A mysterious epidemic of assassinations has struck Paris and its surrounding areas.', 'category_Action'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DATAS as $data) {
            $program = new Program();
            $program->setTitle($data[0]);
            $program->setSynopsis($data[1]);
            $program->setCategory($this->getReference($data[2]));
            $manager->persist($program);
            $this->addReference('program_' . u($data[0])->replace(' ', '_'), $program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
