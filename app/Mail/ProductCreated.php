<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductCreated extends Mailable
{
    use Queueable, SerializesModels;

    private Product $product;

    /**
     * @param Product $product the newly created product.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function build(): self
    {
        return $this->view('notifications.product.created', [
            'product' => $this->product,
        ]);
    }
}
