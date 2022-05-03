<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NotifyAboutNewProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Product $product;

    /**
     * @param Product $product the created product.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle(): void
    {
        Notification::send(
            $this->getNotifiable(),
            new ProductCreated($this->product)
        );
    }

    /**
     * @return User an anonymous user model used as the notifiable target.
     */
    protected function getNotifiable(): User
    {
        // We are using an anonymous User object that represents the administrator.
        // That allows us to easily delegate notifications to Laravel system.
        return new User(['email' => config('products.email')]);
    }
}
