<?php

namespace App\Http\Requests;

use App\Rules\isEmailAddress;
use App\Rules\preventGuest;
use App\Rules\uniqueEmailAddress;
use Illuminate\Foundation\Http\FormRequest;

class InviteRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $postData = $this->all();
        return [
            'emails' => empty($postData['emails'][0])? '' : [new isEmailAddress, new uniqueEmailAddress, new preventGuest],
        ];
    }
}
