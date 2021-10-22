<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Service\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= 150; $i++) {
            $episode = new Episode();
            $slugify = new Slugify();
            $episode->setSeason($this->getReference('season_' . rand(0, 50)));
            $episode->setTitle('Super épisode !');
            $episode->setNumber(rand(0, 5));
            $episode->setSynopsis('Voir les résumés sur internet...');
            $slug = $slugify->generate($episode->getTitle());
            $episode->setSlug($slug);
            $manager->persist($episode);
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
          SeasonFixtures::class,
        ];
    }
}
