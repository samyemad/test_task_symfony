<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Blog\Article;
use App\Entity\Blog\Comment;

class ArticleFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setTitle('samy');
        $article->setDescription('test test');


        $comment = new Comment();
        $comment->setName('comment1');
        $comment->setDescription('comment description');

        $comment = new Comment();
        $comment->setName('comment2');
        $comment->setDescription('comment 2 description');
        $comment->setEmail('samyemad4@gmail.com');
        $article->addComment($comment);
         $manager->persist($article);

        $manager->flush();
    }
}
