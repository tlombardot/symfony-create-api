<?php

namespace App\DTO\Trip;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Uid\Uuid;
use App\Dto\City\CityListOutput;
use DateTimeImmutable;

final class TripDetailsOutput extends TripListOutput{

    public function __construct(Uuid $id, CityListOutput $origin, CityListOutput $destination, DateTimeImmutable $departureAt, int $duration, int $price,
        #[ApiProperty(schema: [
                'type' => 'integer',
                'description' => 'Le poids maximum du bagage en kg'
        ])]
        public readonly int $maxBaggageWeightKg,

        #[ApiProperty(schema: [
                'type' => 'string',
                'description' => 'Le modele de la catapulte'
        ])]
        public readonly string $catapultModel,

        #[ApiProperty(schema: [
                'type' => 'string',
                'description' => 'Les informations de l\'embarquement'
        ])]
        public readonly string $boardingInfo,
    ){
        parent::__construct($id, $origin, $destination, $departureAt, $duration, $price);
    }
}
