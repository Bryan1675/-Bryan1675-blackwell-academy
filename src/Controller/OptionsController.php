<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OptionsController extends AbstractController
{
    /**
     * @Route("/options", name="options")
     */
    public function index()
    {
        return $this->render('options/index.html.twig', [
            'controller_name' => 'OptionsController',
            'pageName' => "Les options",
        ]);
    }
}
