<?php

namespace Modules\Loan\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class RepaymentResource extends Resource
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
            'amount' => (integer)$this->amount,
            'created_at' => (string)$this->created_at,
        ];
    }
}
