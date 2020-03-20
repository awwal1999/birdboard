@extends('layouts.app')

@section('content')
  <header class="flex  mb-3 py-4">
    <div class="flex items-end justify-between w-full">
      <h2 class="text-gray-350 no-underline font-normal text-sm">My Projects</h2>
      <a href="/projects/create" class="button">New Project</a>
    </div>
  </header>
    <main class="lg:flex flex-wrap -mx-3">
      @forelse ($projects as $project)
        <div class="lg:w-1/3 px-3 pb-6">
          <div class="card" style="height:200px;">
            <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-450 pl-4 mb-3">
              <a href="{{ $project->path() }}">{{ $project->title }}</a>
            </h3>
            <div class="text-gray-350"> {{ str_limit($project->description) }} </div>
          </div>
        </div>
      @empty
        <div>No projects yet.</div>
      @endforelse
    </main>

@endsection