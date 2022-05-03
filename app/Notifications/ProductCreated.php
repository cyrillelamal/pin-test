<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Notifications\Notification;

class ProductCreated extends Notification
{
    use Queueable;

    private Product $product;

    /**
     * @param Product $product the created product.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): Mailable
    {
        return (new \App\Mail\ProductCreated($this->product))->to($notifiable);
    }

    public function toArray(): array
    {
        return [];
    }
}
