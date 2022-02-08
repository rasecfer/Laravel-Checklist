<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Checklist;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTaskRequest $request
     * @param Checklist $checklist
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTaskRequest $request, Checklist $checklist)
    {
        // Obtiene la última posicion
        $position = $checklist->tasks()->where('user_id', null)->max('position') + 1;

        $checklist->tasks()->create($request->validated() + ['position' => $position]);

        return redirect()->route('admin.checklist_groups.checklists.edit',
            [$checklist->checklist_group_id, $checklist]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Checklist $checklist
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist, Task $task)
    {
        return view('admin.tasks.edit', compact('checklist', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTaskRequest $request, Checklist $checklist, Task $task)
    {
        $task->update($request->validated());

        return redirect()->route('admin.checklist_groups.checklists.edit',
            [$checklist->checklist_group_id, $checklist]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist, Task $task)
    {
        // Reordenar la posición de las tareas
        $checklist->tasks()->where('user_id', null)->where('position', '>', $task->position)
            ->update(['position' => DB::raw('position - 1')]);

        $task->delete();

        return redirect()->route('admin.checklist_groups.checklists.edit',
            [$checklist->checklist_group_id, $checklist]);
    }
}
