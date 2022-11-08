<?php

namespace App\Gamify\Points;

use QCod\Gamify\PointType;

class TransactionReward extends PointType
{
    /**
     * Number of points
     *
     * @var int
     */
    public $points = 1;

    protected $name = 'Transaction Reward';

    /**
     * Point constructor
     *
     * @param $subject
     */
    public function __construct($subject)
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

    public function storeReputation($meta = [])
    {
        $meta = [
            'transaction_id' => $this->getSubject()->transaction_id,
        ];

        return parent::storeReputation($meta);
    }
}
