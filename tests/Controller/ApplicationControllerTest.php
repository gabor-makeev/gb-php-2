<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationControllerTest extends WebTestCase
{
    public function testGetApplications()
    {
        $client = static::createClient();
        $client->request('GET', '/applications');

        $this->assertResponseStatusCodeSame(200);
        $this->assertSelectorTextContains('h1', 'Here are all the applications from our database');
    }
}
