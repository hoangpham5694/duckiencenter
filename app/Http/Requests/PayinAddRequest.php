<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PayinAddRequest extends Request
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
            'txtrealmoney' => 'required|min:0|max:5000000',
            'txtvirtualmoney' => 'required|min:0|max:5000000',
        ];
    }
    public function messages()
    {
    return [

        'txtrealmoney.required'  => 'Vui lòng nhập số tiền thu',
        'txtvirtualmoney.required'  => 'Vui lòng nhập số tiền cộng vào tài khoản',
        'txtrealmoney.min'  => 'Số tiền phải tối thiểu 0 đồng',
        'txtvirtualmoney.min'  => 'Số tiền phải tối thiểu 0 đồng',
        'txtrealmoney.max'  => 'Số tiền không được quá 5 triệu đồng',
        'txtvirtualmoney.max'  => 'Số tiền không được quá 5 triệu đồng',
       
    ];
    }
}
