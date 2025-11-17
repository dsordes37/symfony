<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\ProfessorRepository;

final class ProfessorController extends AbstractController
{
    #[Route('api/professores', name: 'api_professor')]
    public function index(ProfessorRepository $repo): JsonResponse
    {
        return $this->json($repo->findAll());
    }
}
