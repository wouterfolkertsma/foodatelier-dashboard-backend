<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreUser
 *
 * @package App\Http\Requests
 */
class StoreUser extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        $rules = [
            'first_name' => 'required|string|min:2|max:100',
            'email' => ['required', 'email'],
            'last_name' => 'required|string|min:2|max:191',
            'avatar_url' => 'nullable|string|min:2|max:191',
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable'
        ];

        $rules['email'][] = Rule::unique('users', 'email');

        return $rules;
    }

    /**
     * @return array
     */
    public static function translations(): array
    {
        return [
            'first_name' => __('validation.attributes.first_name'),
            'email' => __('validation.attributes.email'),
            'last_name' => __('validation.attributes.last_name'),
            'avatar_url' => __('validation.attributes.avatar_url'),
            'role_id' => __('validation.attributes.role')
        ];
    }
}