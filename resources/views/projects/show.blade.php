@extends('layouts.app')
@section('content')
<header class="flex  mb-3 py-4">
    <div class="flex items-end justify-between w-full">
      <h2 class="text-gray-350 no-underline font-normal text-sm"><a href="/projects">My Projects</a> / {{ $project->title }}</h2>
      <a href="{{ $project->path() .'/edit' }}" class="button">Edit Project</a>
    </div>
  </header>
  <main>
    <div class="lg:flex -mx-3">
      <div class="lg:w-3/4 px-3">
        <div class="mb-8">
          <h2 class="text-gray-350 text-lg font-normal mb-3">Tasks</h2>

          @foreach ($project->tasks as $task)
          <form action="{{ $task->path() }}" method="post">
            @method('PATCH')
            @csrf
              <div class="flex items-center card mb-3">
                <input type="text" name="body" value="{{ $task->body }}" class="w-full">
                <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
              </div>
          </form>
          @endforeach
          <div class="card mb-3">
            <form action="{{$project->path() . '/tasks' }}" method="post">
              @csrf
              <input type="text" placeholder="Add a new task" name="body" class="w-full">
            </form>
          </div>
        </div>

        <div>
        <h2 class="text-gray-350 text-lg font-normal mb-3">General Notes</h2>
        <form method="POST" action="{{ $project->path() }}">
          @csrf
          @method('PATCH')

          <textarea
              name="notes"
              class="card w-full mb-4"
              style="min-height: 200px"
              placeholder="Anything special that you want to make a note of?"
          >{{ $project->notes }}</textarea>

          <button type="submit" class="button">Save</button>
        </form>

        @include('errors')
        </div>
      </div>

      <div class="lg:w-1/4 px-3 lg:py-8">
        @include('projects.card')

        @include('projects.activity.card')
      </div>
    </div>
  </main>
  
@endsection