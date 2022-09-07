<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Exception\RuntimeException;
use App\Tool\Calculator;
use Exception;

/**
 * Calculator Controller
 * @Route("/api", name="api_")
 */
class CalculatorController extends AbstractController
{

    /**
     * Perform addition
     * @Rest\Post("/add")
     *
     * @param Request $request
     * @throws Exception
     * @return Response
     */
    public function add(Request $request): Response
    {
        $serializer = SerializerBuilder::create()->build();
        try {
            $args = $serializer->deserialize($request->getContent(), 'array<int>', 'json');
            if(count($args) !== 2) {
                throw new Exception("Wrong number of parameters!");
            }
            $result = Calculator::add((float)$args[0], (float)$args[1]);
        } catch(RuntimeException $e) {
            $response = new Response();
            return $response->setStatusCode(422);
        }

        return $this->json(['result' => $result]);
    }

    /**
     * Perform subtraction
     * @Rest\Post("/subtract")
     *
     * @param Request $request
     * @throws Exception
     * @return Response
     */
    public function subtract(Request $request): Response
    {
        $serializer = SerializerBuilder::create()->build();
        try {
            $args = $serializer->deserialize($request->getContent(), 'array<int>', 'json');
            if(count($args) !== 2) {
                throw new Exception("Wrong number of parameters!");
            }
            $result = Calculator::subtract((float)$args[0], (float)$args[1]);
        } catch(RuntimeException $e) {
            $response = new Response();
            return $response->setStatusCode(422);
        }
        return $this->json(['result' => $result]);
    }

    /**
     * Perform multiplication
     * @Rest\Post("/multiply")
     *
     * @param Request $request
     * @throws Exception
     * @return Response
     */
    public function multiply(Request $request): Response
    {
        $serializer = SerializerBuilder::create()->build();
        try {
            $args = $serializer->deserialize($request->getContent(), 'array<int>', 'json');
            if(count($args) !== 2) {
                throw new Exception("Wrong number of parameters!");
            }
            $result = Calculator::multiply((float)$args[0], (float)$args[1]);
        } catch(RuntimeException $e) {
            $response = new Response();
            return $response->setStatusCode(422);
        }
        return $this->json(['result' => $result]);
    }

    /**
     * Perform division
     * @Rest\Post("/divide")
     *
     * @param Request $request
     * @throws Exception
     * @return Response
     */
    public function divide(Request $request): Response
    {
        $serializer = SerializerBuilder::create()->build();
        try {
            $args = $serializer->deserialize($request->getContent(), 'array<int>', 'json');
            if(count($args) !== 2) {
                throw new Exception("Wrong number of parameters!");
            }
            $result = Calculator::divide((float)$args[0], (float)$args[1]);
        } catch(RuntimeException $e) {
            $response = new Response();
            return $response->setStatusCode(422);
        }
        return $this->json(['result' => $result]);
    }

}