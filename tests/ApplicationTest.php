<?php

namespace App\Tests;

use App\Entity\Company;
use App\Entity\ProgrammingLang;
use PHPUnit\Framework\TestCase;
use App\Entity\Application;

class ApplicationTest extends TestCase
{
    private $application;

    /*
     * Проверяю работает ли добавление новых языков программирования в коллекцию
     * ProgrammingLanguages (свойство экземпляров класса Application).
    */
    public function testAddProgrammingLanguage()
    {
        $programmingLanguage = new ProgrammingLang();
        $programmingLanguage->setName('newPHP');

        $this->application->addProgrammingLanguage($programmingLanguage);

        $appProgrammingLangsArr = $this->application->getProgrammingLanguages()->toArray();

        $lastProgrammingLangInApp = end($appProgrammingLangsArr);

        $this->assertEquals('newPHP', $lastProgrammingLangInApp->getName());
    }

    // Проверяю работает ли установка значения name для экземпляров класса Application
    public function testSetName(): void
    {
        $this->application->setName('newApp');

        $this->assertEquals('newApp', $this->application->getName());
    }

    // Проверяю работает ли установка значения description для экземпляров класса Application
    public function testSetDescription(): void
    {
        $this->application->setDescription('newDesc');

        $this->assertEquals('newDesc', $this->application->getDescription());
    }

    /*
     * Проверяю работает ли установка значения company_id для экземпляров класса Application
     * (значение должно быть типа Company)
    */
    public function testSetCompanyId()
    {
        $company = new Company();
        $company->setName('NewCompany');

        $this->application->setCompanyId($company);

        $this->assertEquals('NewCompany', $this->application->getCompanyId()->getName());
    }

    protected function setUp(): void
    {
        $this->application = new Application();
    }
}
