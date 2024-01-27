<!-- Hero -->
<section class="relative bg-black text-white flex flex-col justify-center items-center text-center space-y-4 h-48 md:h-50">
    <div class="absolute top-0 left-0 w-full h-full bg-no-repeat bg-left bg-opacity-10" style="background-image: url('{{asset('images/laravel-logo.png')}}')"></div>

    <div class="z-10">
        <h1 class="text-3xl md:text-4xl font-bold uppercase">
            Find Jobs
        </h1>
        <p class="text-md md:text-lg text-gray-300">
            Where opportunities are born
        </p>

        <div class="mt-4">
            @auth
            @else
            <a href="register.html" class="inline-block bg-white text-black py-2 px-4 rounded-xl uppercase font-medium hover:bg-gray-700 hover:text-white transition duration-300">Sign Up to List a Job</a>
            @endauth
        </div>
    </div>
</section>
