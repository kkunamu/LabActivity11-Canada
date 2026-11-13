<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only users who have an author profile are authorized
        return $this->user() !== null && $this->user()->author !== null;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:120'],
            'body' => ['required', 'string', 'min:20'],
            'category' => ['required', 'in:Announcement,Health,Peace & Order,Ayuda,Events'],
            'tags' => ['required', 'array', 'min:1'],
            'tags.*' => ['exists:tags,id'],
            'is_published' => ['boolean'],
        ];
    }
}