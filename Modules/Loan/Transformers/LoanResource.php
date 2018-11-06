<?php

namespace Modules\Loan\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class LoanResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (integer)$this->id,
            'user_id' => (integer)$this->user_id,
            'amount' => (integer)$this->amount,
            'duration' => (integer)$this->duration,
            'repayment_frequency' => (integer)$this->repayment_frequency,
            'interest_rate' => (float)$this->interest_rate,
            'arrangement_fee' => (integer)$this->arrangement_fee,
            'repayment_amount' => (integer)$this->getRepaymentAmount(),
            'loan_date_at' => (string)$this->loan_date_at,
            'due_date_at' => (string)$this->due_date_at,
            'status' => (integer)$this->status,
            'repayments' => $this->when($this->whenLoaded('repayments'), RepaymentResource::collection($this->repayments))
        ];
    }
}
