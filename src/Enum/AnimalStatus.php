<?php

namespace App\Enum;

enum AnimalStatus: string
{
    case Available = 'available';
    case AdoptionPending = 'adoption_pending';
    case Adopted = 'adopted';
}
