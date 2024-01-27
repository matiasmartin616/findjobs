<x-layout>
    @include('partials._hero')
    @include('partials._search')

    <x-card class="max-w-lg mx-auto mt-10">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Post a job
            </h2>
            <p class="mb-4">Post a job to find talent</p>
        </header>

        <form method = "post" action="/joblisting/store" id="multiStepForm" enctype="multipart/form-data">
            {{-- prevent cross site attack with csrf--}}
            @csrf
            @php
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
            @endphp
            <!-- Step 1 -->
            <div id="step1" class="form-step">
                <div class="mb-2">
                    <label for="company" class="inline-block text-lg mb-2">Company Name</label>
                    <!-- old() retain the field value in case of validation failure  -->
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company"
                        value="{{ old('company') }}" />
                </div>
                @error('company')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror
                <button type="button" onclick="goToStep(2)"
                    class="next-step bg-laravel text-white rounded py-2 px-4 hover:bg-black">Next</button>
            </div>

            <!-- Step 2 -->
            <div id="step2" class="form-step" style="display: none;">
                <div class="mb-2">
                    <label for="title" class="inline-block text-lg mb-2">Job Title</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                        value="{{ old('title') }}" placeholder="Example: Senior Vue Developer" />
                </div>
                @error('title')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror
                <div class="mb-2">
                    <label for="location" class="inline-block text-lg mb-2">Job Location</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
                        value="{{ old('location') }}" placeholder="Example: Remote, Texas, etc" />
                </div>
                @error('location')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror
                <button type="button" onclick="goToStep(1)"
                    class="prev-step bg-laravel text-white rounded py-2 px-4 hover:bg-black">Previous</button>
                <button type="button" onclick="goToStep(3)"
                    class="next-step bg-laravel text-white rounded py-2 px-4 hover:bg-black">Next</button>
            </div>

            <!-- Step 3 -->
            <div id="step3" class="form-step" style="display: none;">
                <div class="mb-2">
                    <label for="email" class="inline-block text-lg mb-2">Contact Email</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email"
                        value="{{ old('email') }}" />
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror
                <div class="mb-2">
                    <label for="website" class="inline-block text-lg mb-2">
                        Website/Application URL
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website"
                        value="{{ old('website') }}" />
                </div>
                @error('website')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror
                <button type="button" onclick="goToStep(2)"
                    class="prev-step bg-laravel text-white rounded py-2 px-4 hover:bg-black">Previous</button>
                <button type="button" onclick="goToStep(4)"
                    class="next-step bg-laravel text-white rounded py-2 px-4 hover:bg-black">Next</button>
            </div>

            <!-- Step 4 -->
            <div id="step4" class="form-step" style="display: none;">
                <div class="mb-2">
                    <label for="tags" class="inline-block text-lg mb-2">
                        Tags (Comma Separated)
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                        value="{{ old('tags') }}" placeholder="Example: Laravel, Backend, Postgres, etc" />
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
                <button type="button" onclick="goToStep(3)"
                    class="prev-step bg-laravel text-white rounded py-2 px-4 hover:bg-black">Previous</button>
                <button type="button" onclick="goToStep(5)"
                    class="next-step bg-laravel text-white rounded py-2 px-4 hover:bg-black">Next</button>
            </div>

            <div id="step5" class="form-step" style="display: none;">
                <div class="mb-2">
                    <label for="description" class="inline-block text-lg mb-2">
                        Job Description
                    </label>
                    <textarea class="border border-gray-200 rounded p-1 w-full" name="description" rows="6"
                        placeholder="Include tasks, requirements, salary, etc"></textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="button" onclick="goToStep(4)"
                    class="prev-step bg-laravel text-white rounded py-2 px-4 hover:bg-black">Previous</button>
                <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Create
                    post</button>
            </div>
        </form>
    </x-card>
</x-layout>

@if ($stepWithError)
    <script>
        window.onload = function() {
            goToStep({{ $stepWithError }});
        };
    </script>
@endif

<script>
    function goToStep(stepNumber) {
        const totalSteps = 5;
        for (let i = 1; i <= totalSteps; i++) {
            const step = document.getElementById('step' + i);
            step.style.display = i === stepNumber ? 'block' : 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const inputElements = document.querySelectorAll('form input');

        inputElements.forEach(element => {
            element.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    goToNextStep(element);
                }
            });
        });
    });

    // style: Function to focus the first input of a given step
    function focusFirstInputOfStep(stepNumber) {
        const stepElement = document.getElementById('step' + stepNumber);
        if (stepElement) {
            const firstInput = stepElement.querySelector('input, textarea, select');
            if (firstInput) {
                firstInput.focus();
            }
        }
    }

    function goToNextStep(currentElement) {
        const totalSteps = 5;
        let currentStepNumber;

        // add: Find current step number
        for (let i = 1; i <= totalSteps; i++) {
            if (currentElement.closest('#step' + i)) {
                currentStepNumber = i;
                break;
            }
        }

         // add: Move to the next step if not the last step
    if (currentStepNumber && currentStepNumber < totalSteps) {
        const nextStep = currentStepNumber + 1;
        goToStep(nextStep);
        focusFirstInputOfStep(nextStep);
    }
    }
</script>
