<?php
// tests/Repository/MovieRepositoryTest.php
namespace App\Tests\Repository;

use App\Entity\Blog\Article;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticleRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByName()
    {
        $article = $this->entityManager
            ->getRepository(Article::class)
            ->findOneBy(['title' => 'samy']);
        $this->assertNotNull($article);
        if($article!= null) {
            $this->assertSame('test test', $article->getDescription());
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}

