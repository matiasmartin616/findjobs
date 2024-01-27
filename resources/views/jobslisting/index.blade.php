<x-layout>
    @include('partials._hero')
    @include('partials._search')

    @if (count($joblistings) > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-2 gap-5 w-full m-0 p-3">
            @foreach ($joblistings as $joblisting)
                <x-card>
                    <x-joblists-card :joblisting="$joblisting" />
                </x-card>
            @endforeach
        </div>
    @else
        <p>Any job matches with the parameters</p>
    @endif
    <div class="mt-6 p-4">
        {{$joblistings->links()}}
    </div>
</x-layout>
