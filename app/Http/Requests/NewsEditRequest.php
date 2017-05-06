<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewsEditRequest extends Request
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
            'txtTitle' => 'required|max:250',
          
            'txtContent' => 'required',
         
        ];
    }
     public function messages()
    {
    return [

        'txtTitle.required'  => 'Vui lòng nhập tiêu đề',
        'txtTitle.max'  => 'Tiêu đề quá dài',
        'txtContent.required'  => 'Nội dung không được trống',
    ];
    }
}
