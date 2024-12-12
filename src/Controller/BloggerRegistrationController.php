<?php

namespace App\Controller;

use App\Entity\Blogger;
use App\Entity\User;
use App\Form\BloggerRegistrationType; // Assurez-vous d'avoir ce formulaire
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BloggerRegistrationController extends AbstractController
{
    #[Route('/register/blogger', name: 'blogger_registration')]
    public function register(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $blogger = new Blogger();

        // Create the form
        $form = $this->createForm(BloggerRegistrationType::class, $user);

        // Handle the request
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Set the blogger for the user
            $user->setBlogger($blogger);
            $blogger->setUser($user);

            // Persist the entities
            $entityManager->persist($user);
            $entityManager->persist($blogger);
            $entityManager->flush();

            // Redirect or add a success message
            return $this->redirectToRoute('success_page'); // Change to your success route
        }

        return $this->render('registration/blogger.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
