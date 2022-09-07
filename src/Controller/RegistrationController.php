<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

/**
 * @Route("/api", name="api_")
 */
class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"POST"})
     */
    public function register(ManagerRegistry $doctrine, Request $request, UserPasswordHasherInterface $user_password_hasher): Response
    {
        $manager = $doctrine->getManager();
        $decoded = json_decode($request->getContent());

        $email = $decoded->email;
        $password = $decoded->password;

        $user = new User();
        $hashed_password = $user_password_hasher->hashPassword($user, $password);

        $user->setPassword($hashed_password);
        $user->setEmail($email);
        $user->setUsername($email);

        $manager->persist($user);
        $manager->flush();

        return $this->json(['message' => 'User has been registered!']);
    }
}