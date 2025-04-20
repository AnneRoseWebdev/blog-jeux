<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
{
    $message = new Message();

    $form = $this->createForm(ContactType::class, $message);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $message->setCreatedAt(new \DateTimeImmutable());

        $entityManager->persist($message);
        $entityManager->flush();

        $email = (new Email())
    ->from($message->getEmail())
    ->to('ngalanianne@gmail.com')
    ->subject('Nouveau message depuis le formulaire de contact')
    ->text(
        "Nom: " . $message->getNom() . "\n" .
        "Email: " . $message->getEmail() . "\n\n" .
        "Message:\n" . $message->getContenu()
    );

$mailer->send($email);


        $this->addFlash('success', 'Votre message a bien été envoyé !');

        return $this->redirectToRoute('app_contact');
    }

    return $this->render('contact/index.html.twig', [
        'form' => $form->createView(),
    ]);
}
}
