<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Auth::user()->tasks()->whereRaw('Date(due_date) = CURDATE()')->orderBy('id', 'DESC')->get();

        return response()->json([
            'tasks' => $tasks
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $today = Carbon::today();

        $validated = $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:15|max:300',
            'due_date' => 'required|date|date_format:Y-m-d|after_or_equal:' . $today,
            'status' => 'required|integer|between:0,1'
        ]);

        $task = $request->user()->tasks()->create($validated);

        return response()->json([
            'task' => $task,
            'message' => 'Нова задача успішно створена!'
        ], 200);

    }

    public function updateStatus(Request $request, $id)
    {
        $task = $request->user()->tasks()->whereId($id)->update($request->all());

        return response()->json([
            'task' => $task,
            'message' => 'Статус завдання успішно змінений!'
        ], 200);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
