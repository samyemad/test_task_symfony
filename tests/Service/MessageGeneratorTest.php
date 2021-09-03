<?php
// tests/Service/NewsletterGeneratorTest.php
namespace App\Tests\Service;

use App\Service\MessageGenerator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Psr\Log\LoggerInterface;
class MessageGeneratorTest extends KernelTestCase
{
    public function testSomething()
    {
        // (1) boot the Symfony kernel
        self::bootKernel();

        // (2) use static::getContainer() to access the service container
        $container = static::$kernel->getContainer();

        // (3) run some service & test the result
        $messageGenerator = $container->get('app.service.site.update.manager');
        $newsletter = $messageGenerator->getHappyMessage();

        $this->assertIsArray($newsletter);
    }
}
