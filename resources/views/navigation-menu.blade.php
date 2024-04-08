<header class="flex items-center justify-between py-3 px-6 border-b border-gray-100">
    <div id="header-left" class="flex items-center">
        <div class="text-gray-800 font-semibold">
            <span class="text-yellow-500 text-xl">&lt;BLOG&gt;</span>
        </div>
        <div class="top-menu ml-10">
            <ul class="flex space-x-4">
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link class="" href="{{ URL('/') }}" :active="Route::current()->uri() == '/'">
                        {{ __('nav-menu.Home') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link class="" href="{{ URL('/blogs') }}" :active="Route::current()->uri() == 'blogs'">
                        {{ __('nav-menu.Blog') }}
                    </x-nav-link>
                </div>
            </ul>
        </div>
    </div>
    <div id="header-right" class="flex items-center md:space-x-6">
        @guest
            @include('layouts.includes.login-btn')
        @endguest
        
            @include('layouts.includes.localization-flags')
        

        @auth
            @include('layouts.includes.profile-navigator')
        @endauth
    </div>
</header>
