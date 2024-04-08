@props(['name', 'Title'])
<div 
{{-- making the modal be visibale and hidden --}}
x-data = "{visible : false , name : '{{$name}}'}"
x-show= "visible"
{{-- toggling a button to show the modal by EVENTS --}}
{{-- -1 Listenting To Events --}}
x-on:open-modal.window = "visible = ($event.detail.name === name)" 
x-on:close-modal.window = "visible = false" 
x-on:keydown.escape.window = "visible = false"
style="display: none"


class="fixed z-50 inset-0 flex justify-center">
  
<div x-on:click="visible=false" class="fixed inset-0 bg-gray-300 opacity-40"
"></div>
  <!-- Main modal -->
      <div class="relative p-4 w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{$Title ?? ''}}
                  </h3>
                  <button x-on:click="$dispatch('close-modal')" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5 space-y-4">
                    {{$body}}
              </div>
          </div>
      </div>
</div>