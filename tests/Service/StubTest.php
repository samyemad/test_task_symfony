<?php
// tests/Service/NewsletterGeneratorTest.php
namespace App\Tests\Service;


use App\Service\AService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\SomeClass;
class StubTest extends KernelTestCase
{

    public function testStub(): void
    {
        // Create a stub for the SomeClass class.
        $stub = $this->createStub(SomeClass::class);

        // Configure the stub.
//        $stub->method('doSomething')
//
//            ->willReturn('sss');
//        $this->assertSame('foo', $stub->doSomething());

        //$mock=$this->createMock(SomeClass::class);
        //dd($mock);
        $tt = new AService();
        $mock = $this->getMockBuilder(SomeClass::class)
            ->setConstructorArgs(['eerrr'])
            ->getMock();

        $mock->expects($this->any())
            ->method('doSomething')
        ->with(
            'samyemad',
            'test'
        )
           ->willReturn($tt)
        ;
//dd($mock->doSomething('samyemad','test'));
$this->assertEquals($tt,$mock->doSomething('samyemad','test'));
       // $this->assertTrue();


        // Calling $stub->doSomething() will now return
        // 'foo'.

    }
}
