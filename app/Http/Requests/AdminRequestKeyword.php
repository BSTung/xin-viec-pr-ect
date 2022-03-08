<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequestKeyword extends FormRequest
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
            'k_name' => 'required|max:255|min:2|unique:keywords,k_name,'.$this->id
        ];
    }
    public  function messages(){
        return [
            'k_name.required'    => 'Dữ liệu không được để trống',
            'k_name.unique'      => 'Dữ liệu đã tồn tại',
            'k_name.max'         => 'Dữ liệu quá ký tự cho phép',
            'k_name.min'         => 'Dữ liệu ít nhất 2 ký tự'
        ];
    }
}
