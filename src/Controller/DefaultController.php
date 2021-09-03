<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{


    /**
     * @Route("/api/shop/login", name="login", methods={"POST"})
     */
    public function login(Request $request): Response
    {
        $user = $this->getUser();
        $em=$this->getDoctrine()->getManager();
        $roles=['ROLE_USER'];
        $user->setRoles($roles);
        $em->persist($user);
        $em->flush();
        return $this->json([
            // The getUserIdentifier() method was introduced in Symfony 5.3.
            // In previous versions it was called getUsername()
            'username' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'apiToken' => $user->getApiToken()
        ]);
    }
}