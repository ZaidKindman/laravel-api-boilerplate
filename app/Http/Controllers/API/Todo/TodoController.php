<?php

namespace App\Http\Controllers\API\Todo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\ChangeTodoStateRequest;
use App\Http\Requests\Todo\DeleteTodoRequest;
use App\Http\Requests\Todo\StoreTodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;
use App\Http\Resources\Todo\TodoResource;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return response()->success(TodoResource::collection($todos));
    }

    public function store(StoreTodoRequest $request)
    {
        $todo = $request->validated();
        $todo['user_id'] = auth()->user()->id;
        $inserted_todo = Todo::create($todo);
        return response()->success(new TodoResource($inserted_todo));
    }

    public function update(UpdateTodoRequest $request)
    {
        $todo = Todo::find($request->id);

        if ($todo == null)
            return response()->error(null, "Todo not found", 404);

        $todo->title = $request->title;
        $todo->body = $request->body;
        $todo->completed = $request->completed;
        $todo->save();
        return response()->success($todo);
    }

    public function changeTodoState(ChangeTodoStateRequest $request)
    {
        $todo = Todo::find($request->id);

        if ($todo == null) return response()->error(null, "Todo not found", 404);

        $todo->completed = $request->completed;
        $todo->save();
        return response()->success(new TodoResource($todo));
    }

    public function delete(DeleteTodoRequest $request)
    {
        $todo = Todo::find($request->id);

        if ($todo == null) return response()->error(null, "Todo not found", 404);

        $todo->delete();
        return response()->success(null);
    }
}
