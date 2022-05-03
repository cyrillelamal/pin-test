<?php

namespace App\Observers;

use App\Jobs\NotifyAboutNewProduct;
use App\Models\Product;

class ProductObserver
{
    public function created(Product $product): void
    {
        NotifyAboutNewProduct::dispatch($product);
    }
}
