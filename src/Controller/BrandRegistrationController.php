<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\User;
use App\Form\BrandRegistrationType; // Assurez-vous d'avoir ce formulaire
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrandRegistrationController extends AbstractController
{
    #[Route('/register/brand', name: 'brand_registration')]
    public function register(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $brand = new Brand();

        // Create the form
        $form = $this->createForm(BrandRegistrationType::class, $user);

        // Handle the request
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Set the brand for the user
            $user->setBrand($brand);
            $brand->setUser($user);

            // Persist the entities
            $entityManager->persist($user);
            $entityManager->persist($brand);
            $entityManager->flush();

            // Redirect or add a success message
            return $this->redirectToRoute('success_page'); // Change to your success route
        }

        return $this->render('registration/brand.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}