<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Task as TaskModel;

class Task extends Component
{
    public TaskModel $task;

    /** @var array */
    protected $rules = [
        'task.summary' => 'required|max:255',
        'task.to_do_date' => 'nullable|required_without:task.task_list_id|date',
        'task.task_list_id' => 'nullable|required_without:task.to_do_date|integer|exists:task_lists,id',
    ];

    public function render(): View
    {
        return view('livewire.task');
    }

    public function addNewTask(): void
    {
        $this->validate();

        $this->task->user_id = auth()->id();
        $this->task->save();

        $this->emitUp('taskAdded', $this->task->id);

        $this->task->id = null;
        $this->task->summary = null;
    }

    public function markCompleted(): void
    {
        $this->task->update([
            'completed_at' => now(),
        ]);
    }

    public function markUncompleted(): void
    {
        $this->task->update([
            'completed_at' => null,
        ]);
    }

    public function delete(): void
    {
        $this->task->delete();

        $this->emitUp('taskDeleted', $this->task->id);
    }
}
