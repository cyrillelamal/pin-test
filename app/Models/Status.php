<?php

namespace App\Models;

enum Status: string
{
    case AVAILABLE = 'available';
    case UNAVAILABLE = 'unavailable';
}
