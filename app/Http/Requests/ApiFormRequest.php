<?php
/**
 * Created by PhpStorm.
 * User: tam
 * Date: 6/11/18
 * Time: 6:33 PM
 */

namespace App\Http\Requests;

use App\Exceptions\InvalidInputDataException;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class ApiFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     * @param Validator $validator
     * @throws InvalidInputDataException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new InvalidInputDataException(implode(". ", array_collapse($errors)));
    }
}
