<?php

namespace App\Controller\security;

use Symfony\Component\HttpFoundation\Response;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
   
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error=$authenticationUtils->getLastAuthenticationError();
        $lastUsername=$authenticationUtils->getLastUSername();
        return $this->render('security/login.html.twig',[
            'last_username'=>$lastUsername,
            'error'=>$error
        ]);
    }

    public function logout(AuthenticationUtils $authenticationUtils): void
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
    
}
