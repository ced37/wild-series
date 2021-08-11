<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture
{
    public const PROGRAMS = [
        'Les dents de la mer',
        'Avengers',
        'Desesperate housewifes',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $key => $programTitle) {
            $program = new Program();
            $program->setTitle($programTitle);
            $manager->persist($program);
            $this->addReference('program_' . $key, $program);
        }
        $manager->flush();
    }
}
