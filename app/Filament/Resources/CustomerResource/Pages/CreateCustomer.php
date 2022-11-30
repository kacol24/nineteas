<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Actions\Fortify\CreateNewUser;
use App\Filament\Resources\CustomerResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $customer = (new CreateNewUser())->create($data);
        event(new Registered($customer));

        return $customer;
    }
}
