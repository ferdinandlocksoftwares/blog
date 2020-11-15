<?php 

    namespace App\Http\Requests;
    use Illuminate\Foundation\Http\FormRequest;

    class PostFormRequest extends FormRequest
    {
        public function rules()
        {
            return [
                'message' => 'required',
            ];
        }
    }
