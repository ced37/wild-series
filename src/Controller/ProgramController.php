<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use App\Entity\Program;

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
     * Correspond à la route /programs/show et au name "program_show"

     * @Route("/{id<\d+>}", methods={"GET"}, name="show")

     */
    public function show(int $id): Response
    {
        return $this->render('program/show.html.twig', ['id' => $id]);
    }


}