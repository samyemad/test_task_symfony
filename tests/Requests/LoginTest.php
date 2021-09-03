<?php
// tests/Service/NewsletterGeneratorTest.php
namespace App\Tests\Requests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
class LoginTest extends KernelTestCase
{
    public function testAuthorizeApi()
    {

        // (1) boot the Symfony kernel
        $kernel=self::bootKernel();
        $headers = [
            'Content-Type' => 'application/json',
        ];
        $client = new \GuzzleHttp\Client([
            'base_uri' => $_ENV['APP_URL'],
            'debug'=> true,
            'defaults' => [
                'exceptions' => false
            ],
            'headers' => $headers
        ]);
        $data['credentials']['login']='samyemad4@gmail.com';
        $data['credentials']['password']='123456';

        $response = $client->post('/api/shop/login', [
            'body' => json_encode($data)
        ]);
        $content=json_decode($response->getBody()->getContents(),true);

       $this->assertEquals(200,$response->getStatusCode());
       $this->assertEquals($data['credentials']['login'],$content['username']);


    }
}
