<?php

namespace App\Service\User;

use App\Entity\User as UserEntity;
use App\Model\User;
use App\Repository\User\UserRepositoryInterface;
use App\Service\User\Data\GetUserInput;
use App\Service\User\Data\GetUserOutput;
use App\Traits\ArrayHelpers;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Uid\AbstractUid;

class UserService implements UserServiceInterface
{

    use ArrayHelpers;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    )
    {}

    public function getUser(GetUserInput $input): GetUserOutput
    {
        $filters = $this->clearEmptyValues([
           'uuid' => $input->getUuid(),
           'login' => $input->getLogin(),
        ]);

        $filters['deletedBy'] = null;

        /** @var User|null $user */
        $user = $this->userRepository->findOneBy($filters);

        return new GetUserOutput($user);
    }

}
