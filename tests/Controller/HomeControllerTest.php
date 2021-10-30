<?php

namespace Tests\App\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHomepageIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        //$this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Nos nouveaux chalets');
    }
}
