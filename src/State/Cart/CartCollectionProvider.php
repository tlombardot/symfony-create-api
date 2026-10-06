<?php

namespace App\State\Cart;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\User;
use App\Service\CartService;
use Symfony\Bundle\SecurityBundle\Security;

class CartCollectionProvider implements ProviderInterface
{
    public function __construct(
        private readonly CartService $cartService,
        private readonly Security $security
    ){
    }

    public function provide(
    Operation $operation,
    array $uriVariables = [],
    array $context = []
    ): array
    {
        $user = $this->security->getUser();

        if (!$user instanceof User) {
            return [];
        }

        $cart = $this->cartService->findActiveFor($user);

        if ($cart === null) {
            return [];
        }

        return array_map($this->cartService->toDetails(...), [$cart]);
    }
}
