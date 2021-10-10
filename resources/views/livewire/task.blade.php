<div class="inline-flex w-full border-b border-dotted border-gray-300 cursor-pointer">
   <div class="w-4">
      @if($task->id)
         <input type="checkbox" class="h-3 w-3 text-gray-300 border-gray-300 rounded focus:ring-0 cursor-pointer" wire:click="{{$task->isNotCompleted() ? 'markCompleted' : 'markUncompleted' }}" {{ $task->isCompleted() ? 'checked' : '' }}>
      @else
         <span class="h-3 w-3 text-white">&nbsp</span>
      @endif
   </div>
   <div class="w-1 border-l border-red-500 border-r"></div>
   <div class="w-full pl-1 flex">
      @if($task->id)
         <span class="{{ $task->isCompleted() ? 'line-through text-gray-200' : '' }}">{{ $task->summary }}</span>
         <button x-data @click="$el.disabled=true;$wire.delete()" class="ml-auto px-1 text-xs text-red-500 ml-auto hover:bg-red-500 hover:text-white">x</button>
      @else
         <input type="text" class="w-full p-0 placeholder-gray-200 outline-none border-0 ring-0 focus:outline-none focus:border-0 focus:ring-0" placeholder="" wire:model.defer="task.summary" x-data x-on:blur="$el.value ? setTimeout(() => $wire.addNewTask(), 150) : null" wire:keyDown.enter="addNewTask">
      @endif
   </div>
</div>