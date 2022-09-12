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
                    <x-jet-button type="submit" class="bg-emerald-500 text-white hover:bg-emerald-600 p-5 rounded-md flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </x-jet-button>
                </div>
            </form>
            @foreach ($postulaciones as $postulacion )                
                <div id="postulacion_{{ $postulacion->id }}" class="grid grid-cols-1 bg-white rounded-md p-5 relative">
                    <div class="flex items-center justify-between pb-4">
                        <div class="flex">
                            <span class="text-sm px-4 py-1 border border-guayaquil-700 text-guayaquil-700">{{ $postulacion->area_labor_descrip }}</span>
                            @if($postulacion->estado=='C')
                                <span class="ml-3 px-2 py-1 border border-emerald-700 text-emerald-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>                                  
                                </span>
                            @endif
                        </div>
                        <div>
                            <a class="text-guayaquil-700 hover:text-emerald-700" target="_blank" href="/postulacion_detalle/{{$postulacion->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="h-5 w-5" fill="currentColor">
                                    <path d="M9 42q-1.2 0-2.1-.9Q6 40.2 6 39V9q0-1.2.9-2.1Q7.8 6 9 6h12.45q.65 0 1.075.425.425.425.425 1.075 0 .65-.425 1.075Q22.1 9 21.45 9H9v30h30V26.55q0-.65.425-1.075.425-.425 1.075-.425.65 0 1.075.425Q42 25.9 42 26.55V39q0 1.2-.9 2.1-.9.9-2.1.9Zm9.05-12.05q-.4-.45-.425-1.05-.025-.6.425-1.05L36.9 9h-9.45q-.65 0-1.075-.425-.425-.425-.425-1.075 0-.65.425-1.075Q26.8 6 27.45 6H40.5q.65 0 1.075.425Q42 6.85 42 7.5v13.05q0 .65-.425 1.075-.425.425-1.075.425-.65 0-1.075-.425Q39 21.2 39 20.55v-9.4L20.15 30q-.4.4-1.025.4-.625 0-1.075-.45Z"/>
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