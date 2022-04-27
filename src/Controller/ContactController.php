<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\ContactType;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();

            //print_r($contactFormData);
            //echo ' bonjour ';

            if (isset($contactFormData['g-recaptcha-response'])) {
                //print_r($contactFormData['g-recaptcha-response']);

                $url = 'https://www.google.com/recaptcha/api/siteverify';

                //The data you want to send via POST
                $fields = [
                    'secret' => 'SecretToken',
                    'response' => $contactFormData['g-recaptcha-response']
                ];
                //url-ify the data for the POST
                $fields_string = http_build_query($fields);

                //open connection
                $ch = curl_init();

                //set the url, number of POST vars, POST data
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

                //So that curl_exec returns the contents of the cURL; rather than echoing it
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                echo ' bonjour2 ';
                //execute post
                $result = curl_exec($ch);

                //print_r($result);
                if (isset($result) && $result["success"]) {
                    echo ' bonjour3 ';

                    $message = (new \Swift_Message('Noveau message : Blackwell Academy'))
                        ->setFrom($contactFormData['email'])
                        ->setTo('bosseb6@gmail.com')

                        ->setBody(

                            $this->renderView(
                                'contact/email.html.twig',
                                [
                                    'name' => $contactFormData['nom'],
                                    'mail' => $contactFormData['email'],
                                    'objet' => $contactFormData['objet'],
                                    'messageContent' => $contactFormData['message'],
                                ]
                            ),
                            'text/html'

                        );
                    $mailer->send($message);

                    $this->addflash('success', 'Votre message a été envoyé.');
                    return $this->redirectToRoute('contact');
                }
            }
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'pageName' => "Contact",
            'our_form' => $form->createView(),
        ]);
    }
}
