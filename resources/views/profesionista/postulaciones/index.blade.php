<x-app-layout>
    <div class="bg-guayaquil-600 dark:bg-neutral-800 min-h-screen p-5 md:p-10">
        <div class="grid grid-cols-1 md:gap-4 gap-2 px-10">
            <form action="{{ route('postulaciones') }}">
                <div class="grid grid-cols-5 gap-3">
                    <div class="col-span-4 grid grid-cols-4 gap-3">
                        @foreach ($areas_labor as $area) 
                            <div class="border border-neutral-500 rounded-md px-4 py-2">
                                <input name="{{ __($area->id) }}"  type="checkbox" class="p-2 rounded-md focus:bg-guayaquil-500 inline-block pr-3"
                                @if(isset($params[$area->id]))
                                    checked
                                @endif/>
                                <x-jet-label class="text-neutral-200 inline-block" value="{{ __($area->nombre) }}"/>
                            </div>
                        @endforeach
                    </div>
                    <x-jet-button type="submit" class="bg-emerald-500 text-white hover:bg-emerald-700 p-5 rounded-md flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>  
                    </x-jet-button>
                </div>
            </form>
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