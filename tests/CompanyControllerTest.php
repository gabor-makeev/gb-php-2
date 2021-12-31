<?php

/*
 * Так как тесты для CompanyController во многом напоминают тесты для ApplicationController,
 * оставил большество комментариев в ApplicationControllerTest
*/

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompanyControllerTest extends WebTestCase
{
    private $client;

    public function testGetCompanies(): void
    {
        $crawler = $this->client->request('GET', '/companies');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Here are all the companies from our database');
    }

    /**
     * @dataProvider getCompanyProvider
     */
    public function testGetCompany($company_id)
    {
        $crawler = $this->client->request('GET', "/companies/$company_id");

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Here is some information about');
        $this->assertSelectorTextContains('h3', 'Name:');
        $this->assertSelectorTextContains('h4', 'History:');
    }

    public function getCompanyProvider() : array
    {
        return [
            [1],
            [2]
        ];
    }

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }
}
