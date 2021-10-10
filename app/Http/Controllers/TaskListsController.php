<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class TaskListsController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $taskListData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $request->user()->taskLists()->save(
            new TaskList($taskListData)
        );

        return redirect()->back();
    }

    public function update(Request $request, TaskList $taskList): RedirectResponse
    {
        $taskListData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        if ($taskList->user_id != $request->user()->id) {
            abort(401);
        }
        $taskList->update($taskListData);

        return redirect()->back();
    }

    public function destroy(Request $request, TaskList $taskList): RedirectResponse
    {
        if ($taskList->user_id != $request->user()->id) {
            abort(401);
        }

        $taskList->delete();

        return redirect()->back();
    }
}
