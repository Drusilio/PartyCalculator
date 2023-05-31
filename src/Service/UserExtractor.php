<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class UserExtractor
{
    public function __construct(protected RequestStack $requestStack, private readonly UserRepository $userRepository)
    {
    }

    public function extract (): User {
        $request = $this->requestStack->getCurrentRequest();
        $user = $this->userRepository->findOneBy(['name' => $request->headers->get('userName')]);
        if ($user === null) {
            throw new Exception('User not found');
        }

        return $user;
    }
}
