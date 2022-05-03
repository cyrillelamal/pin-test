<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property Product $product the updated product.
 * @property string|null $article
 */
class UpdateProductRequest extends FormRequest
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

    protected function getArticleRules(): array
    {
        $rules = [];

        if ($this->has('article')) {
            $rules[] = 'string';
            $rules[] = 'regex:/^[a-zA-Z0-9]+$/';

            if ($this->product->article !== $this->article) {
                $rules[] = Rule::unique('products', 'article');
            }
        }

        return $rules;
    }
}
