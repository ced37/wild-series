<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= 50; $i++) {
            $season = new Season();
            $season->setDescription('Season : '.rand(0, 5));
            $season->setYear(rand(2009, 2020));
            $season->setNumber(rand(0, 5));
            $this->addReference('season_' . $i, $season);
            $season->setProgram($this->getReference('program_'.rand(0, 5)));
            $manager->persist($season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ActorFixtures::class,
          CategoryFixtures::class,
          ProgramFixtures::class,
        ];
    }
}
