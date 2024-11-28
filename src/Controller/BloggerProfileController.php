<?php

namespace App\Controller;

use App\Entity\BloggerProfile;
use App\Form\BloggerProfileType;
use App\Repository\BloggerProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/blogger/profile')]
final class BloggerProfileController extends AbstractController
{
    #[Route(name: 'app_blogger_profile_index', methods: ['GET'])]
    public function index(BloggerProfileRepository $bloggerProfileRepository): Response
    {
        return $this->render('blogger_profile/index.html.twig', [
            'blogger_profiles' => $bloggerProfileRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_blogger_profile_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bloggerProfile = new BloggerProfile();
        $form = $this->createForm(BloggerProfileType::class, $bloggerProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bloggerProfile);
            $entityManager->flush();

            return $this->redirectToRoute('app_blogger_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('blogger_profile/new.html.twig', [
            'blogger_profile' => $bloggerProfile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_blogger_profile_show', methods: ['GET'])]
    public function show(BloggerProfile $bloggerProfile): Response
    {
        return $this->render('blogger_profile/show.html.twig', [
            'blogger_profile' => $bloggerProfile,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_blogger_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BloggerProfile $bloggerProfile, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BloggerProfileType::class, $bloggerProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_blogger_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('blogger_profile/edit.html.twig', [
            'blogger_profile' => $bloggerProfile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_blogger_profile_delete', methods: ['POST'])]
    public function delete(Request $request, BloggerProfile $bloggerProfile, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bloggerProfile->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($bloggerProfile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_blogger_profile_index', [], Response::HTTP_SEE_OTHER);
    }
}
