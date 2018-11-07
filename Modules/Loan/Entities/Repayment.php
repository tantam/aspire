<?php

namespace Modules\Loan\Entities;

use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    const PAID_STATUS = 1;
    const UNPAID_STATUS = 0;

    protected $fillable = [
        'loan_id',
        'due_date',
        'amount',
        'status',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }

}
