<?php

use App\Entity\Application;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    public function testSetName()
    {
        $application = new Application();
        $application->setName('Instagram');
        $this->assertEquals('Instagram', $application->getName());
    }
}