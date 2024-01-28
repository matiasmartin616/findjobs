@props(['tagsCsv'])

@php
$tags = explode(',', $tagsCsv)
@endphp
<ul class="flex flex-wrap mb-4">
    @foreach ($tags as $tagname)
        <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 mb-2 text-xs">
            <a href="/?tag={{ $tagname }}">{{ $tagname }}</a>
        </li>
    @endforeach
</ul>
