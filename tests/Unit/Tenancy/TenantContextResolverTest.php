<?php

namespace Tests\Unit\Tenancy;

use App\Tenancy\TenantContextResolver;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TenantContextResolverTest extends TestCase
{
    public function testItReturnsEmptyContextWhenNoAuthenticatedUserExists(): void
    {
        Auth::shouldReceive('check')
            ->once()
            ->andReturn(false);

        $resolver = new TenantContextResolver();
        $context = $resolver->resolve(Request::create('/api/v1/health', 'GET'));

        $this->assertNull($context->userId);
        $this->assertNull($context->projectId);
        $this->assertFalse($context->isSuperAdmin);
    }

    public function testItReturnsUserContextWithoutProjectWhenHeaderIsMissing(): void
    {
        $fakeUser = new class() implements Authenticatable {
            public function getAuthIdentifierName(): string
            {
                return 'id';
            }

            public function getAuthIdentifier(): int
            {
                return 42;
            }

            public function getAuthPasswordName(): string
            {
                return 'password';
            }

            public function getAuthPassword(): string
            {
                return 'secret';
            }

            public function getRememberToken(): ?string
            {
                return null;
            }

            public function setRememberToken($value): void
            {
            }

            public function getRememberTokenName(): string
            {
                return 'remember_token';
            }

            public function hasRole(string $role): bool
            {
                return false;
            }
        };

        Auth::shouldReceive('check')
            ->once()
            ->andReturn(true);

        Auth::shouldReceive('user')
            ->once()
            ->andReturn($fakeUser);

        $resolver = new TenantContextResolver();
        $context = $resolver->resolve(Request::create('/api/v1/health', 'GET'));

        $this->assertSame(42, $context->userId);
        $this->assertNull($context->projectId);
        $this->assertFalse($context->isSuperAdmin);
    }
}
