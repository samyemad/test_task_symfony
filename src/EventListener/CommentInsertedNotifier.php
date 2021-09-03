<?php
namespace App\EventListener;


use App\Event\CommentInsertedEvent;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Blog\Comment;
use Symfony\Component\Security\Core\Security;

class CommentInsertedNotifier
{
    private $em;

    private $user;

    public function __construct(EntityManagerInterface $em,Security $security)
    {
     $this->em = $em;
     $this->user = $security->getUser();
    }
    public function notify(CommentInsertedEvent $event): void
    {
       $comment=$event->getComment();
       $comment->setClient( $this->user);
       $this->em->persist($comment);
       $this->em->flush();
    }
}

