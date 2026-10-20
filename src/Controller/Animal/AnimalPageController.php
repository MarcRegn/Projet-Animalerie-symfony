<?php

namespace App\Controller\Animal;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

#[AsController]
#[Route(path: '/animal', name: 'list-animal', methods: ['GET'])]
class AnimalPageController extends AbstractController
{
    public function __invoke(
        Environment $twig,
        AnimalRepository $animalRepository
    ): Response {
        return new Response(
            $twig->render('animal.html.twig', [
                'animals' => $animalRepository->findAnimalsAvailable(),
            ]),
            Response::HTTP_OK
        );
    }
}
