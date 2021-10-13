<?php

namespace Modules\InitApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleInstallRequest extends FormRequest
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

        $rules = array();

        $rules = [
            'purchase_code'     => 'required',
            'name'               => 'required',

        ];


        return $rules;
    }

    /**
     * Translate fields with user friendly name.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'purchase_code' => trans('service::install.purchase_code'),
            'name'          => trans('service::install.module_name')
        ];
    }
}
