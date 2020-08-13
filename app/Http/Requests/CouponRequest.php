<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'coupon_code' => 'required',
            'name' => 'required|string',
            'description' => 'required|string',
            'expired' => 'required|date',
            'status' => 'required|integer',
            'discount' => 'required|numeric|min:1|max:100'
        ];
    }
}
