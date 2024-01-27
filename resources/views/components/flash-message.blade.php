@if(session()->has('message'))
<div x-data="{show:true}" x-init="setTimeout(() => show = false, 3000)" x-show= "show"
    class="border-4 rounded-md
    w-54 h-24
    fixed top-0
    left-1/2 transform -translate-x-1/2
    bg-green-500 text-white align
    flex items-center justify-center px-7 ">
    <p>{{session('message')}}</p>
</div>
@endif
