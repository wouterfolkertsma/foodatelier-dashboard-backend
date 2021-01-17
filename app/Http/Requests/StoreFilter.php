<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreFilter
 *
 * @package App\Http\Requests
 */
class StoreFilter extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'name' => 'required|string|min:5|max:100',
            'country_id' => 'required|exists:countries,id',
            'search_term' => 'required|string|min:15|max:250',
        ];
    }
}
