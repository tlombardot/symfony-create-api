<?php
namespace App\DTO\User;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegisterInput
{
    public function __construct(

        #[Assert\NotBlank]
        #[Assert\Email]
        #[Assert\Length(min: 3, max: 255)]
        #[ApiProperty(schema: [
            'type' => 'string',
            'format' => 'email',
            'description' => "L\'email de l\'utilisateur (doit etre unique)",
            "minLength" => 3,
            "maxLength" => 255,
            'example' => 'john.doe@example.com',
        ], required: true)]
        public string $email,

        #[Assert\NotBlank]
        #[Assert\PasswordStrength]
        #[Assert\Length(min: 8, max: 255)]
        #[ApiProperty(schema: [
            'type' => 'string',
            'description' => "Le mot de passe de l\'utilisateur (doit être sécurisé)",
            "minLength" => 8,
            "maxLength" => 255,
            'example' => 'motdepasseDEZD**',
        ], required: true)]
        public string $password,

        #[Assert\NotBlank(allowNull: true)]
        #[Assert\Length(min: 3, max: 255)]
        #[ApiProperty(schema: [
            'type' => 'string',
            'description' => "Le prénom de l\'utilisateur",
            "minLength" => 3,
            "maxLength" => 255,
            'example' => 'John',
        ], required: false)]
        public null|string $firstName = null,

        #[Assert\NotBlank(allowNull: true)]
        #[Assert\Length(min: 3, max: 255)]
        #[ApiProperty(schema: [
            'type' => 'string',
            'description' => "Le nom de l\'utilisateur",
            "minLength" => 3,
            "maxLength" => 255,
            'example' => 'Doe',
        ], required: false)]
        public null|string $lastName = null,
    ) {
    }
}
