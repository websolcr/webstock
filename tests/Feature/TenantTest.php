<?php

use App\Models\Tenant;

test('can create organization', function () {
    actingAsSuperAdmin();

    $response = $this->postJson('/api/tenant/create', [
        'name' => 'test organization',
    ]);

    $response->assertNoContent();

    $this->assertDatabaseHas('tenants', [
        'name' => 'test organization',
    ]);
});

test('list all organizations for authenticated user', function () {
    actingAsSuperAdmin();

    collect(['org_1', 'org_2', 'org_3'])->each(function (string $organizationName) {
        Tenant::create([
            'name' => $organizationName,
            'user_id' => auth()->id(),
        ]);
    });

    $response = $this->getJson('api/tenant/index');

    $response->assertJsonCount(3);
});

test('can initialize organization', function () {
    actingAsSuperAdmin();

    $tenant = Tenant::create([
        'name' => 'test organization',
        'user_id' => auth()->id(),
    ]);

    $response = $this->postJson('/api/tenant/'.$tenant->id.'/initialize');

    $response->assertOk();

    $this->assertTrue(tenancy()->initialized);

    $this->assertEquals($tenant->id, tenancy()->tenant->id);
});
