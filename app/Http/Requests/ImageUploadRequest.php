<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class ImageUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('content_access');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required', 'string',
            ],
            'category' => [
                'required', 'string',
            ],
            'description' => [

            ],
            'file-upload' => [
                'required', 'array',
            ],
            'file-upload.*' => [
                'image', 'mimes:jpeg,png,jpg,gif,svg|max:10240',
            ],
        ];      
    }
}

       
