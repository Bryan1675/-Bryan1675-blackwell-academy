<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DirecteurController extends AbstractController
{
    /**
     * @Route("/mot-directeur", name="directeur")
     */
    public function index()
    {
        return $this->render('directeur/index.html.twig', [
            'controller_name' => 'DirecteurController', 
            'pageName' => "Mot du directeur",       
        ]);
    }
}
