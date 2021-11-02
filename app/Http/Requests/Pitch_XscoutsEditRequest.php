<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Pitch_XscoutsEditRequest extends FormRequest
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
            
				"name" => "nullable|string",
				"company" => "nullable|string",
				"phone" => "nullable|string",
				"email" => "nullable|email",
				"focus_field" => "nullable|string",
				"spec_subject" => "nullable|string",
				"prog" => "nullable|string",
				"message" => "nullable",
				"proposal" => "nullable",
				"review_status" => "filled",
				"review_date" => "filled|date",
            
        ];
    }

	public function messages()
    {
        return [
			
            //using laravel default validation messages
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            //eg = 'name' => 'trim|capitalize|escape'
        ];
    }
}
