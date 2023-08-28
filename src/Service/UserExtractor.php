<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class UserExtractor
{
    public function __construct(protected RequestStack $requestStack, private readonly UserRepository $userRepository)
    {
    }

    public function extract(): User
    {
        $request = $this->requestStack->getCurrentRequest();
        $user = $this->userRepository->findOneBy(['uuid' => $request->headers->get('userUuid')]);
        if (null === $user) {
            throw new \Exception('User not found');
        }

        return $user;
    }
}
