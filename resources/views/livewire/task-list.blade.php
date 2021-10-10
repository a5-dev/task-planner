<div class="relative">
    <h3 class="text-2xl text-center">{{ $taskList->name ?? $name }}</h3>

    @if ($this->canBeDeleted())
        <span class="p-2 text-xs text-red-500 hover:bg-red-500 hover:text-white cursor-pointer absolute top-0 right-0" x-data @click="$el.disabled=true;$wire.delete()">X</span>
    @endif

    <div class="relative mb-2">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center">
            <span class="px-2 bg-white text-sm text-gray-500">
                {{ isset($date) ? $date->format('F j, Y') : '' }}
            </span>
        </div>
    </div>

    <div>
        @foreach ($tasks as $task)
            <livewire:task :task="$task" :wire:key="$task->id" />
        @endforeach
            
        @for($i = count($tasks); $i < max(10, count($tasks) + 1); $i++)
            <livewire:task :task="new App\Models\Task(['task_list_id' => $taskList->id ?? null, 'to_do_date' => (isset($date) ? $date->toDateString() : null)])" :wire:key="'new-task-'.$i" />
        @endfor
    </div>

</div>
