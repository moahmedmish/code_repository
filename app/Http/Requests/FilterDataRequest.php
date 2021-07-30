<?php

namespace App\Http\Requests;

use App\Enums\RepositoriesEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class FilterDataRequest extends FormRequest
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
        //dd($this->code_repository);
        return [
            'created_at'=> 'required|date|date_format:Y-m-d',
            'language' => 'string',
            'limit' => 'integer',
            'order' => ['string', Rule::in(['asc', 'desc'])],
            'code_repository'=>['string', Rule::in(RepositoriesEnum::getConstList())]
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        throw new HttpResponseException(
            response(
                [
                    'message' => 'validation',
                     'data' =>$errors
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    /**
     *
     */
    protected function prepareForValidation()
    {

        $this->code_repository = ($this->code_repository == '') ? null : $this->code_repository;
        $this->order = ($this->order == '') ? 'desc' : $this->order;
        $this->merge(['code_repository'=>$this->code_repository,'order'=>$this->order]);
    }
}
