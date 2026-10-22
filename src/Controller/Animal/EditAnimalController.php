<?php

namespace App\Controller\Animal;

use App\Entity\Animal;
use App\Form\AnimalType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Twig\Environment;

#[AsController]
#[IsGranted('ROLE_MEMBER')]
#[Route(path: '/animal/edit/{id}', name: 'edit-animal', methods: ['GET', 'POST'])]
final class EditAnimalController
{
    public function __invoke(
        Animal $animal,
        Request $request,
        Environment $twig,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        RouterInterface $router
    ): Response {
        $form = $formFactory->create(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $request->getSession()->getFlashBag()->add('success', 'Animal modifié.');

            return new RedirectResponse(
                $router->generate('list-animal'),
                Response::HTTP_FOUND
            );
        }

        return new Response($twig->render('editAnimal.html.twig', [
            'form' => $form->createView(),
            'animal' => $animal,
        ]));
    }
}
