<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\Status;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;
use RuntimeException;

#[OA\Schema(
    properties: [
        new OA\Property(property: 'article', description: 'Only latin letters and digits', type: 'string'),
        new OA\Property(property: 'name', type: 'string'),
        new OA\Property(property: 'status', description: 'Status displayed to the user, i.e. translated one', type: 'string', example: 'Не доступен'),
        new OA\Property(property: 'status_value', description: 'Status used internally as input value', type: 'string', enum: [Status::AVAILABLE, Status::UNAVAILABLE], example: 'unavailable'),
        new OA\Property(property: 'data', type: 'object'),
    ],
)]
class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        $product = $this->resource;

        if (!($product instanceof Product)) {
            Log::error('Unexpected resource model', ['expected' => Product::class, 'got' => $product]);
            throw new RuntimeException('Unexpected resource model');
        }

        $data = parent::toArray($request);

        $data['status'] = trans('status.' . $product->status->value);
        $data['status_value'] = $product->status->value;

        return $data;
    }
}
