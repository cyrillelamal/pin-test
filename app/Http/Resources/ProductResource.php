<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use RuntimeException;

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

        return $data;
    }
}
