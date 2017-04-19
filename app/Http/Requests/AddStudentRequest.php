<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddStudentRequest extends Request
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
            'txtfirstname' => 'required|min:3',
            'txtlastname' => 'required|min:3',
            'txtemail' => 'required|email',
            'txtphone' => 'required',
            'txtusername' => 'required|min:5|unique:students,username'
        ];
    }
    public function messages()
    {
    return [

        'txtfirstname.required'  => 'Vui lòng nhập tên',
        'txtlastname.required'  => 'Vui lòng nhập họ',
        'txtfirstname.min'  => 'Họ lót phải trên 3 kí tự',
        'txtlastname.min'  => 'Tên phải trên 3 kí tự',
        'txtemail.required' => 'Email không được để trống',
        'txtusername.unique' => 'Mã học viên đã bị trùng',


    ];
    }
}
