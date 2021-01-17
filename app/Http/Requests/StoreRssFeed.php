<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreRssFeed
 *
 * @package App\Http\Requests
 */
class StoreRssFeed extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:100',
            'url' => 'required|url|unique:App\Models\Data\RssFeed,url',
        ];
    }
}