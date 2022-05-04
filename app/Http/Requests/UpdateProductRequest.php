<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use OpenApi\Attributes as OA;

/**
 * @property Product $product the updated product.
 * @property string|null $article
 */
#[OA\Schema(
    properties: [
        new OA\Property(property: 'article', description: 'Only latin letters and digits', type: 'string'),
        new OA\Property(property: 'name', type: 'string', minLength: 10),
        new OA\Property(property: 'status', type: 'string', enum: [Status::AVAILABLE, Status::UNAVAILABLE]),
        new OA\Property(property: 'data', description: 'Optional attributes as Key-Value pairs', type: 'object'),
    ],
)]
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
