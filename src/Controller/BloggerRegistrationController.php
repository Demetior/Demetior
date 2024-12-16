<?php

namespace App\Controller;

use App\Entity\Blogger;
use App\Entity\User;
use App\Entity\Blog;
use App\Form\BloggerRegistrationType;
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
        $blog = new Blog();

        // Create the form
        $form = $this->createForm(BloggerRegistrationType::class, ['user' => $user, 'blogger' => $blogger, 'blog' => $blog]);

        // Handle the request
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Set the blogger for the user
            $user->setBlogger($blogger);
            $blogger->setUser($user);
            // Set the blog details
            $blog->setBlogName($request->request->get('blog_name'));
            $blog->setWebsite($request->request->get('website'));

            // Persist the entities
            $entityManager->persist($user);
            $entityManager->persist($blogger);
            $entityManager->persist($blog);
            $entityManager->flush();

            // Redirect or add a success message
            return $this->redirectToRoute('success_page'); // Change to your success route
        }

         // Accéder à la propriété name de Blogger après la soumission
        //  if ($user->getBlogger()) {
        //     $blogger = $user->getBlogger(); // Get the associated Blogger entity

        //     $name = $blogger->getName(); // Access the name
        //     $surname = $blogger->getSurname(); // Access the surname
        //     $birthDate = $blogger->getBirthDate(); // Access the birthDate

        //     // Example output or handling
        //     echo "Name: " . $name . "<br>";
        //     echo "Surname: " . $surname . "<br>";
        //     echo "Birth Date: " . $birthDate->format('Y-m-d'); // Format the date as needed
        // } else {
        //     echo "Aucun blogueur associé à cet utilisateur.";
        // }


        return $this->render('registration/register_blogger.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
