<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    public $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    public $casts = [
        'completed_at' => 'datetime',
        'to_do_date' => 'date',
    ];

    public function taskList(): BelongsTo
    {
        return $this->belongsTo(TaskList::class);
    }

    public function isCompleted(): bool
    {
        return !empty($this->completed_at);
    }

    public function isNotCompleted(): bool
    {
        return !$this->isCompleted();
    }
}
