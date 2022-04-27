<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VisiteController extends AbstractController
{
    /**
     * @Route("/visite", name="visite")
     */
    public function index()
    {
        return $this->render('visite/index.html.twig', [
            'controller_name' => 'VisiteController',
            'pageName' => "Visiter l'établissement",
        ]);
    }
}
