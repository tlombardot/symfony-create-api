<?php

namespace App\DTO\City;

use ApiPlatform\Metadata\ApiProperty;

class CityListOutput
{
    public function __construct(
        #[ApiProperty(schema: [
            'description' => 'Identifiant unique de la ville',
            'type' => 'string',
            'format' => 'uuid',
        ])]
        public string $id,

        #[ApiProperty(schema: [
            'description' => 'Nom de la ville',
            'type' => 'string',
        ])]
        public string $name,
    ) {}
}
