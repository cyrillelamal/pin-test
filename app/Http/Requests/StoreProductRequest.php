<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    use ProductFieldRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'article' => $this->getArticleRules(),
            'name' => $this->getNameRules(),
            'status' => $this->getStatusRules(),
            'data' => $this->getDataRules(),
        ];
    }
}
