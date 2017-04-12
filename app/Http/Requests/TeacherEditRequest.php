<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TeacherEditRequest extends Request
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
            'txtname' => 'required|min:3',
            'txtpassword' => 'min:6',
            'txtrepassword' => 'same:txtpassword'
        ];
    }
     public function messages()
    {
    return [

        'txtname.required'  => 'Vui lòng nhập tên đầy đủ',
        'txtname.min'  => 'Tên phải trên 3 kí tự',
        'txtpassword.min'  => 'Mật khẩu phải trên 6 kí tự',
        'txtrepassword.same'  => 'Mật khẩu phải trùng nhau',


    ];
    }
}