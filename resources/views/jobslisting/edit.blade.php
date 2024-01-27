<x-layout>
    @include('partials._hero')
    @include('partials._search')

    <x-card class="max-w-lg mx-auto mt-10">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Post a job
            </h2>
            <p class="mb-4">Edit job offer</p>
        </header>

        <form method = "post" action="/joblisting/{{$joblisting->id}}" enctype="multipart/form-data">
            {{-- prevent cross site attack with csrf--}}
            @csrf
            @method('PUT')
            {{-- @php
                $fieldMapToStep = [
                    'company' => 1,
                    'title' => 2,
                    'location' => 2,
                    'email' => 3,
                    'website' => 3,
                    'tags' => 4,
                    'logo' => 4,
                    'description' => 5,
                ];
                $firstErrorKey = $errors->keys() ? $errors->keys()[0] : null;
                $stepWithError = $firstErrorKey ? $fieldMapToStep[$firstErrorKey] ?? null : null;
            @endphp --}}

                <div class="mb-2">
                    <label for="company" class="inline-block text-lg mb-2">Company Name</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company"
                        value="{{ $joblisting->company }}" />
                </div>
                @error('company')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror

                <div class="mb-2">
                    <label for="title" class="inline-block text-lg mb-2">Job Title</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                        value="{{ $joblisting->title }}" placeholder="Example: Senior Vue Developer" />
                </div>
                @error('title')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror
                <div class="mb-2">
                    <label for="location" class="inline-block text-lg mb-2">Job Location</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
                        value="{{ $joblisting->location }}" placeholder="Example: Remote, Texas, etc" />
                </div>
                @error('location')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror


                <div class="mb-2">
                    <label for="email" class="inline-block text-lg mb-2">Contact Email</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email"
                        value="{{ $joblisting->email }}" />
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror
                <div class="mb-2">
                    <label for="website" class="inline-block text-lg mb-2">
                        Website/Application URL
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website"
                        value="{{ $joblisting->website }}" />
                </div>
                @error('website')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror

                <div class="mb-2">
                    <label for="tags" class="inline-block text-lg mb-2">
                        Tags (Comma Separated)
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                        value="{{ $joblisting->tags }}" placeholder="Example: Laravel, Backend, Postgres, etc" />
                </div>
                @error('tags')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror
                <div class="mb-2">
                    <label for="logo" class="inline-block text-lg mb-2">
                        Company Logo
                    </label>
                    <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />
                </div>
                @error('logo')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror


                <div class="mb-2">
                    <label for="description" class="inline-block text-lg mb-2">
                        Job Description
                    </label>
                    <textarea class="border border-gray-200 rounded p-1 w-full" name="description" rows="6"
                        placeholder="Include tasks, requirements, salary, etc">{{ $joblisting->description }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Edit
                    post</button>
        </form>
    </x-card>
</x-layout>
