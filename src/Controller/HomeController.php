<?php

declare(strict_types=1);

namespace App\Controller;

use OpenApi\Attributes\Get;
use OpenApi\Attributes\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Get(
        summary: 'Home Page',
        responses: [
            new Response(
                response: 200,
                description: 'Successful response'
            )
        ]
    )]
    #[Route(path: '/', name: 'app_home', methods: [Request::METHOD_GET])]
    public function index(): JsonResponse
    {
        return $this->json(
            data: ['status' => true]
        );
    }
}
