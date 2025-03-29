<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'payment_method' => ['required', 'in:credit,convenience,bank'],
            'address_id' => ['required', 'exists:addresses,id'],
        ];
    }
}
