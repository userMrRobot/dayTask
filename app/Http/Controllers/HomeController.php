<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function home(){

//        тут должно быть подключение к таблице БД и получение данных из нее в переменную tasts
        $tasks = [];
        $tasks = Task::all();


        return view('home',['tasks'=>$tasks,'title'=>'Главная страница']);
    }

    public function store(Request $request){
//        $validated = $request->validate(['name'=> ['required']]);

        $tasks = Task::query()->create([
            'name' => $request->name
        ]);
        return redirect()->route('home')->with('success', 'Задача успешно добавлена!');

    }

    public function toggle($id)

    {
        $task = Task::query()->find($id);
        $task->update(['is_done' => 1]);
        return redirect()->route('home')->with('success', 'Задача успешно выполнена');


    }

    public function Update($id , Request $request)
    {
        $task = Task::query()->find($id);
        $task->update([
            'name' => $request->task
        ]);
        return redirect()->route('home')->with('success', 'Задача успешно обновлена');
    }

    public function izmena($id)
    {
        $task = Task::query()->find($id);
        return view('update',['task'=> $task,'title'=>'Главная страница']);
    }

    public function delete($id)
    {
        $task = Task::query()->find($id);
        $task->delete();
        return redirect()->route('home')->with('success', 'Задача успешно удалена');
    }
}
