<?php

namespace App\Controller;

use App\Entity\Blog\Comment;
use App\Event\ArticleInsertedEvent;
use App\Event\CommentInsertedEvent;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Service\Interfaces\GenerateEventInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Blog\Article;
use App\Service\Interfaces\ResultServiceInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/user/articles/all", name="homepage")
     */
    public function index(Request $request,ResultServiceInterface $resultService): Response
    {
        $em = $this->getDoctrine()->getManager();

        $result=$resultService->get(Article::class,'All',[]);
        return $this->render('default/index.html.twig',$result);
    }

    /**
     * @Route("/user/articles/details/{id}", name="details")
     */
    public function details($id,Request $request,GenerateEventInterface $generateEvent,EventDispatcherInterface $eventDispatcher): Response
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($id);
        if($article == null)
        {
            throw new \Exception('This Article Not Found', 404);
        }
        $comment = new Comment();
        $comment->setArticle($article);
        $form=$this->createForm(CommentType::class,$comment);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $generateEvent->generate(CommentInsertedEvent::class,$comment,$eventDispatcher);
            if($comment->getId() != null)
            {
                return $this->redirectToRoute('details', ['id' => $article->getId()]);
            }
            else
            {
                throw new \Exception('This Comment Has Not Been Created', 400);
            }
        }
        return $this->render('default/show.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/user/articles/byclient/{id}", name="user_articles_byclient")
     */
    public function showArticleById($id,Request $request,ResultServiceInterface $resultService): Response
    {
        $em = $this->getDoctrine()->getManager();
        $result=$resultService->get(Article::class,'By',['client' => $id]);
        return $this->render('default/index.html.twig',$result);
    }

}
