<?php

namespace App\Http\Requests;

use App\User;
use App\Project;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectInvitationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('update', $this->route('project'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'email' => ['required', 'exists:users,email']
            'email' => [
                'required', function($attributes, $value, $fail){
                    if (! User::whereEmail($value)->exists()) {
                        $fail('The user you are inviting must have a Birdboard account.');
                    }
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'email.*' => 'The user you are inviting must have a Birdboard account.'
        ];
    }
}
