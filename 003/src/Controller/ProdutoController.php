<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\ProdutoRepository;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity]
#[ApiResource]

final class ProdutoController extends AbstractController
{
    #[Route('/api/produtos', name: 'api_produto')]
    public function index(ProdutoRepository $repo): JsonResponse
    {
        return $this->json($repo->findAll());
    }
}
