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

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository(Article::class);

        $page = $request->query->get('page', 1);
        $limit = 2;
        $pagesCount = ceil(count($repo->findAll()) / $limit);
        $pages = range(1, $pagesCount);
        $articles = $repo->findBy([], [], $limit, ($limit * ($page - 1)));

        return $this->render('default/index.html.twig', [
            'pagesCount' => $pagesCount,
            'pages' => $pages,
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/user/details/{id}", name="details")
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

}
