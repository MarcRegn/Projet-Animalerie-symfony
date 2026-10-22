<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CreateAnimalControllerTest extends WebTestCase
{
    public function testAnonymousUserCannotAccessAnimalCreation(): void
    {
        $client = static::createClient();
        $client->request('GET', '/create-animal');

        self::assertResponseRedirects();
    }
}
