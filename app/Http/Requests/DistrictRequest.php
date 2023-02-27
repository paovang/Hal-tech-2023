<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DistrictRequest extends FormRequest
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
        if($this->isMethod('put') && $this->routeIs('edit.district') || $this->isMethod('delete') && $this->routeIs('delete.district')){
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
        /** Delete */
        if($this->isMethod('delete') && $this->routeIs('delete.district')){
            return [
                'id' => [
                    'required',
                    'numeric',
                    Rule::exists('districts', 'id')
                ]
            ];
        }

        /** Edit */
        if($this->isMethod('put') && $this->routeIs('edit.district')){
            return [
                'name' => [
                    'required',
                    'max:50',
                    Rule::unique('districts', 'name')
                        ->where(function ($query) {
                            $query->where('province_id', '=', $this->province_id);
                        })
                    ->ignore($this->id)
                ],
                'province_id' => [
                    'required',
                    'numeric',
                    Rule::exists('provinces', 'id')
                ]
            ];
        }


        /** Add */
        return [
            'name' => [
                'required',
                'max:50',
                Rule::unique('districts', 'name')
                    ->where(function ($query) {
                        $query->where('province_id', '=', $this->province_id);
                    })
            ],
            'province_id' => [
                'required',
                'numeric',
                Rule::exists('provinces', 'id')
            ]
        ];
    }
}
