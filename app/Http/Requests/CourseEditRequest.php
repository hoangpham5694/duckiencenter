<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CourseEditRequest extends Request
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
            'txtName' => 'required|min:3',
            'txtMaxStudent' => 'numeric|min:1',
            'txtFee' => 'numeric|min:1',
            'txtrepassword' => 'same:txtpassword'
        ];
    }
     public function messages()
    {
    return [

        'txtName.required'  => 'Vui lòng nhập tên đầy đủ',
        'txtName.min'  => 'Tên phải trên 3 kí tự',
        'txtMaxStudent.min'  => 'Số học viên tối thiểu là 1',
        'txtFee.min'  => 'Số tiền tối thiểu là 1',


    ];
    }
}
