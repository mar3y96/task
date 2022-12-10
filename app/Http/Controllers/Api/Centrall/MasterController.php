<?php

namespace App\Http\Controllers\Api\Centrall;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Centrall\TenantRequest;
use App\Services\TenantService;

class MasterController extends Controller
{

    private $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function store(TenantRequest $request)
    {
        $tenant = $this->tenantService
            ->createTenant($request->validated());

        return response()
            ->json(
                [
                    'message' => 'created successfuly',
                    'tenant' => $tenant
                ]
            );
    }
}
