{{--tratar de nunca usar inline css y desidir si usaa tailwindcss o bootstrap--}}
<div class="min-h-screen grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2">

    <div class="flex flex-col justify-center items-center">
        <h1 class="text-2xl font-bold my-4 ">Agregar un titulo</h1>
        {{ $slot }}
    </div>
    <div class="hidden md:block lg:block bg-login"></div>
</div>
