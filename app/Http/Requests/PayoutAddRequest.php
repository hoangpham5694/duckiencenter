<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PayoutAddRequest extends Request
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
            'txtpaymoney' => 'required|min:0|max:20000000',
        ];
    }
    public function messages()
    {
    return [

        'txtpaymoney.required'  => 'Vui lòng nhập số tiền thu',
        'txtpaymoney.required'  => 'Vui lòng nhập số tiền cộng vào tài khoản',
        'txtpaymoney.min'  => 'Số tiền phải tối thiểu 0 đồng',
      
        'txtpaymoney.max'  => 'Số tiền không được quá 10 triệu đồng',
       
       
    ];
    }
}
