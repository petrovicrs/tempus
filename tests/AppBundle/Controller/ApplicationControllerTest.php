<?php
/**
 * Created by PhpStorm.
 * User: marjanapesic
 * Date: 3/24/17
 * Time: 11:59 AM
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationControllerTest extends WebTestCase
{
//    public function testIndex()
//    {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/');
//
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
//    }


    public function testShowPost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/application');

        $response = $crawler->getResponse();

        $this->assertJsonResponse($response, 200);
    }


    protected function assertJsonResponse($response, $statusCode = 200)
    {
        $this->assertEquals(
            $statusCode, $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
    }

}
