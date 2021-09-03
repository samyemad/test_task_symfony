<?php

namespace App\Controller;


use App\Service\Interfaces\GenerateEventInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Blog\Article;
use App\Form\ArticleType;
use App\Event\ArticleInsertedEvent;

class AccountController extends AbstractController
{
    /**
     * @Route("/user/article/create", name="admin_article_create")
     */
    public function index(Request $request,GenerateEventInterface $generateEvent,EventDispatcherInterface $eventDispatcher): Response
    {
        $article = new Article();
        $form=$this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $generateEvent->generate(ArticleInsertedEvent::class,$article,$eventDispatcher);
            if($article->getId() != null)
            {
                return $this->redirectToRoute('admin_article_show', ['id' => $article->getId()]);
            }
            else
            {
                throw new \Exception('This Article Has Not Been Created', 400);
            }
        }
        return $this->render('article/create.html.twig', [

            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/article/show/{id}", name="admin_article_show")
     */
    public function showArticle($id)
    {
        $em=$this->getDoctrine()->getManager();
        $article=$em->getRepository(Article::class)->find($id);
        if($article == null)
        {
            throw new \Exception('This Article Not Found', 404);
        }
        return $this->render('article/show.html.twig', [

            'article' => $article
        ]);
    }


}
