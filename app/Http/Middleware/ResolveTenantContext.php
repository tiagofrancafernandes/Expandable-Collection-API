<?php

namespace App\Http\Middleware;

use App\Tenancy\TenantContext;
use App\Tenancy\TenantContextResolver;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenantContext
{
    public function __construct(
        private readonly TenantContextResolver $tenantContextResolver,
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenantContext = $this->tenantContextResolver->resolve($request);

        app()->instance(TenantContext::class, $tenantContext);

        return $next($request);
    }
}
