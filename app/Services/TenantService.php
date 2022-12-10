<?php

namespace App\Services;

use App\Models\Tenant;

class TenantService
{
    private $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }
    public function createTenant($data)
    {
        $tenant = $this->tenant->create(['id' => $data['tenant_id']]);
        $tenant->domains()->create(['domain' =>  $data['domain']]);

        return $tenant;
    }
}
