<?php

namespace App\DTO\Cart;

use ApiPlatform\Metadata\ApiProperty;

class CartPayOutput{

    public function __construct(

        #[ApiProperty(schema:[
            'type' => 'string',
            'description' => 'Message de confirmation'
        ])]
        public readonly string $confirmation,

        #[ApiProperty(description:"La liste des tickets")]
        public readonly array $tickets,
    ){}
}
