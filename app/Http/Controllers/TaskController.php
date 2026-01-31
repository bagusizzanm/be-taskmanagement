<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
  public function index()
  {
    // get semua task dari user yang login
    $tasks = Task::where('user_id', Auth::user()->id)->get();

    return response()->json([
      'success' => true,
      'data' => $tasks,
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'status' => 'in:todo,in_progress,done',
      'deadline' => 'nullable|date',
    ]);

    $task = Task::create([
      'user_id' => Auth::user()->id,
      'title' => $request->title,
      'description' => $request->description,
      'status' => $request->status ?? 'todo',
      'deadline' => $request->deadline,
      'created_by' => Auth::user()->name,
    ]);

    return response()->json([
      'message' => 'Sukses membuat task',
      'data' => $task,
    ], 201);
  }


  public function show(Task $task)
  {
    $task = Task::where('tasks.id', $task->id)
      ->where('user_id', Auth::user()->id)
      ->firstOrFail();

    return response()->json([
      'success' => true,
      'data' => $task,
    ]);
  }

  public function update(Request $request, $id)
  {
    $task = Task::where('tasks.id', $id)
      ->where('user_id', Auth::user()->id)
      ->firstOrFail();

    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'status' => 'in:todo,in_progress,done',
      'deadline' => 'nullable|date',
    ]);

    $task->update($request->all());

    return response()->json([
      'success' => true,
      'data' => $task,
    ]);
  }
  public function destroy($id)
  {
    $task = Task::find($id);
    if (!$task) {
      return response()->json([
        'success' => false,
        'message' => 'Data tidak ditemukan',
      ], 404);
    }

    $task = Task::where('tasks.id', $id)
      ->where('user_id', Auth::user()->id)
      ->firstOrFail();

    $task->delete();
    return response()->json([
      'success' => true,
      'message' => 'Task berhasil dihapus',
    ]);
  }
}
