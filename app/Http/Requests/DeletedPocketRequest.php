<?php

namespace App\Http\Requests;


/**
 * @property mixed id
 */
class DeletedPocketRequest extends PocketRequest
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
            'id' => 'required|exists:pockets',
        ];
    }
}
