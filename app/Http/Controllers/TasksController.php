<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class TasksController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $taskData = $request->validate([
            'summary' => 'required|max:255',
            'to_do_date' => 'nullable|required_without:task_list_id|date',
            'task_list_id' => 'nullable|required_without:to_do_date|integer|exists:task_lists,id,user_id,'.$request->user()->id,
        ]);

        $task = new Task($taskData);

        $task->user_id = $request->user()->id;
        $task->save();

        return redirect()->back();
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $taskData = $request->validate([
            'summary' => 'required|string|max:255',
            'to_do_date' => 'nullable|required_without:task_list_id|date',
            'task_list_id' => 'nullable|required_without:to_do_date|integer|exists:task_lists,id,user_id,'.$request->user()->id,
            'completed' => 'required|boolean',
        ]);

        if ($task->user_id != $request->user()->id) {
            abort(401);
        }

        $taskData['completed_at'] = ($task->isNotCompleted() && $taskData['completed']) ? now() : null;
        unset($taskData['completed']);

        $task->update($taskData);

        return redirect()->back();
    }

    public function destroy(Request $request, Task $task): RedirectResponse
    {
        if ($task->user_id != $request->user()->id) {
            abort(401);
        }

        $task->delete();

        return redirect()->back();
    }
}
