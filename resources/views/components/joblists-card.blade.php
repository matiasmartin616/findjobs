@props(['joblisting'])

<div class="flex flex-col items-center justify-center md:flex-row md:justify-start md:items-start">
    <img class="w-48 mb-4 md:mb-0 md:w-56 mr-6"
        src="{{ $joblisting->logo ? $joblisting->logo : asset('images/no-image.png') }}" alt="" />

    <div>
        <h3 class="text-xl mb-4">
            <a class="font-bold hover:text-gray-500" href="/joblisting/{{ $joblisting->id }}">{{ $joblisting->title }}</a>
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
