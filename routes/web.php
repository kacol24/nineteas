<?php

use App\Gamify\Points\PurchaseAmountReward;
use App\Gamify\Points\RegistrationReward;
use App\Gamify\Points\TransactionReward;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('customer/{customer}', function (Customer $customer) {
    //$transaction = new Transaction([
    //    'amount' => 36000,
    //]);
    //
    //$customer->givePoint(new TransactionReward($transaction));
    //$customer->givePoint(new PurchaseAmountReward($transaction));

    $customer->givePoint(new RegistrationReward($customer));

    return $customer->reputations;
});

Route::view('loyalty', 'loyalty');

Route::get('loyalty', function () {
    $data = [];

    if (request()->has('member_id')) {
        $memberId = request('member_id');
        $data['customer'] = Customer::where('member_id', $memberId)->firstOrFail();
    }

    return view('loyalty', $data);
})->name('loyalty');

Route::post('loyalty', function (Request $request) {
    $memberId = $request->member_id;
    $amount = $request->amount;

    $customer = Customer::where('member_id', $memberId)->firstOrFail();
    $transaction = new Transaction();
    $transaction->transaction_id = 'INV/20221108/000002';
    $transaction->amount = $amount;

    $customer->givePoint(new TransactionReward($transaction));
    $customer->givePoint(new PurchaseAmountReward($transaction));

    return redirect()->route('loyalty', ['member_id' => $customer->member_id]);
});

Route::get('check-points', function () {
    $data = [];

    if (request()->has('member_id')) {
        $memberId = request('member_id');
        $memberId = str_replace('-', '', $memberId);

        $customer = Customer::query()
                            ->where('member_id', $memberId)
                            ->orWhere('phone', $memberId)
                            ->firstOrFail();
        $data['customer'] = $customer;
    }

    return view('check_points', $data);
})
     ->name('check_points');
