<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use App\Models\Customer;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $sequenceGroup = '{outlet_id}{year}';
        $sequenceGroup = str_replace(
            [
                '{outlet_id}',
                '{year}',
            ],
            [
                '9000',
                date('Y'),
            ],
            $sequenceGroup
        );
        $lastSequence = Customer::where('sequence_group', $sequenceGroup)
                                ->max('sequence');

        $data['sequence_group'] = $sequenceGroup;
        $data['sequence'] = (int) $lastSequence + 1;
        $data['member_id'] = $data['sequence_group'].str_pad($data['sequence'], 8, 0, STR_PAD_LEFT);

        $customer = parent::handleRecordCreation($data);

        return $customer;
    }
}
