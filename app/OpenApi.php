<?php

namespace App;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: 'v1.0.0-beta',
    description: 'Тестовое задание',
    title: 'CRUD для товара',
    contact: new OA\Contact(name: 'Cyrille', email: 'cyril2lambda@gmail.com'),
)]
class OpenApi
{
}
