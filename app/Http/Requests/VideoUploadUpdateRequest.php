<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class VideoUploadUpdateRequest extends FormRequest
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
                
            ],
            'description' => [

            ],
            'file-upload' => [

            ],
            'file-upload.*' => [
                'video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:2048000',
            ]
        ];
    }
}
