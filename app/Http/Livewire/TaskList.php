<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\User;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\TaskList as TaskListModel;
use Illuminate\Database\Eloquent\Collection;

class TaskList extends Component
{
    public TaskListModel $taskList;
    public Collection $tasks;
    public User $user;
    public string $newTaskSummary = '';

    /** @var array */
    protected $listeners = [
        'taskDeleted' => 'removeDeletedTask',
        'taskAdded' => 'refreshTasks',
    ];

    public function boot(): void
    {
        /** @var \App\Models\User */
        $user = auth()->user();

        $this->user = $user;
    }

    public function mount(): void
    {
        $this->refreshTasks();
    }

    public function render(): View
    {
        return view('livewire.task-list');
    }

    public function refreshTasks(): void
    {
        $this->tasks = $this->taskList->tasks()->get();
    }

    public function removeDeletedTask(int $taskId): void
    {
        $this->tasks->filter(fn (Task $task) => $task->id != $taskId);
    }

    public function canBeDeleted(): bool
    {
        return isset($this->taskList);
    }

    public function delete(): void
    {
        $this->taskList->delete();

        $this->emitUp('taskListDeleted', $this->taskList->id);
    }
}
