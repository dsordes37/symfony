<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\AlunosRepository;

final class AlunosController extends AbstractController
{
    #[Route('/api/alunos', name: 'api_alunos')]
    public function index(AlunosRepository $repo): JsonResponse
    {
        return $this->json($repo->findAll());
    }
}
