<?php

namespace App\Gamify\Points;

use App\Models\Transaction;
use QCod\Gamify\PointType;

class PurchaseAmountReward extends PointType
{
    protected $name = 'Purchase Reward';

    /**
     * Point constructor
     *
     * @param $subject
     */
    public function __construct(Transaction $subject)
    {
        $this->subject = $subject;
    }

    /**
     * User who will be receive points
     *
     * @return mixed
     */
    public function payee()
    {
        return $this->getSubject()->customer;
    }

    public function getPoints()
    {
        return floor($this->getSubject()->amount / 10000);
    }

    public function storeReputation($meta = [])
    {
        $meta = [
            'amount'         => $this->getSubject()->amount,
            'divide_by'      => 10000,
            'transaction_id' => $this->getSubject()->transaction_id,
        ];

        return parent::storeReputation($meta);
    }
}
