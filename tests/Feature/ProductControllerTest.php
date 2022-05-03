<?php

namespace Tests\Feature;

use App\Jobs\NotifyAboutNewProduct;
use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductCreated;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    const INDEX = '/products';
    const STORE = self::INDEX;
    const SHOW = self::INDEX . '/%d'; // sprintf
    const UPDATE = self::SHOW;
    const DESTROY = self::SHOW;

    /**
     * @test
     */
    public function everybody_can_access_the_list_of_products()
    {
        $this->get(self::INDEX)->assertStatus(200);
    }

    /**
     * @test
     */
    public function everybody_can_store_new_products()
    {
        $before = Product::query()->count();

        $this->postJson(self::STORE, $this->getNewProductData())
            ->assertStatus(201);

        $this->assertEquals($before + 1, Product::query()->count());
    }

    /**
     * @test
     */
    public function product_name_must_be_provided()
    {
        $before = Product::query()->count();

        $data = $this->getNewProductData();
        unset($data['name']);

        $this->postJson(self::STORE, $data)
            ->assertStatus(422);

        $this->assertEquals($before, Product::query()->count());
    }

    /**
     * @test
     */
    public function product_name_must_be_at_least_ten_characters_long()
    {
        $before = Product::query()->count();

        $this->postJson(self::STORE, $this->getNewProductData(['name' => Str::random(9)]))
            ->assertStatus(422);

        $this->assertEquals($before, Product::query()->count());
    }

    /**
     * @test
     */
    public function product_article_must_be_provided()
    {
        $before = Product::query()->count();

        $data = $this->getNewProductData();
        unset($data['article']);

        $this->postJson(self::STORE, $data)
            ->assertStatus(422);

        $this->assertEquals($before, Product::query()->count());
    }

    /**
     * @test
     * @dataProvider articles
     */
    public function product_article_must_be_alpha_numeric(string $article, bool $alphanumeric)
    {
        $before = Product::query()->count();

        $this->postJson(self::STORE, $this->getNewProductData(['article' => $article]))
            ->assertStatus($alphanumeric ? 201 : 422);

        $this->assertEquals($alphanumeric ? ++$before : $before, Product::query()->count());
    }

    /**
     * @test
     */
    public function product_article_must_be_unique()
    {
        $before = Product::query()->count();
        /** @var Product $product */
        $product = Product::query()->inRandomOrder()->first();

        $this->postJson(self::STORE, $product->toArray())
            ->assertStatus(422);

        $this->assertEquals($before, Product::query()->count());
    }

    /**
     * @test
     */
    public function everybody_can_see_a_particular_product()
    {
        /** @var Product $product */
        $product = Product::query()->inRandomOrder()->first();

        $this->getJson(sprintf(self::SHOW, $product->id))
            ->assertStatus(200)
            ->assertJson([
                'id' => $product->id,
                'name' => $product->name,
                'article' => $product->article,
            ]);
    }

    /**
     * @test
     */
    public function only_administrators_can_update_products()
    {
        /** @var Product $product */
        $product = Product::query()->inRandomOrder()->first();

        $oldName = $product->name;

        $this->patchJson(sprintf(self::UPDATE, $product->id), $this->getNewProductData())
            ->assertStatus(403);

        $product->refresh();
        $this->assertEquals($oldName, $product->name);

        $admin = new User(['roles' => collect(config('products.role'))]);
        $this->actingAs($admin)->patchJson(sprintf(self::UPDATE, $product->id), $this->getNewProductData())
            ->assertStatus(200);

        $product->refresh();
        $this->assertNotEquals($oldName, $product->name);
    }

    /**
     * @test
     */
    public function everybody_can_destroy_products()
    {
        /** @var Product $product */
        $product = Product::query()->first();

        $this->deleteJson(sprintf(self::DESTROY, $product->id))
            ->assertStatus(204);
    }

    /**
     * @test
     */
    public function when_a_new_product_is_created_the_notification_about_this_is_sent()
    {
        Notification::fake();

        $this->postJson(self::STORE, $this->getNewProductData());

        Notification::assertTimesSent(1, ProductCreated::class);
    }

    /**
     * @test
     */
    public function when_a_new_product_is_created_the_notification_about_this_is_sent_to_the_specified_user()
    {
        Notification::fake();

        $this->postJson(self::STORE, $this->getNewProductData());

        Notification::assertSentTo($this->getNotifiableUser(), ProductCreated::class);
    }

    /**
     * @test
     */
    public function notifications_about_new_products_are_dispatched_through_jobs()
    {
        Bus::fake();

        $this->postJson(self::STORE, $this->getNewProductData());

        Bus::assertDispatched(NotifyAboutNewProduct::class);
    }

    /**
     * @return iterable<string, bool> the article itself and the marker either it's valid.
     */
    public function articles(): iterable
    {
        yield ['', false];
        yield ['+', false];
        yield ['q2', true];
        yield ['2q', true];
        yield ['qq', true];
        yield ['33', true];
    }

    public function getNewProductData($attributes = ['status' => 'available']): array
    {
        return Product::factory()->make($attributes)->toArray();
    }

    public function getNotifiableUser(): User
    {
        return new User(['email' => config('products.email')]);
    }
}
