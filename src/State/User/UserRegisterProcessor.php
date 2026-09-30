<?php

namespace App\State\User;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\DTO\User\UserDetailsOutput\UserDetailsOutput;
use App\Service\UserService;

class UserRegisterProcessor implements ProcessorInterface
{
    public function __construct(
        private UserService $userService,
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): UserDetailsOutput
    {
        return $this->userService->toDetails($this->userService->register($data));
    }
}
