<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
            'username' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'apiToken' => $user->getApiToken()
        ]);
    }
}