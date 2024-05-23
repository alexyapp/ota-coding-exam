<?php

namespace App\Http\Requests;

use App\Enums\EmploymentTypes;
use App\Enums\Schedules;
use App\Enums\Seniorities;
use App\Enums\YearsOfExperience;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateJobAdRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'descriptions.*' => ['required'],
            'employment_type' => ['required', Rule::enum(EmploymentTypes::class)],
            'schedule' => ['required', Rule::enum(Schedules::class)],
            'seniority' => ['required', Rule::enum(Seniorities::class)],
            'years_of_experience' => ['required', Rule::enum(YearsOfExperience::class)],
            'subcompany' => ['required'],
            'occupation' => ['required'],
            'department' => ['required'],
        ];
    }
}
