<?php

namespace App\Http\Requests;

use App\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateProjectRequest extends FormRequest
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
            'title'=>'sometimes|required',
            'description'=> 'sometimes|required|max:80',
            'notes'=>'nullable|max:255',
        ];
    }

    public function project()
    {
        //when use the Route Model Binding
        //return $this->route('project');

        //if we won't use the Route Model Binding
        //we must manual search the project and return it
        return Project::findOrFail($this->route('project'));
    }

    public function save()
    {
        $project = $this->project();

        $project->update($this->validated());

        return $project;

        //OR using Laravel Higher Order Tap Proxy
        return tap($this->project())->update($this->validated());
    }
}
