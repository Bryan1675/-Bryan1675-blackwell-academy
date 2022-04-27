<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $tabImg = [ 
            "Neige", "Grele", "Brouillard", "Nuage", "Nuage+", "Nuage++pluie", "Nuage+Soleil",
            "Nuage+Soleil+pluie", "Orage", "Pluie", "Pluie", "Soleil"];
    
            $rdmMeteo = mt_rand(0, count($tabImg)-1);
            $meteo = $tabImg[$rdmMeteo];
    
            switch ($rdmMeteo) {
            
                //Neige
                case 0:
                $temp =  rand(-5 , 0);
                break;
                //Grêle
                case 1:
                $temp =  rand(0 , 5);
                break;
                //Brouillard
                case 2:
                $temp =  rand(0 , 10);
                break;
                //Nuage
                case 3:
                $temp =  rand(0 , 15);
                break;
                //Nuage+
                case 4:
                $temp =  rand(5 , 25);
                break;
                //Nuage++pluie
                case 5:
                $temp =  rand(5 , 25);
                break;
                //Nuage+Soleil
                case 6:
                $temp = rand(7 , 25);
                break;
                //Nuage+Soleil+pluie
                case 7:
                $temp = rand(0 , 25);
                break;
                //Orage
                case 8:
                $temp = rand(25 , 35);
                break;
                //Pluie
                case 9:
                $temp = rand(1 , 20);
                break;
                //Pluie+
                case 10:
                $temp = rand(1 , 25);
                break;
                //Soleil
                case 11:
                $temp = rand(-5 , 35);
                break;
                
            }
    
            return $this->render('index/index.html.twig', [
                'controller_name' => 'IndexController', 
                'meteo' => $meteo,
                'temperature' => $temp, 
                'pageName' => "Accueil",
            ]);
    }
}
