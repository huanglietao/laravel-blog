<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            //
            'name'       => 'required|unique:users',
            'password'   => 'required',
            'repassword' => 'required',
        ];
    }

    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'        => '请填写姓名',
            'password.required'    => '请填写密码',
            'repassword.required'  => '请确认密码',
            'name.unique'          => '该账号已存在',
        ];
    }
}
