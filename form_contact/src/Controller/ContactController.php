<?php
namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @Route("/", name="index")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();
            //echo "email: ".$contactFormData['email'];

            $message = (new Email())
                ->from($contactFormData['email'])
                ->to('thibaud.code.test@gmail.com')
                ->subject('You got mail')
                ->text('Sender : '.$contactFormData['email'].\PHP_EOL.
                    $contactFormData['message'],
                    'text/plain');
            //print_r($message);

            try{
                $mailer->send($message);
                $this->addFlash('success', 'Your message has been sent');

                return $this->redirectToRoute('contact');
            }
            catch(\Exception $e){
                $this->addFlash('error', 'Your message can\'t be send : '.$e->getMessage());
                error_log($e->getMessage());
            }




        }



        return $this->render('contact/index.html.twig', [
            'our_form' => $form->createView()
        ]);
    }

}