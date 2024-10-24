<?php

declare(strict_types=1);

namespace App\Controller\v1;

use App\Entity\User;
use App\Manager\UserManager;
use App\Model\ModelList\UserModelList;
use App\Model\UserModel;
use App\Security\AccessGroup;
use App\Service\SecurityService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\Delete;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Patch;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route(path: '/users', name: 'app_users_')]
class UserController extends AbstractController
{
    public function __construct(
        private UserManager $userManager,
        private SecurityService $securityService,
    ) {

    }

    #[Patch(
        summary: 'Update user by id',
        requestBody: new RequestBody(
            content: [new Model(type: UserModel::class, groups: [AccessGroup::USER_WRITE])]
        ),
        tags: ['User'],
        responses: [
            new Response(
                response: HttpResponse::HTTP_CREATED,
                description: 'Successful response',
                content: [new Model(type: UserModel::class, groups: [AccessGroup::USER_READ])]
            )
        ]
    )]
    #[Route(path: '/{id}', name: 'update_user', requirements: ['id' => '\d+'], methods: [Request::METHOD_PATCH])]
    public function update(
        #[MapRequestPayload(
            serializationContext: ['groups' => [AccessGroup::USER_WRITE]],
            validationGroups: [AccessGroup::USER_WRITE]
        )]
        UserModel $userModel,
        User $user
    ): JsonResponse
    {
        $updatedUser = $this->userManager->update($userModel, AccessGroup::USER_WRITE, $user);
        return $this->json(
            data: $this->userManager->mapToModel($updatedUser, AccessGroup::USER_READ),
            status: HttpResponse::HTTP_OK,
        );
    }

    #[Patch(
        summary: 'Update user me',
        requestBody: new RequestBody(
            content: [new Model(type: UserModel::class, groups: [AccessGroup::USER_WRITE])]
        ),
        tags: ['User'],
        responses: [
            new Response(
                response: HttpResponse::HTTP_CREATED,
                description: 'Successful response',
                content: [new Model(type: UserModel::class, groups: [AccessGroup::USER_READ])]
            )
        ]
    )]
    #[Route(path: '/me', name: 'update_me_user', methods: [Request::METHOD_PATCH])]
    public function updateMe(
        #[MapRequestPayload(
            serializationContext: ['groups' => [AccessGroup::USER_WRITE]],
            validationGroups: [AccessGroup::USER_WRITE]
        )]
        UserModel $userModel,
        #[CurrentUser] User $user
    ): JsonResponse
    {
        $updatedUser = $this->userManager->update($userModel, AccessGroup::USER_WRITE, $user);
        return $this->json(
            data: $this->userManager->mapToModel($updatedUser, AccessGroup::USER_READ),
            status: HttpResponse::HTTP_OK,
        );
    }

    #[Get(
        summary: 'Get user by id',
        tags: ['User'],
        responses: [
            new Response(
                response: HttpResponse::HTTP_OK,
                description: 'Successful response',
                content: [new Model(type: UserModel::class, groups: [AccessGroup::USER_READ])]
            ),
        ]
    )]
    #[Route(path: '/{id}', name: 'one_user', requirements: ['id' => '\d+'], methods: [Request::METHOD_GET])]
    public function one(User $user): JsonResponse
    {
        return $this->json(
            data: $this->userManager->mapToModel($user, AccessGroup::USER_READ),
            status: HttpResponse::HTTP_OK,
        );
    }

    #[Get(
        summary: 'Get user me',
        tags: ['User'],
        responses: [
            new Response(
                response: HttpResponse::HTTP_OK,
                description: 'Successful response',
                content: [new Model(type: UserModel::class, groups: [AccessGroup::USER_READ])]
            ),
        ]
    )]
    #[Route(path: '/me', name: 'one_me_user', methods: [Request::METHOD_GET])]
    public function oneMe(#[CurrentUser] User $user): JsonResponse
    {
        return $this->json(
            data: $this->userManager->mapToModel($user, AccessGroup::USER_READ),
            status: HttpResponse::HTTP_OK,
        );
    }

    #[Get(
        summary: 'Get list of users',
        tags: ['User'],
        parameters: [
            new Parameter(
                name: 'search',
                description: 'Filter by fields \'First Name\' and \'Last Name\' and \'Email\' and \'UserName\'',
                in: 'query'
            ),
        ],
        responses: [
            new Response(
                response: HttpResponse::HTTP_OK,
                description: 'Successful response',
                content: [new Model(type: UserModelList::class, groups: [AccessGroup::USER_READ])]
            ),
        ]
    )]
    #[Route(path: '', name: 'list_user', methods: [Request::METHOD_GET])]
    public function list(RequestStack $requestStack): JsonResponse
    {
        $entities = $this->userManager->getList();
        return $this->json(
            data: $this->userManager->mapToListModel($entities, AccessGroup::USER_READ),
            status: HttpResponse::HTTP_OK,
        );
    }

    #[Delete(
        summary: 'Delete user by id',
        tags: ['User'],
        responses: [
            new Response(
                response: HttpResponse::HTTP_NO_CONTENT,
                description: 'Successful response',
            ),
        ]
    )]
    #[Route(path: '/{id}', name: 'delete_user', requirements: ['id' => '\d+'], methods: [Request::METHOD_DELETE])]
    public function delete(User $user): JsonResponse
    {
        $this->userManager->delete($user);
        return $this->json(
            data: ['status' => true],
            status: HttpResponse::HTTP_NO_CONTENT,
        );
    }
}
