<?php

namespace App\Tenancy;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantContextResolver
{
    private const PROJECT_PUBLIC_ID_HEADER = 'X-Project-Public-Id';

    public function resolve(Request $request): TenantContext
    {
        if (!Auth::check()) {
            return TenantContext::empty();
        }

        $authenticatedUser = Auth::user();

        if ($authenticatedUser === null) {
            return TenantContext::empty();
        }

        $projectPublicId = $this->resolveProjectPublicId($request);
        $isSuperAdmin = $authenticatedUser->hasRole('super-admin');

        if ($projectPublicId === null) {
            return new TenantContext($authenticatedUser->getAuthIdentifier(), null, $isSuperAdmin);
        }

        if ($isSuperAdmin) {
            $project = Project::withoutGlobalScopes()
                ->where('public_id', '=', $projectPublicId)
                ->first();

            if ($project === null) {
                return new TenantContext($authenticatedUser->getAuthIdentifier(), null, true);
            }

            return new TenantContext($authenticatedUser->getAuthIdentifier(), $project->getKey(), true);
        }

        $project = Project::query()
            ->where('public_id', '=', $projectPublicId)
            ->where('user_id', '=', $authenticatedUser->getAuthIdentifier())
            ->first();

        if ($project === null) {
            return new TenantContext($authenticatedUser->getAuthIdentifier(), null, false);
        }

        return new TenantContext($authenticatedUser->getAuthIdentifier(), $project->getKey(), false);
    }

    private function resolveProjectPublicId(Request $request): ?string
    {
        $projectPublicId = $request->header(self::PROJECT_PUBLIC_ID_HEADER);

        if (!is_string($projectPublicId)) {
            return null;
        }

        $normalizedProjectPublicId = trim($projectPublicId);

        if ($normalizedProjectPublicId === '') {
            return null;
        }

        return $normalizedProjectPublicId;
    }
}
