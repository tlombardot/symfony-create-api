<?php

namespace App\State\User;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\DTO\User\UserDetailsOutput;
use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\SecurityBundle\Security;

final class UserMeProvider implements ProviderInterface
{
    public function __construct(
        private readonly Security $security,
        private readonly UserService $userService,
    ) {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): null|UserDetailsOutput
{
        $user = $this->security->getUser();
        if (!$user instanceof User) {
            return null;
        }

        return $this->userService->toDetails($user);
    }
}
