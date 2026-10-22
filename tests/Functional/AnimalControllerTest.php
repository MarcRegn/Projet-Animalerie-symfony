<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AnimalControllerTest extends WebTestCase
{
    public function testAnimalListIsReachable(): void
    {
        $client = static::createClient();
        $client->request('GET', '/animal');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('h1');
    }
}
