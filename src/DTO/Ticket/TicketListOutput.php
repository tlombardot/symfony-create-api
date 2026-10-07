<?php

namespace App\DTO\Ticket;

use ApiPlatform\Metadata\ApiProperty;
use App\DTO\Trip\TripListOutput;
use Symfony\Component\Uid\Uuid;

class TicketListOutput{

    public function __construct(

        #[ApiProperty(schema:[
            'type' => 'string',
            'format' => 'uuid',
            'description' => 'Identifiant du billet'
        ])]
        public readonly Uuid $id,

        #[ApiProperty(schema:[
            'type' => 'object',
            'description' => 'Le lancer'
        ])]
        public readonly TripListOutput $trip,

        #[ApiProperty(schema:[
            'type' => 'integer',
            'description' => 'Prix du billet'
        ])]
        public readonly int $price,

        #[ApiProperty(schema:[
            'type' => 'string',
            'format' => 'date-time',
            'description' => 'Date d\'émission du billet'
        ])]
        public \DateTimeImmutable $createdAt
    ){
    }
}
