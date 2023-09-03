<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreFolderRequest extends ParentIdBaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Merge the parent's validation rules with additional rules for this request.
        return array_merge(parent::rules(),
            [
                'name' => [
                    'required', // 'name' field is required.
                    
                    // Rule for ensuring the 'name' field is unique in the 'File' model's 'name' column
                    Rule::unique(File::class, 'name')
                        ->where('created_by', Auth::id()) // Additional condition: created by the authenticated user.
                        ->where('parent_id', $this->parent_id) // Additional condition: matching 'parent_id' value.
                        ->whereNull('deleted_at') // Additional condition: 'deleted_at' column is null (record is not deleted).
                ]
            ]
        ); 
    }
}
