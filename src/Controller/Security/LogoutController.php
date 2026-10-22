<?php

namespace App\Controller\Security;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LogoutController
{
    #[Route('/logout', name: 'logout', methods: ['GET'])]
    public function __invoke(): Response
    {
        throw new \LogicException(
            'Cette route doit être interceptée par Symfony Security.'
        );
    }
}
