


@props(['joblisting'])
    <div class="flex flex-col items-center justify-center md:flex-row md:justify-start">
        <img class="flex flex-col w-48 mr-6 md:block"
            src="{{ $joblisting->logo ? asset('storage/'.$joblisting->logo) : asset('images/no-image.png') }}" alt="" />
        <div>
            <h3 class="text-xl mb-4">
                <a class= "font-bold hover:text-gray-500" href="/joblisting/{{ $joblisting->id }}">{{ $joblisting->title }}</a>
            </h3>
            <div class="text-lg mb-4">
                <i class="fa-solid fa-building"></i>
                {{ $joblisting->company }}
            </div>
            <x-joblist-tags :tagsCsv="$joblisting->tags"/>
            <div class="text-lg">
                <i class="fa-solid fa-location-dot"></i>
                {{ $joblisting->location }}
            </div>
        </div>
        {{$slot}}
    </div>
