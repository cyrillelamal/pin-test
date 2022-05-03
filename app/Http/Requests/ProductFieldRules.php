<?php

namespace App\Http\Requests;

use App\Models\Status;
use Illuminate\Validation\Rule;

trait ProductFieldRules
{
    protected function getNameRules(): array
    {
        return [
            'required',
            'string',
            'min:10',
        ];
    }

    protected function getArticleRules(): array
    {
        return [
            'required',
            'string',
            'regex:/^[a-zA-Z0-9]+$/',
            Rule::unique('products', 'article'),
        ];
    }

    protected function getStatusRules(): array
    {
        $statuses = array_map(fn(Status $status) => $status->value, Status::cases());

        return [
            Rule::in($statuses),
        ];
    }

    protected function getDataRules(): array
    {
        return [
            'array',
        ];
    }
}
