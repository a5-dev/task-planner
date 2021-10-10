@include('livewire.task-list', [
    'name' => $date->format('l'),
    'tasks' => $tasks,
    'date' => $date,
])