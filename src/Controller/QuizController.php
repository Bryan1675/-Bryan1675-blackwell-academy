<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;


use App\Entity\Questions;
use App\Entity\Reponses;

use App\Form\QuizFormType;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="quiz")
     */
    public function index(Request $request)
    {
        $repoQuest = $this->getDoctrine()->getRepository(Questions::class);
        $questions = $repoQuest->findAll([]);

        $repoRep = $this->getDoctrine()->getRepository(Reponses::class);
        $reponses = $repoRep->findBy([]);

        $bonneReponses = [
            "Le 7 octobre 2013", "Blanc", "Une plante", "Il dessine", "4 fois",
            "La biche", "Mark Jefferson", "Pompidou", "Au diner où Joyce le servait", "2 (deux)",
            "A la piscine de l'universitée", "San Francisco", "Deux lunes", "Les Bigfoots", "David Madsen",
        ];
        
        $form = $this->createForm(QuizFormType::class);
        $form ->handleRequest($request);

        

        if ($form->isSubmitted() && $form->isValid()) {

            $userRep = [];

            for ($i=1; $i < 16 ; $i++) {
                array_push($userRep,$_POST[$i]);
        }

        $note =  count(array_intersect($userRep, $bonneReponses));
        
        return $this->render('quiz/result.html.twig', [
            'pageName' => "Résultats quiz",
            'questions' => $questions,
            'note' => $note,
            'userRep' => $userRep,
            'bonneReponses' => $bonneReponses,
            ]);
        }
        
        return $this->render('quiz/index.html.twig', [
            'controller_name' => 'QuizController',
            'pageName' => "Quiz",
            'questions' => $questions,
            'reponses' => $reponses,
            'quizForm' => $form->createView(),
            ]);
        }
        
        
    }
    