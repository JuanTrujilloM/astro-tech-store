<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_user_balance_is_stored_correctly(): void
    {
        $user = new User;
        $user->setBalance(5000);

        $this->assertEquals(5000, $user->getBalance());
    }

    public function test_user_balance_is_overwritten_on_update(): void
    {
        $user = new User;
        $user->setBalance(1000);

        $user->setBalance(750);

        $this->assertEquals(750, $user->getBalance());
    }

    public function test_user_role_client_is_stored_correctly(): void
    {
        $user = new User;
        $user->setRole('client');

        $this->assertEquals('client', $user->getRole());
    }

    public function test_user_role_admin_is_stored_correctly(): void
    {
        $user = new User;
        $user->setRole('admin');

        $this->assertEquals('admin', $user->getRole());
    }

    public function test_user_name_is_stored_correctly(): void
    {
        $user = new User;
        $user->setName('Juan Trujillo');

        $this->assertEquals('Juan Trujillo', $user->getName());
    }

    public function test_user_email_is_stored_correctly(): void
    {
        $user = new User;
        $user->setEmail('juan@example.com');

        $this->assertEquals('juan@example.com', $user->getEmail());
    }
}
