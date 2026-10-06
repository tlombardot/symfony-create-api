<?php

namespace App\DTO\Cart;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;

class CartAddLineInput{
    public function __construct(
        #[Assert\Uuid]
        #[Assert\NotBlank]
        #[ApiProperty(schema: [
           'type' => 'string',
           'format' => 'uuid',
           'description' => "Identifiant du lancer à ajouter",
        ], required: true)]
        public string $tripId,

        #[Assert\Positive]
        #[Assert\NotBlank]
        #[ApiProperty(schema: [
            'type' => 'integer',
            'description' => "Nombre de places. Chaque place donnera un billet au paiment.",
            'minimum' => 1,
         ], required: true)]
        public int $passengers,
    ){
    }
}
