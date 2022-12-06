<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Actions\Fortify\CreateNewUser;
use App\Filament\Resources\CustomerResource;
use App\Models\Customer;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        Validator::make($data, [
            'name'          => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required'],
            'phone'         => [
                'required',
                Rule::unique(Customer::class),
            ],
        ])->validate();

        $data['password'] = Hash::make($data['date_of_birth']);
        $customer = (new CreateNewUser())->create($data, validate: false);
        event(new Registered($customer));

        return $customer;
    }
}
