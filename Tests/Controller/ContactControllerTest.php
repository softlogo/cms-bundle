<?php

namespace Softlogo\CMSBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testForm()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/form');
    }

}
