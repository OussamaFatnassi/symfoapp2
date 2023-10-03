<?php

namespace App\Controller\Security;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class for login & register page
 */
class SecurityController extends AbstractController
{
    /**
     * Method for login page
     *
     * @param AuthenticationUtils $utils
     * @return Response
     */
    #[Route('/login', name: 'app.login', methods: ['GET', 'POST'])]
    public function index(AuthenticationUtils $utils): Response
    {
        $error = $utils->getLastAuthenticationError();

        $lastUsername = $utils->getLastUsername();

        return $this->render('login.html.twig', [
            'error' => $error,
            'lastUsername' => $lastUsername,
        ]);
    }
}
