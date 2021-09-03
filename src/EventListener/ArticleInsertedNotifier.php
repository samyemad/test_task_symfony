<?php
namespace App\EventListener;

use App\Entity\Blog\Article;
use App\Event\ArticleInsertedEvent;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Blog\Comment;
use Symfony\Component\Security\Core\Security;

class ArticleInsertedNotifier
{
    private $em;

    private $user;

    public function __construct(EntityManagerInterface $em,Security $security)
    {
     $this->em = $em;
     $this->user = $security->getUser();
    }
    public function notify(ArticleInsertedEvent $event): void
    {

       $article=$event->getArticle();
       $dateTime = new \DateTime('NOW');
       $article->setCreatedAt($dateTime);
       $article->setClient( $this->user);
       $this->em->persist($article);
       $this->em->flush();
    }
}

