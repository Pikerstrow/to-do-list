<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->get('date');

        $tasks = Auth::user()->tasks()->whereRaw("Date(due_date) = '{$date}'")->orderBy('id', 'DESC')->get();

        return response()->json([
            'tasks' => $tasks
        ], 200);
    }


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
            'message' => 'Нове завдання успішно додане!'
        ], 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $result = $request->user()->tasks()->whereId($id)->update($request->all());

        if($result){
           $task = $request->user()->tasks()->whereId($id)->first();

            return response()->json([
                'task' => $task,
                'message' => 'Статус завдання успішно змінений!'
            ], 200);
        }

        return null;
    }


    public function getTaskForEditing($id)
    {
        $task = DB::table('tasks')->whereId($id)->first();

        return response()->json([
            'task' => $task
        ], 200);
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:15|max:300',
            'due_date' => 'required|date|date_format:Y-m-d',
            'status' => 'required|integer|between:0,1'
        ]);

        $result = $request->user()->tasks()->whereId($id)->update($validated);

        if($result){
            $task = $request->user()->tasks()->whereId($id)->first();

            return response()->json([
                'task' => $task,
                'message' => 'Завдання було відредаговане успішно!'
            ], 200);
        }

        return null;
    }


    public function destroy($id)
    {
        $result = DB::table('tasks')->whereId($id)->delete();

        if($result){
            return response()->json([
                'message' => 'Завдання успішно видалене!'
            ], 200);
        }
    }

    public function getTasksByMonth(Request $request, $year, $month)
    {
        $month = $month + 1;
        $tasks = $request->user()->tasks()->whereRaw("MONTH(due_date) = {$month} AND YEAR(due_date) = {$year}")->get();

        $quantities = [];

        /*Рахуємо кількість задач по днях в місяці*/
        foreach($tasks as $task){
            $date = explode(' ', $task['due_date'])[0];
            $day = explode('-', $date)[2];
            $day = (int)$day;

            if(isset($quantities[$day])){
                $quantities[$day]++;
            } else {
                $quantities[$day] = 1;
            }
        }

        return response()->json([
            'quantities' => $quantities
        ], 200);
    }
}
