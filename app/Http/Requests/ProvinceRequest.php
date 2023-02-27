<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProvinceRequest extends FormRequest
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

    public function prepareForValidation()
    {
        if($this->isMethod('put') && $this->routeIs('edit.province') || $this->isMethod('delete') && $this->routeIs('delete.province')){
            $this->merge([
                'id' => $this->route()->parameters['id'],
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        /** validate delete data */
        if($this->isMethod('delete') && $this->routeIs('delete.province')){
            return [
                'id' => [
                    'required',
                    'numeric',
                    Rule::exists('provinces', 'id')
                ]
            ];
        }

        /** validate edit data */
        if($this->isMethod('put') && $this->routeIs('edit.province')){
            return [
                'id' => [
                    'required',
                    'numeric',
                    Rule::exists('provinces', 'id')
                ],
                'name' => [
                    'required',
                    'min:2',
                    'max:50',
                    Rule::unique('provinces', 'name')
                    ->ignore($this->id)
                ]
            ];
        }

        /** validate add data */
        return [
            'name' => [
                'required',
                'min:2',
                'max:50',
                Rule::unique('provinces', 'name')
            ]
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'ກະລຸນາປ້ອນກ່ອນ...',
            'name.unique' => 'ມີໃນລະບົບເເລ້ວ...',
            'name.min' => 'ຢ່າງໜ້ອຍຕ້ອງ 2...',
            'name.max' => 'ບໍ່ເກີນ 5...',
        ];
    }
}
