<?php

namespace App\Http\Controllers\API\Todo;

use App\Exceptions\Todo\TodoException;
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
        return response()->success(TodoResource::collection(Todo::all()));
    }

    public function store(StoreTodoRequest $request)
    {
        $object = $request->validated();
        $object['user_id'] = auth()->user()->id;
        $inserted_todo = Todo::create($object);

        return response()->success(new TodoResource($inserted_todo));
    }

    public function update(UpdateTodoRequest $request)
    {
        $todo = Todo::find($request->id);

        if ($todo == null)
            throw TodoException::TodoNotFoundException();

        $todo->title = $request->title;
        $todo->body = $request->body;
        $todo->completed = $request->completed;
        $todo->save();
        return response()->success($todo);
    }

    public function changeTodoState(ChangeTodoStateRequest $request)
    {
        $todo = Todo::find($request->id);

        if ($todo == null)
            throw TodoException::TodoNotFoundException();

        $todo->completed = $request->completed;
        $todo->save();
        return response()->success(new TodoResource($todo));
    }

    public function delete(DeleteTodoRequest $request)
    {
        $todo = Todo::find($request->id);

        if ($todo == null)
            throw TodoException::TodoNotFoundException();

        $todo->delete();
        return response()->success(null);
    }
}
