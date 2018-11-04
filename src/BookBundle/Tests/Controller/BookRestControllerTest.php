<?php

namespace BookBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookRestControllerTest extends WebTestCase
{
    public function testDatatabledata()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/dataTableData');
    }

}
