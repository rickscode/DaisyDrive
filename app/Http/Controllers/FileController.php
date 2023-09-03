<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\File;

class FileController extends Controller
{
    /**
     * Display the "My Files" view.
     *
     * @return \Inertia\Response
     */
    public function myFiles()
    {
        // Render the 'My Files' view using the Inertia framework.
        return Inertia::render('MyFiles');
    }

    /**
     * Create a new folder.
     *
     * @param  \App\Http\Requests\StoreFolderRequest  $storeFolderRequest
     * @return void
     */
    public function createFolder(StoreFolderRequest $storeFolderRequest)
    {
        // Validate the incoming request and get the validated data.
        $data = $storeFolderRequest->validated();

        // Get the parent folder, or the root folder if not provided.
        $parent = $storeFolderRequest->parent;

        if (!$parent) {
            $parent = $this->getRoot();
        }

        // Create a new File model representing a folder.
        $file = new File();
        $file->is_folder = 1;
        $file->name = $data['name'];

        // Append the new folder as a child of the parent folder.
        $parent->appendNode($file);
    }

    /**
     * Get the root folder for the authenticated user.
     *
     * @return \App\Models\File
     */
    private function getRoot()
    {
        // Retrieve the root folder associated with the authenticated user.
        return File::query()->whereIsRoot()->where('created_by', Auth::id())->firstOrFail();
    }
}
