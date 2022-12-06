<?php

namespace App\Actions\Fortify;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @param  bool  $validate
     * @return \App\Models\User
     */
    public function create(array $input, $validate = true)
    {
        if ($validate) {
            Validator::make($input, [
                'name'     => ['required', 'string', 'max:255'],
                'email'    => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(Customer::class),
                ],
                'password' => $this->passwordRules(),
            ])->validate();
        }

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
        $lastSequence = Customer::query()
                                ->where('sequence_group', $sequenceGroup)
                                ->max('sequence');

        $input['sequence_group'] = $sequenceGroup;
        $input['sequence'] = (int) $lastSequence + 1;
        $input['member_id'] = $input['sequence_group'].str_pad($input['sequence'], 8, 0, STR_PAD_LEFT);
        $input['password'] = Hash::make($input['password']);

        return Customer::create($input);
    }
}
