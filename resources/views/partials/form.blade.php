  @csrf

  <div class="field mb-6">
    <label for="title" class="label text-sm mb-2 block">Title</label>
    <div class="control">
      <input 
        type="text" 
        name="title" 
        value="{{ $project->title }}"
        placeholder="Let's start something new"
        class="input bg-transparent border border-gray-200 rounded p-2 text-xs w-full">
    </div>
  </div>

  <div class="field mb-6">
    <label for="title" class="label text-sm mb-2 block">Description</label>
    <div class="control">
      <textarea
      name="description"
      rows="10"
      class=" text-area bg-transparent border border-gray-200 rounded p-2 text-xs w-full"
      placeholder="Anything special that you want to make a note of?"
      >{{ $project->description }}</textarea>
    </div>
  </div>

  <div class="field">
    <div class="control">
      <button type="submit" class="button is-link mr-2">{{ $buttonText }}</button>

      <a href="/projects">Cancel</a>
    </div>
  </div>

  @if ($errors->any())
      <div class="field mt-6">
        @foreach ($errors->all() as $error)
            <li class="text-sm text-red-600">{{ $error }}</li>
        @endforeach
      </div>
  @endif

