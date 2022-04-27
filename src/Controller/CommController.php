<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Commentaires;

class CommController extends AbstractController
{
    /**
     * @Route("/commentaires", name="commentaires")
     * 
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $repo = $this->getDoctrine()->getRepository(Commentaires::class);

        $commentaire = new Commentaires();
        $form = $this->createFormBuilder($commentaire)
                ->add("UserName", TextType::class)
                ->add('CommContent', TextareaType::class)
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $commentaire->setCreatedAt(new \Datetime());

            $entityManager->persist($commentaire);
            $entityManager->flush();

            $this->addflash('success', 'Votre commentaire a été ajouté.' );
            return $this->redirect('#commentaires');
           


        }

        $comm = $repo->findBy([], ['createdAt'=> 'DESC']);

        return $this->render('comm/index.html.twig', [
            'controller_name' => 'CommController',
            'pageName' => "Commentaires",
            'commentaires' => $comm,
            'formComm'=>$form->createView()
        ]);
    }
}
