<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use App\Policies\ProductPolicy;
use PHPUnit\Framework\TestCase;

class ProductPolicyTest extends TestCase
{
    private ProductPolicy $policy;

    protected function setUp(): void
    {
        parent::setUp();

        $this->policy = new ProductPolicy(
            Role::ADMIN,
        );
    }

    /**
     * @test
     */
    public function anonymous_user_cannot_update_products()
    {
        $this->assertFalse($this->policy->update(null));
    }

    /**
     * @test
     */
    public function admin_can_update_products()
    {
        $admin = new User(['roles' => collect([Role::ADMIN])]);

        $this->assertTrue($this->policy->update($admin));
    }
}
