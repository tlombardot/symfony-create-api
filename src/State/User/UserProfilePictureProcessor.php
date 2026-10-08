<?php

namespace App\State\User;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Validator\Exception\ValidationException;
use App\DTO\User\UserDetailsOutput;
use App\DTO\User\UserProfilePictureInput;
use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @implements ProcessorInterface<mixed, UserDetailsOutput>
 */
final class UserProfilePictureProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly Security $security,
        private readonly UserService $userService,
        private readonly ValidatorInterface $validator,
    ) {
    }

    /**
     * Validates the uploaded picture, makes it the bearer's profile picture,
     * and serves their details.
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): UserDetailsOutput
    {
        // $data vaut null : rien n'a été désérialisé, le fichier est dans la requête elle-même
        $file = $context['request']->files->get('file');

        $input = new UserProfilePictureInput($file instanceof UploadedFile ? $file : null);

        $violations = $this->validator->validate($input);

        if(sizeof($violations) > 0) {
            throw new ValidationException($violations);
        }

        $user = $this->security->getUser();

        if (!$user instanceof User) {
            throw new AccessDeniedException();
        }

        $this->userService->changeProfilePicture($user, $input);

        return $this->userService->toDetails($user);
    }
}
