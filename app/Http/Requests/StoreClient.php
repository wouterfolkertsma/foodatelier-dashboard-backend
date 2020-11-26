<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreClient
 *
 * @package App\Http\Requests
 */
class StoreClient extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'first_name' => 'required|string|min:2|max:100',
            'email' => 'required|unique:App\Models\User,email',
            'last_name' => 'required|string|min:2|max:191',
        ];
    }
}