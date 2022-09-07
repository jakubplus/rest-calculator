<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Bundle\FrameworkBundle\Client;

class CalculatorControllerTest extends WebTestCase
{

    /**
     * Create a client with a default Authorization header.
     *
     * @param string $username
     * @param string $password
     *
     * @return Client
     */
    protected function createAuthenticatedClient($username = 'jakubplus@gmail.com', $password = 'QAZWSX')
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'username' => $username,
                'password' => $password,
            ])
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }

    public function testAddUnauthorized()
    {
        $client = static::createClient();
        $client->request('POST', '/api/add');

        $this->assertResponseStatusCodeSame(401);

        $response = $client->getResponse();
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(['code' => 401, 'message' => 'JWT Token not found'], $response_data);
    }

    public function testAddMethodNotAllowed()
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $this->expectException(MethodNotAllowedHttpException::class);
        $client->request('GET', '/api/add');


        $this->assertResponseStatusCodeSame(405);
    }

    public function testAddMissingParameters()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('POST', '/api/add');

        $this->assertResponseStatusCodeSame(422);
    }

    public function testAddMissingParameter()
    {
        $client = $this->createAuthenticatedClient();
        $client->catchExceptions(false);
        $this->expectException(\Exception::class);
        $client->request(
            'POST',
            '/api/add',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['arg1' => 2])
        );
    }

    public function testAdd()
    {
        $client = $this->createAuthenticatedClient();
        $client->request(
            'POST',
            '/api/add',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['arg1' => 2, 'arg2' => 2])
        );

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseFormatSame('json');

        $response = $client->getResponse();
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(['result' => 4], $response_data);
    }


    public function testSubtractUnauthorized()
    {
        $client = static::createClient();
        $client->request('POST', '/api/subtract');

        $this->assertResponseStatusCodeSame(401);

        $response = $client->getResponse();
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(['code' => 401, 'message' => 'JWT Token not found'], $response_data);
    }

    public function testSubtractMethodNotAllowed()
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $this->expectException(MethodNotAllowedHttpException::class);
        $client->request('GET', '/api/subtract');

        $this->assertResponseStatusCodeSame(405);
    }

    public function testSubtractMissingParameters()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('POST', '/api/subtract');

        $this->assertResponseStatusCodeSame(422);
    }

    public function testSubtractMissingParameter()
    {
        $client = $this->createAuthenticatedClient();
        $client->catchExceptions(false);
        $this->expectException(\Exception::class);
        $client->request(
            'POST',
            '/api/subtract',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['arg1' => 2])
        );
    }

    public function testSubtract()
    {
        $client = $this->createAuthenticatedClient();
        $client->request(
            'POST',
            '/api/subtract',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['arg1' => 2, 'arg2' => 2])
        );

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseFormatSame('json');

        $response = $client->getResponse();
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(['result' => 0], $response_data);
    }

    public function testMultiplyUnauthorized()
    {
        $client = static::createClient();
        $client->request('POST', '/api/multiply');

        $this->assertResponseStatusCodeSame(401);

        $response = $client->getResponse();
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(['code' => 401, 'message' => 'JWT Token not found'], $response_data);
    }

    public function testMultiplyMethodNotAllowed()
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $this->expectException(MethodNotAllowedHttpException::class);
        $client->request('GET', '/api/multiply');

        $this->assertResponseStatusCodeSame(405);
    }

    public function testMultiplyMissingParameters()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('POST', '/api/multiply');

        $this->assertResponseStatusCodeSame(422);
    }

    public function testMultiplyMissingParameter()
    {
        $client = $this->createAuthenticatedClient();
        $client->catchExceptions(false);
        $this->expectException(\Exception::class);
        $client->request(
            'POST',
            '/api/multiply',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['arg1' => 2])
        );
    }

    public function testMultiply()
    {
        $client = $this->createAuthenticatedClient();
        $client->request(
            'POST',
            '/api/multiply',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['arg1' => 2, 'arg2' => 4])
        );

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseFormatSame('json');

        $response = $client->getResponse();
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(['result' => 8], $response_data);
    }

    public function testDivideUnauthorized()
    {
        $client = static::createClient();
        $client->request('POST', '/api/divide');

        $this->assertResponseStatusCodeSame(401);

        $response = $client->getResponse();
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(['code' => 401, 'message' => 'JWT Token not found'], $response_data);
    }

    public function testDivideMethodNotAllowed()
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $this->expectException(MethodNotAllowedHttpException::class);
        $client->request('GET', '/api/divide');

        $this->assertResponseStatusCodeSame(405);
    }

    public function testDivideMissingParameters()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('POST', '/api/divide');

        $this->assertResponseStatusCodeSame(422);
    }

    public function testDivideMissingParameter()
    {
        $client = $this->createAuthenticatedClient();
        $client->catchExceptions(false);
        $this->expectException(\Exception::class);
        $client->request(
            'POST',
            '/api/divide',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['arg1' => 2])
        );
    }

    public function testDivide()
    {
        $client = $this->createAuthenticatedClient();
        $client->request(
            'POST',
            '/api/divide',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['arg1' => 4, 'arg2' => 2])
        );

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseFormatSame('json');

        $response = $client->getResponse();
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(['result' => 2], $response_data);
    }


}