<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequestCategory extends FormRequest
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
            'c_name' => 'required|max:255|min:2|unique:categories,c_name,'.$this->id
        ];
    }
    public  function messages(){
        return [
            'c_name.required'    => 'Dữ liệu không được để trống',
            'c_name.unique'      => 'Dữ liệu đã tồn tại',
            'c_name.max'         => 'Dữ liệu quá ký tự cho phép',
            'c_name.min'         => 'Dữ liệu ít nhất 2 ký tự'
        ];
    }
}
