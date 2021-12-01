{{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
    style="background-image: url('{{ asset('img/fondolegal.jpg') }}');">
    <div class="card">

    </div>
</div> --}}
<div class="relative items-center  px-4 sm:px-6 lg:px-8            min-h-screen w-full bg-no-repeat bg-cover bg-left bg-gray-100 py-6 flex flex-col justify-center sm:py-12" style="background-image: url('{{ asset('img/fondolegal.jpg') }}')">
    {{-- <div class="relative sm:max-w-xl sm:mx-auto"> --}}
      <div class="relative w-2/6 w px-14 py-4 bg-white shadow-lg sm:rounded-3xl sm:px-14 sm:py-4 bg-clip-padding bg-opacity-60 border border-gray-200"
            style="backdrop-filter: blur(10px);">
        <div class="max-w-md mx-auto">
          {{ $slot }}
        </div>
      </div>
    {{-- </div> --}}
</div>
