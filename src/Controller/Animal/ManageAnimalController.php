<?php

namespace App\Controller\Animal;

use App\Repository\AnimalRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Twig\Environment;

#[AsController]
#[IsGranted('ROLE_MEMBER')]
#[Route(path: '/gestion/animaux', name: 'manage-animal', methods: ['GET'])]
final class ManageAnimalController
{
    public function __invoke(
        AnimalRepository $animalRepository,
        Environment $twig
    ): Response {
        return new Response($twig->render('manageAnimal.html.twig', [
            'animals' => $animalRepository->findBy([], ['id' => 'DESC']),
        ]));
    }
}
