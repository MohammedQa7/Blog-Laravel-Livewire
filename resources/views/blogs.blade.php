<x-app-layout title="Blogs">

    <main class="container mx-auto px-5 flex flex-grow">
        <div class="w-full grid grid-cols-4 gap-10">

                <div class="md:col-span-3 col-span-4">
                    @livewire('PostLists')
                </div>

            <div id="side-bar"
                class="border-t border-t-gray-100 md:border-t-none col-span-4 md:col-span-1 px-3 md:px-6  space-y-10 py-6 pt-10 md:border-l border-gray-100 h-screen sticky top-0">
              
                @livewire('SearchBox')

                @include('posts.Category_filter')
            </div>

        </div>

 
    </main>
    



</x-app-layout>