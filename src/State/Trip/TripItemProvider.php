<?php

namespace App\State\Trip;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\DTO\Trip\TripDetailsOutput;
use App\Service\TripService;
use Override;

final class TripItemProvider implements ProviderInterface
{
    public function __construct(
        private readonly TripService $tripService,
    )
    {}


    public function provide(Operation $operation, array $uriVariables = [], array $context = []): null|TripDetailsOutput
    {
        $id = $uriVariables['id'];
        $trip = $this->tripService->findOneById($id);
        return $this->tripService->toDetails($trip);
    }
}
