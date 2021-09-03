<?php
namespace App\Event;
use Symfony\Contracts\EventDispatcher\Event;
use App\Entity\Blog\Article;
class ArticleInsertedEvent extends Event
{
    public const NAME = 'app.article.inserted';

    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }
}

