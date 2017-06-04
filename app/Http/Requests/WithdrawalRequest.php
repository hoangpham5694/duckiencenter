<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WithdrawalRequest extends Request
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
            'txtWithdrawal' => 'required|min:0|max:20000000',
        ];
    }
    public function messages()
    {
    return [

        'txtWithdrawal.required'  => 'Vui lòng nhập số tiền rút',
     
        'txtWithdrawal.min'  => 'Số tiền phải tối thiểu 0 đồng',
      
        'txtWithdrawal.max'  => 'Số tiền không được quá 20 triệu đồng',
       
       
    ];
    }
}
