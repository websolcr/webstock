<?php

use Domain\Supplier\Models\Supplier;
use Illuminate\Support\Facades\Event;
use Domain\Audit\Listeners\SaveOnAudit;
use Domain\Supplier\Events\CreateSupplierEvent;

beforeEach(fn () => beginTestInsideTenant());

afterEach(fn () => endTestInsideTenant());

test('can list all suppliers', function () {
    Supplier::factory(10)->create();

    $response = $this->get('api/suppliers');

    $response->assertOk();

    $response->assertJsonCount(10);
});

test('can store supplier', function () {
    Event::fake([CreateSupplierEvent::class]);

    $data = [
        'name' => 'Christophe Eichmann IV',
        'email' => 'schaefer.hilda@example.com',
        'address' => '94257 Murl Fork Emmanuelberg, MN 86113-6667',
        'primary_contact_no' => '267.216.8186',
    ];

    $this->postJson('api/suppliers', $data);

    Event::assertListening(CreateSupplierEvent::class, SaveOnAudit::class);

    $this->assertDatabaseHas('suppliers', [...$data]);
});

test('can delete supplier', function () {
    $supplier = Supplier::factory()->create();

    $this->deleteJson('api/suppliers/'.$supplier->id);

    $this->assertSoftDeleted($supplier);
});

test('can update multiple suppliers', function () {
    $supplier1 = Supplier::factory()->create();
    $supplier2 = Supplier::factory()->create();

    $supplier1Data = [
        'id' => $supplier1->id,
        'name' => 'supplier 1 name',
        'email' => 'supllier1@test.com',
        'address' => 'supplier 1 address',
        'primary_contact_no' => '+94 23 2123567',
    ];

    $supplier2Data = [
        'id' => $supplier2->id,
        'name' => 'supplier 2 name',
        'email' => 'supplier2@test.com',
        'address' => 'supplier 2 address',
        'primary_contact_no' => '+98 78 6789 780',
    ];

    $this->putJson('api/suppliers/', ['modifiedSuppliers' => [
        $supplier1Data,
        $supplier2Data,
    ]]);

    collect([$supplier1Data, $supplier2Data])->each(function (array $modifiedData) {
        $this->assertDatabaseHas('suppliers', $modifiedData);
    });
});
