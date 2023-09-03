<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ParentIdBaseRequest extends FormRequest
{
    public ?File $parent = null;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Attempt to find a File record with the 'id' provided in 'parent_id'.
        $this->parent = File::query()->where('id', $this->input('parent_id'))->first();

        // If a parent File is found and it's not owned by the authenticated user, deny access.
        if ($this->parent && !$this->parent->isOwnedBy(Auth::id())) {
            return false;
        }
        
        // If the parent is either not found or is owned by the authenticated user, allow access.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'parent_id' => [
                // Rule to check if 'parent_id' exists in the 'File' model's 'id' column.
                Rule::exists(File::class, 'id')
                    ->where(function(Builder $query) {
                        // Additional conditions for the existence rule:
                        return $query
                            ->where('is_folder', '=', '1') // Check if it's a folder.
                            ->where('created_by', '=', Auth::id()); // Check if created by the authenticated user.
                    })
            ]
        ];
    }
}
