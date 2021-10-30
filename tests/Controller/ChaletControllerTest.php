<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class testChaletController extends WebTestCase
{


    public function testListOfChalets()
    {
        $client = static::createClient();
        $client->request('GET', '/chalets');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Voici nos chalets !');
    }


    public function testShowChalet()
    {
        $client = static::createClient();
        $client->request('GET', '/chalets/chalet-1');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h4', 'Chalet 1');
    }
}
