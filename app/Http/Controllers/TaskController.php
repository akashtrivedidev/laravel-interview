<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return Inertia::render('Task/All', [
            'tasks' => $tasks,
            'status' => Task::$Status,
            'priorities' => Task::$Priorities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Task/Edit', [
            'task' => [],
            'status' => Task::$Status,
            'priorities' => Task::$Priorities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'status' => ['required', 'integer'],
            'priority' => ['required', 'integer'],
        ]);
        $task = Task::where('name', $request->get('name'))->first();
        if ($task) {
            return redirect()->with('flash', ['message' => 'Task Already Exists']);
        }
        $task = Task::create($request->all());
        if ($task->id) {
            return $this->index();
        }
        return Inertia::render('Task/Edit', [
            'task' => null
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return Inertia::render('Task/Edit', [
            'task' => null,
            'status' => Task::$Status,
            'priorities' => Task::$Priorities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->update($request->all());
        return Inertia::render('Task/All');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->back();
    }
}
