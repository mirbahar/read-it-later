<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

/**
 * @property mixed url
 * @property mixed pocket_id
 */
class ContentDeletedRequest extends  ContentRequest
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
            'url' => 'required|exists:contents'
        ];

    }
}
