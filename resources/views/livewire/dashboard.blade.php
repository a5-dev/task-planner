<div class="py-12">
    <div class="flex space-x-0 mb-10">
        <div class="inline-block w-[6.25%] text-center">
            <span class="cursor-pointer" wire:click="$set('date', '{{ $date->clone()->subWeek() }}')">&lt;&lt;</span>
        </div>
        <div class="inline-block w-[87.5%] shadow">
            <div class="flex space-x-0 divide-x divide-gray-300">
                @foreach ($dates as $date)
                    <div class="inline-block w-[14.2857%] pt-3 px-2 py-2 bg-white overflow-hidden">
                        <livewire:date-task-list :wire:key="$date->toDateString()" :date="$date" />
                    </div>
                @endforeach
            </div>
        </div>
        <div class="inline-block w-[6.25%] text-center">
            <span class="ml-auto cursor-pointer" wire:click="$set('date', '{{ $date->clone()->addWeek() }}')">&gt;&gt;</span>
        </div>
    </div>
    <div class="flex space-x-0 mb-10">
        <div class="inline-block w-[6.25%] text-center">
            
        </div>
        <div class="inline-block w-[87.5%]">
            <div class="flex space-x-[1%]">
                @foreach ($taskLists as $taskList)
                    <div class="inline-block w-[13.42857%] mb-[1%]">
                        <div class="bg-white overflow-hidden pt-3 px-2 py-2 shadow">
                            <livewire:task-list :wire:key="$taskList->id" :taskList="$taskList" />
                        </div>
                    </div>
                    @if(($loop->index + 1) % 7 == 0)
                        </div>
                        <div class="flex space-x-[1%]">
                    @endif
                @endforeach
                <div class="inline-block w-[13.42857%] mb-[1%]">
                    <div class="bg-white overflow-hidden pt-3 px-2 py-2 shadow">
                        <input type="text" class="w-full p-0 text-2xl text-center placeholder-gray-200 border-0 focus:border-0 focus:outline-none focus:ring-0" placeholder="Add New List" wire:model.defer="newTaskListName" x-data x-on:blur="$el.value ? setTimeout(() => $wire.addNewTaskList(), 150) : null" wire:keyDown.enter="addNewTaskList">
                    </div>
                </div>
            </div>
        </div>
        <div class="inline-block w-[6.25%] text-center">
            
        </div>
    </div>
</div>