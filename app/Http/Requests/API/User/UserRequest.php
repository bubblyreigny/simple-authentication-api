<?php

namespace App\Http\Requests\API\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Auth::user() || $this->method() === Request::METHOD_POST && request()->route()->getName() == 'register') {
            return true;
        }
    
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->method() === Request::METHOD_POST && in_array(request()->route()->getName(), ['register', 'store'])) {

            $rules = [
                'first_name' => 'required|min:2',
                'last_name' => 'required|min:2',
                'email' => 'required|email|unique:users,email',
                'username' => 'required|unique:users,username',
                'address' => 'required' ,
                'password' => 'required|min:8',
                'postcode' => 'required|numeric',
            ];
        }

        if ($this->method() === Request::METHOD_POST && strpos(request()->route()->getName(), 'update')) {
            $rules = [
                'first_name' => 'required|min:2',
                'last_name' => 'required|min:2',
                'email' => 'required|email|unique:users,email,'.$this->id,
                'username' => 'required|unique:users,username,'.$this->id,
                'address' => 'required' ,
                'password' => 'required|min:8',
                'postcode' => 'required|numeric',
            ];
        }

        return $rules;
    }
}
