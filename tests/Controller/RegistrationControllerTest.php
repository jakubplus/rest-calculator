<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Bundle\FrameworkBundle\Client;

class RegistrationControllerTest extends WebTestCase
{

    public function testRegister() {
        $rand = md5(rand(0,9999));
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/register',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['email' => $rand.'@example.com', 'password' => 'QAZ123'])
        );

        $this->assertResponseStatusCodeSame(200);

        $response = $client->getResponse();
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(['message' => 'User has been registered!'], $response_data);
    }

}