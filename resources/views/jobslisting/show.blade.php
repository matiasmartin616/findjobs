<x-layout>
    @include('partials._hero')
    @include('partials._search')
    <a href="{{ url('/') }}" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    @if ($joblisting)
        <div class="container mx-auto">
            <x-card class="mb-4">
                <div class="flex flex-col items-center justify-center text-center">
                    <img class="w-48 mr-6 mb-6" src="{{ $joblisting->logo ? asset('storage/'.$joblisting->logo) : asset('images/no-image.png') }}"
                        alt="" />

                    <h3 class="text-2xl mb-2">{{ $joblisting['title'] }}</h3>
                    <div class="text-xl font-bold mb-4">{{ $joblisting['company'] }}</div>
                    <x-joblist-tags :tagsCsv="$joblisting->tags" />
                    <div class="text-lg my-4">
                        <i class="fa-solid fa-location-dot"></i> {{ $joblisting['location'] }}
                    </div>
                    <div class="border border-gray-200 w-full mb-6"></div>
                    <div>
                        <h3 class="text-3xl font-bold mb-4">
                            Job Description
                        </h3>
                        <div class="text-lg space-y-6">
                            <p
                            style="white-space: pre-wrap; text-align: left;"
                            class="max-w-4xl mx-auto my-4 whitespace-pre-wrap text-left bgcolor-white"
                            >{{ $joblisting['description'] }}</p>

                            <a href="mailto:{{ $joblisting['email'] }}"
                                class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                                    class="fa-solid fa-envelope"></i>
                                {{ $joblisting['email'] }}</a>

                            <a href="{{ $joblisting['website'] }}" target="_blank"
                                class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i
                                    class="fa-solid fa-globe"></i> {{ $joblisting['website'] }}</a>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    @else
        <p>Any job matches with the parameters</p>
    @endif

    {{-- <x-card class="mt-5 p-3 flex space-x-6">
        <a href ="{{ url('/') }}/joblisting/{{$joblisting->id}}/edit">
        <i class="fa-solid fa-pencil"></i> Edit offer
        </a>
        <form method= "post" action="/joblisting/{{$joblisting->id}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
        </form>
    </x-card> --}}
</x-layout>
