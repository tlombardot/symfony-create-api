<?php

namespace App\DTO\Trip;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;

final class TripSearchInput
{
    #[ApiProperty(schema:[
        'type' => 'string',
        'format' => 'uuid',
        'example' => '01a0f792-ccec-7eb5-af2b-99f92b6a2bd8',
        'description' => 'Identifiant de la ville de départ.',
    ])]
    #[Assert\NotBlank]
    #[Assert\Uuid]
    public ?string $origin = null;

    #[ApiProperty(schema:[
        'type' => 'string',
        'format' => 'uuid',
        'example' => '01a0f792-cced-7086-b9af-14c7948a1587',
        'description' => 'Identifiant de la ville d\'arrivée.',
    ])]
    #[Assert\NotBlank]
    #[Assert\Uuid]
    public ?string $destination = null;

    #[ApiProperty(schema: [
        'type' => 'string',
        'format' => 'date',
        'example' => '2026-10-15',
        'description' => 'Jour du départ recherché, au format YYYY-MM-DD.',
    ])]
    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $date = null;

    #[ApiProperty(schema:[
        'type' => 'integer',
        'example' => 2,
        'description' => 'Nombre de passagers du voyage recherché.',
    ])]
    #[Assert\NotBlank]
    #[Assert\Positive]
    public ?int $passengers = null;
}
