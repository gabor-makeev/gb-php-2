<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationControllerTest extends WebTestCase
{
    private $client;

    public function testGetApplications(): void
    {
        $crawler = $this->client->request('GET', '/applications');

        // Проверяю был ли запрос по руту /applications успешным
        $this->assertResponseIsSuccessful();

        /*
         * Проверяю присутствует ли на странице один из div-ов,
         * который должен присутствовать даже в случае если в базе нет данных
         * о приложениях
        */
        $this->assertSelectorExists('.application__container');

        // Проверяю присутствует ли главный заголовок на целевой странице
        $this->assertSelectorTextContains('.application__container > h1', 'Here are all the applications from our database');
    }

    /**
     * @dataProvider getApplicationProvider
     */
    public function testGetApplication($applicationId)
    {
        $this->client->request('GET', "/applications/$applicationId");

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('.application__container');

        // Проверяю присутствует ли главный заголовок на целевой странице
        $this->assertSelectorTextContains('h1', 'Here is some information about');

        /*
         * Ассоциативный массив с данными о классах селекторов и неизменными частями текста,
         * которые точно должни находится в них
        */
        $requiredParagraphs = [
            'title' => 'Title:',
            'developed-by' => 'Developed by:',
            'written-in' => 'Written in:',
            'description' => 'Description:'
        ];

        // Проверяю присутствуют ли все поля с подробностями о приложениях на странице
        foreach ($requiredParagraphs as $requiredParagraphClass => $requiredParagraphContent) {
            $this->assertSelectorTextContains(".application__container-$requiredParagraphClass", $requiredParagraphContent);
        }
    }

    // Простой и не очень универсальный dataProvider - проверял данную функцию
    public function getApplicationProvider() : array
    {
        return [
            [1],
            [2],
            [3],
            [4]
        ];
    }

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }
}
