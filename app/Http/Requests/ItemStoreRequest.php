<?php

namespace App\Http\Requests;

use App\Enums\PostTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:30'],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'location' => ['required', 'string', 'min:3', 'max:255'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', Rule::email()->strict()],
            'telephone' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'user_id' => ['required', 'exists:users,id'],
            'itemImages' => ['nullable', 'array', 'max:4', 'min:3'],
            'itemImages.*' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'post_type' => ['required', 'string', Rule::enum(PostTypeEnum::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a title for the item.',
            'title.min' => 'The title must be at least :min characters.',
            'title.max' => 'The title must not exceed :max characters.',

            'description.required' => 'Please provide a description.',
            'description.min' => 'The description must be at least :min characters.',
            'description.max' => 'The description must not exceed :max characters.',

            'location.required' => 'Please enter the location where the item was lost or found.',
            'location.min' => 'Location must be at least :min characters.',
            'location.max' => 'Location must not exceed :max characters.',

            'name.required' => 'Please enter your name.',
            'name.min' => 'Your name must be at least :min characters.',
            'name.max' => 'Your name must not exceed :max characters.',

            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',

            'telephone.required' => 'Please provide a telephone number.',

            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category is invalid.',

            'user_id.required' => 'User is required.',
            'user_id.exists' => 'The specified user does not exist.',

            'itemImages.array' => 'Please upload multiple images at once by selecting them together..',
            'itemImages.max' => 'You can upload up to 4 images only..',
            'itemImages.min' => 'Please upload at least 3 images..',
            'itemImages.*.required' => 'Each image is required..',
            'itemImages.*.file' => 'Each uploaded file must be an image.',
            'itemImages.*.image' => 'Each file must be a valid image.',
            'itemImages.*.mimes' => 'Images must be in jpg, jpeg, png or webp format..',
            'itemImages.*.max' => 'Each image must not exceed 2MB..',

            'post_type.required' => 'Please specify if this is a lost or found item.',
            'post_type.enum' => 'The post type must be one of the allowed values.',
        ];
    }
}
