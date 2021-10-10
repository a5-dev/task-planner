<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\TaskList;
use Carbon\CarbonPeriod;
use Illuminate\View\View;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

class Dashboard extends Component
{
    public User $user;
    public Carbon $date;
    public string $newTaskListName = '';

    /** @var array */
    protected $listeners = ['taskListDeleted' => '$refresh'];

    public function boot(): void
    {
        /** @var \App\Models\User */
        $user = auth()->user();

        $this->user = $user;
    }

    public function mount(): void
    {
        // @todo Handle user timezone
        $this->date = Carbon::now();
    }

    public function updatingDate(string &$value): void
    {
        $value = Carbon::parse($value);
    }

    public function render(): View
    {
        return view('livewire.dashboard')
            ->with('taskLists', $this->user->taskLists)
            ->with('dates', $this->getDates($this->date));
    }

    public function getDates(CarbonInterface $date): array
    {
        $date = new CarbonImmutable($date);

        return CarbonPeriod::create($date->startOfWeek(), $date->endOfWeek())->toArray();
    }

    public function addNewTaskList(): void
    {
        $this->validate([
            'newTaskListName' => 'required|max:255',
        ]);

        $this->user->taskLists()->save(
            new TaskList([
                'name' => $this->newTaskListName,
            ])
        );

        $this->reset('newTaskListName');
    }
}
