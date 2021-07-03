<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 
 * @Route("/programs", name="program_")
 */
class ProgramController extends AbstractController

{
    /**
      * Show all rows from Program's entity
      *
      * @Route("/", name="index")
      * @return Response A response instance
      */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render(
            'program/index.html.twig', ['programs' => $programs]);
    }

    /**
     * Getting a program by id

     * @Route("/show/{id}", name="show")
     * @return Response
     */
    public function show(Program $program, SeasonRepository $seasonRepository): Response
    {
        $seasons = $seasonRepository->findby(['program' => $program]);

        if (!$program) {

            throw $this->createNotFoundException(
                'No program with id : '.$program.' found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', ['program' => $program, 'seasons' => $seasons]);
    }

    /**
     * Getting a season by id

     * @Route("/{programId}/seasons/{seasonId}", name="season_show")
     * @return Response
     */
    public function showSeason(Program $programId, Season $seasonId): Response
    {
        $program = $this->getDoctrine()
        ->getRepository(Program::class)
        ->find($programId);

        $season = $this->getDoctrine()
        ->getRepository(Season::class)
        ->find($seasonId);

        $episodes = $this->getDoctrine()
        ->getRepository(Episode::class)
        ->findAll();

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes
        ]);
    }

    /**
     * Getting a episode by id

     * @Route("/{programId}/seasons/{seasonId}/episodes/{episodeId}", name="episode_show")
     * @return Response
     */
    public function showEpisode(Program $programId, Season $seasonId, Episode $episodeId): Response
    {
        $program = $this->getDoctrine()
        ->getRepository(Program::class)
        ->find($programId);

        $season = $this->getDoctrine()
        ->getRepository(Season::class)
        ->find($seasonId);

        $episode = $this->getDoctrine()
        ->getRepository(Episode::class)
        ->find($episodeId);

        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episode,
          ]);
    }
}