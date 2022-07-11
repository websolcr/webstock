<?php

use Domain\Supplier\Models\Supplier;
use Illuminate\Support\Facades\Event;
use Domain\Audit\Listeners\SaveOnAudit;
use Domain\Supplier\Events\SaveSupplierEvent;

beforeEach(fn () => beginTestInsideTenant());

afterEach(fn () => endTestInsideTenant());

test('can list all suppliers', function () {
    Supplier::factory(10)->create();

    $response = $this->get('api/suppliers');

    $response->assertOk();

    $response->assertJsonCount(10);
});

test('can store supplier', function () {
    Event::fake([SaveSupplierEvent::class]);

    $data = [
        'name' => 'Christophe Eichmann IV',
        'email' => 'schaefer.hilda@example.com',
        'address' => '94257 Murl Fork Emmanuelberg, MN 86113-6667',
        'primary_contact_no' => '267.216.8186',
    ];

    $this->postJson('api/suppliers', $data);

    Event::assertListening(SaveSupplierEvent::class, SaveOnAudit::class);

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
        'name' => $supplier1->name,
        'email' => $supplier1->email,
        'address' => $supplier1->address,
        'primary_contact_no' => $supplier1->primary_contact_no,
        'secondary_contact_no' => $supplier1->secondary_contact_no,
    ];

    $supplier2Data = [
        'id' => $supplier2->id,
        'name' => $supplier2->name,
        'email' => $supplier2->email,
        'address' => $supplier2->address,
        'primary_contact_no' => $supplier2->primary_contact_no,
        'secondary_contact_no' => $supplier2->secondary_contact_no,
    ];

    $this->putJson('api/suppliers/', ['modifiedSuppliers' => [
        ...$supplier1Data,
        ...$supplier2Data,
    ]]);

    collect([$supplier1Data, $supplier2Data])->each(function (array $modifiedData) {
        $this->assertDatabaseHas('suppliers', $modifiedData);
    });
});
