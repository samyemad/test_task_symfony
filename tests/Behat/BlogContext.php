<?php
namespace App\Tests\Behat;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert as Assertions;
use App\Entity\Blog\Article;
use App\Entity\Blog\Comment;

/**
 * Defines application features from the specific context.
 */
class BlogContext implements Context
{

    private $article;

    private $path;

    private $content;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @When I add article with title  :arg1 and description :arg2
     */
    public function iAddArticleWithTitleAndDescription($arg1, $arg2)
    {
        $article= new Article();
        $article->setTitle($arg1);
        $article->setDescription($arg2);
        $this->article=$article;
        Assertions::assertNotNull($article);
    }

    /**
     * @When I add comment with name :arg1 and description :arg2 and email :arg3
     */
    public function iAddCommentWithNameAndDescriptionAndEmail($arg1, $arg2, $arg3)
    {
        $comment = new Comment();
        $comment->setName($arg1);
        $comment->setDescription($arg2);
        $comment->setEmail($arg3);
        $this->article->addComment($comment);
        Assertions::assertNotNull($comment);
    }

    /**
     * @Then The results should include a article with comment count :arg1
     */
    public function theResultsShouldIncludeAArticleWithCommentCount($arg1)
    {
        $comments=$this->article->getComments();
        Assertions::assertEquals(1,count($comments));
    }


}
