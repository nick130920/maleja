<x-app-layout>
    @include('calendario')
    <x-slot name="scripts">
    </x-slot>

  <div class="container">
        {{-- <iframe style="width: 100%;box-shadow: none;border: none;height: 85vh;" src="{{URL::to('/Calendario/index.php')}}"></iframe> --}}
        @yield("calendario")
     </div>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            </div>
        </div>
    </div> --}}
</x-app-layout>
