<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

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
            $contactFormData['message'] = <<<EOT
            Sender : {$contactFormData['email']}.
            Reason : {$contactFormData['reason']}.
            Message : {$contactFormData['message']}
            Signature : {$contactFormData['fullName']} || Phone number : {$contactFormData['phone']}
EOT;

            $message = (new Email())
                ->from($contactFormData['email'])
                ->to('thibaud.code.test@gmail.com')
                ->subject($contactFormData['subject'])
                ->text($contactFormData['message'],
                    'text/plain');
            print_r($message);

            try{
                $mailer->send($message);
                $this->addFlash('success', 'Your message has been sent');
                // self::createProduct($contactFormData); envoie de mail impossile donc pas d'insert pour le test je mets après
                //return $this->redirectToRoute('contact');
            }
            catch(\Exception $e){
                $this->addFlash('error', 'Your message can\'t be send : '.$e->getMessage());
                error_log($e->getMessage());
            }
            self::createProduct($contactFormData);

        }
        return $this->render('contact/index.html.twig', [
            'our_form' => $form->createView()
        ]);
    }

    private function createProduct($contactFormData): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Contact();
        $product->setName($contactFormData['fullName']);
        $product->setPhone($contactFormData['phone']);
        $product->setEmail($contactFormData['email']);
        $product->setSubject($contactFormData['subject']);
        $product->setMessage($contactFormData['message']);
        $product->setCreatedAt(new \DateTimeImmutable());

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

}