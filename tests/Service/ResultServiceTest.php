<?php

namespace App\Tests\Service;

use App\Entity\Blog\Article;
use App\Service\Results\ResultService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ResultServiceTest extends KernelTestCase
{
    /**
     * @var $client
     */
    private $client;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->client = 1;
    }
    public function testResult()
    {

        // (1) boot the Symfony kernel
        self::bootKernel();

        // (2) use static::getContainer() to access the service container
        $container = static::$kernel->getContainer();

        // (3) run some service & test the result
        $resultService = $container->get(ResultService::class);
        $result = $resultService->get(Article::class,'By',['client' => $this->client]);

        $this->assertIsArray($result);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->client = null;
    }
}