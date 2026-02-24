<?php

namespace App\Tenancy;

class TenantContext
{
    public function __construct(
        public readonly ?int $userId,
        public readonly ?int $projectId,
        public readonly bool $isSuperAdmin,
    ) {
    }

    public static function empty(): self
    {
        return new self(null, null, false);
    }

    public function hasAuthenticatedUser(): bool
    {
        return $this->userId !== null;
    }

    public function hasProjectContext(): bool
    {
        return $this->projectId !== null;
    }
}
