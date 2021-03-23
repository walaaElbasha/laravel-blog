<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

use App\Models\Post;


class PostRequest extends FormRequest
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
           
            'title' => ['required','min:3',
            Rule::unique('posts', 'title')->ignore($this->post)],
            'slug' => ['required','min:3','alpha_dash',
            Rule::unique('posts', 'title')->ignore($this->post)],  
            'description' => ['required','min:10'],
            'user_id' => ['exists:users,id']
        ];
    

        
    }


    public function messages()
    {
        return [

            'title.required' => 'Title is required!!',
            'title.min' => 'Title should be more than 3 chars',
            

        ];
    }
}
