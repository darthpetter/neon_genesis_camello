<x-guest-layout>

    @php
        $link_style="border border-guayaquil-600 px-4 py-2 rounded-lg shadow-md hover:shadow-xl hover:shadow-guayaquil-600/40";
    @endphp

    <div class="fixed w-full">
        <div class="mt-5 mx-5 grid grid-cols-2 header-title py-3 px-6 bg-white bg-opacity-40 backdrop-blur-sm m-2 rounded-md">
            <div>
                <h1 class="text-guayaquil-600 text-3xl font-medium">Camellaya</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 md:place-items-center">
                <a class="{{ $link_style }}" href="#nosotros">Nosotros</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        @if (Route::has('register'))
                        <a class="{{ $link_style }}" href="#registro">Registrarse</a>
                        @endif
                        <a href="{{ route('login') }}" class="{{ $link_style }}">Acceder</a>
                    @endauth
            @endif
            </div>
        </div>            
    </div>
</x-guest-layout>