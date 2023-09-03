<?php

namespace App\Models;

use App\Traits\HasCreatorAndUpdater;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;



class File extends Model
{
    use HasFactory, HasCreatorAndUpdater, NodeTrait, SoftDeletes;

    public function isOwnedBy($userId): bool
    {  
        return $this->created_by == $userId;

    }
}
