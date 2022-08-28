<x-app-layout>
    <div class="bg-guayaquil-600 dark:bg-neutral-800 min-h-screen p-5 md:p-10">
        <div class="grid grid-cols-1 md:gap-4 gap-2 px-10">
            @foreach ($postulaciones as $postulacion )                
                <div id="postulacion_{{ $postulacion->id }}" class="grid grid-cols-1 bg-white rounded-md p-5 relative">
                    <div class="flex items-center justify-between pb-4">
                        <div>
                            <span class="text-sm px-4 py-1 border border-guayaquil-700 text-guayaquil-700">{{ $postulacion->area_labor_descrip }}</span>
                        </div>
                        <div>
                            <a class="text-guayaquil-500 hover:text-emerald-500" href="/postulacion_detalle/{{$postulacion->id}}">
                                <svg class="h-8 w-8" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" transform="translate(3 3)">
                                    <path d="m2.5.5h10c1.1045695 0 2 .8954305 2 2v10c0 1.1045695-.8954305 2-2 2h-10c-1.1045695 0-2-.8954305-2-2v-10c0-1.1045695.8954305-2 2-2z"/><path d="m2.5 2.5h10c1.1045695 0 2 .8954305 2 2v-2c0-1-.8954305-2-2-2h-10c-1.1045695 0-2 1-2 2v2c0-1.1045695.8954305-2 2-2z" fill="currentColor"/><path d="m4.498 7.5h1"/><path d="m4.498 5.5h3.997"/><path d="m4.498 9.5h5.997"/><path d="m4.498 11.5h3.997"/></g>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <span class="header-title text-xl text-neutral-800">{{ __($postulacion->titulo) }}</span>
                    <span class="font-mono font-light text-neutral-600">
                        <textarea class="bg-none border-none overflow-hidden w-full min-h-fit" 
                        rows="auto" disabled style="resize: none">{{ __($postulacion->descripcion) }}</textarea>
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>