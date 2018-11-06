<?php

namespace Modules\Loan\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class CreateLoanRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount'=>'required|min:1|integer',
            'duration'=>'required|min:1|integer',
            'repayment_frequency'=>'required|min:1|integer',
            'interest_rate'=>'required|min:0|numeric',
            'arrangement_fee'=>'required|min:1|integer',
            'loan_date_at' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'amount.min' => 'Amount (in cents) should be a positive integer',
            'amount.integer' => 'Amount (in cents) should be a positive integer',
            'duration.min'  => 'Duration should be a positive integer',
            'duration.integer'  => 'Duration should be a positive integer',
            'repayment_frequency.min'  => 'Repayment frequency should be a positive integer',
            'repayment_frequency.integer'  => 'Repayment frequency should be a positive integer',
            'interest_rate.min'  => 'Interest rate (%) should be equal or greater than 0',
            'interest_rate.numeric'  => 'Interest rate (%) should be a number',
            'arrangement_fee.min'  => 'Arrangement fee (in cents) should be a positive integer',
            'arrangement_fee.integer'  => 'Arrangement fee (in cents) should be a positive integer',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
