<?php

declare(strict_types=1);

namespace App\Controller\v1;

use App\Manager\UserManager;
use App\Model\Error\ErrorResponseModel;
use App\Model\UserModel;
use App\Security\AccessGroup;
use App\Service\SecurityService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    public function __construct(
        private readonly SecurityService $securityService,
        private readonly UserManager $userManager,
        private readonly TranslatorInterface $translator
    ) {}

    #[Post(
        summary: 'Register a new user',
        requestBody: new RequestBody(
            content: [new Model(type: UserModel::class, groups: [AccessGroup::USER_SIGN])]
        ),
        tags: ['Auth'],
        responses: [
            new Response(
                response: HttpResponse::HTTP_CREATED,
                description: 'Successful response',
                content: [new Model(type: UserModel::class, groups: [AccessGroup::USER_SIGN_RESPONSE])]
            ),
            new Response(
                response: HttpResponse::HTTP_UNPROCESSABLE_ENTITY,
                description: 'Validation error',
                content: [new Model(type: ErrorResponseModel::class)]
            )
        ]
    )]
    #[Route(path: '/register', name: 'app_api_register', requirements: ['id' => '\d+'], methods: [Request::METHOD_POST])]
    public function register(
        #[MapRequestPayload(
            serializationContext: ['groups' => [AccessGroup::USER_SIGN]],
            validationGroups: [AccessGroup::USER_SIGN]
        )]
        UserModel $userModel
    ): JsonResponse
    {
        $user = $this->securityService->register($userModel);
        return $this->json(
            data: $this->userManager->mapToModel($user, AccessGroup::USER_SIGN_RESPONSE),
            status: HttpResponse::HTTP_OK,
        );
    }
}
