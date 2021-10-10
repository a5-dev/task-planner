<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskList extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    public $guarded = ['id', 'created_at', 'updated_at'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
