<?php

// src/Controller/ProgramController.php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;


/**

* @Route("/programs", name="program_")

*/
class ProgramController extends AbstractController

{
    /**

      * Correspond à la route /programs/ et au name "program_index"

      * @Route("/", name="index")

      */
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Séries',
         ]);
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