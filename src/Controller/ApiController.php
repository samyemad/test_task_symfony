<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Blog\Article;
class ApiController extends AbstractController
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
    /**
     * @Route("/api/account/articles", name="account_articles", methods={"GET"})
     */
    public function showArticles($handlerCollection)
    {
        $em=$this->getDoctrine()->getManager();
        $articles=$em->getRepository(Article::class)->findAll();

       $content= $handlerCollection->serialize($articles,'group1');
       return $this->json(['message' => 'Articles Viewed Successfully','data' => $content]);
    }
}