<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChoiceRegistrationController extends AbstractController
{
    #[Route('/choose-registration', name: 'choose_registration')]
    public function choose(): Response
    {
        return $this->render('registration/choose_registration.html.twig');
    }
}
