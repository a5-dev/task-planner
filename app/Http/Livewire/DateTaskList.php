<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;

class DateTaskList extends TaskList
{
    public CarbonInterface $date;
    public Collection $tasks;

    public function refreshTasks(): void
    {
        $this->tasks = $this->user->tasks()->where('to_do_date', $this->date)->get();
    }

    public function render(): View
    {
        return view('livewire.date-task-list');
    }
}
