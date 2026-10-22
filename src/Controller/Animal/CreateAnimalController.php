<?php

namespace App\Controller\Animal;

use App\Entity\Animal;
use App\Enum\AnimalStatus;
use App\Form\AnimalType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted('ROLE_MEMBER')]
final class CreateAnimalController extends AbstractController
{
    #[Route('/create-animal', name: 'create-animal', methods: ['GET', 'POST'])]
    public function __invoke(
        Request $request,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response {
        $animal = new Animal();

        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $animal->setSlug(
                    $slugger->slug($animal->getName())->lower()->toString()
                );
                $animal->setStatus(AnimalStatus::Available);

                $entityManager->persist($animal);
                $entityManager->flush();

                $this->addFlash('success', 'Animal ajouté au refuge.');

                return $this->redirectToRoute('list-animal');
            }

            dump($form->getErrors(true));
        }

        return $this->render('addAnimal.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
