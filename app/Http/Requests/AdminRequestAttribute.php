<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequestAttribute extends FormRequest
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
            'atb_name' => 'required|max:255|min:2|unique:attributes,atb_name,'.$this->id
        ];
    }
    public  function messages(){
        return [
            'atb_name.required'          => 'Thuộc tính không được để trống',
            'atb_name.unique'            => 'Thuộc tính đã tồn tại',
            'atb_type.required'          => 'Nhóm thuộc tính không được để trống',
            'atb_category_id.required'   => 'Danh mục thuộc tính không được để trống'
        ];
    }
}
