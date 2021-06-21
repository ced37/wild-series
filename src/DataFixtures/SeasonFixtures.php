<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture
{
    public const SEASONS = [
        'saison 1',
        'saison 2',
        'saison 3',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $key => $seasonNumber) {
            $season = new Season();
            $season->setNumber($seasonNumber);
            $manager->persist($season);
            $this->addReference('season_' . $key, $season);
        }
        $manager->flush();
    }
}
