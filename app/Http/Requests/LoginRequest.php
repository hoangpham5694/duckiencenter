<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginRequest extends Request
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
            'txtUsername' => 'required',
            'txtPassword' => 'required',
            'selectRole' => 'not_in:role'
        ];
    }
      public function messages()
    {
    return [
        'txtUsername.required' => 'Vui lòng nhập username',
        'txtPassword.required'  => 'Vui lòng nhập password',
        'selectRole.not_in' => 'Vui lòng chọn vai trò đăng nhập'
    ];
    }
}
