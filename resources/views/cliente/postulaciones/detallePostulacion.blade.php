<x-app-layout>
    <div class="min-w-screen min-h-screen bg-guayaquil-600 dark:bg-neutral-800">
        <div class="grid grid-cols-1 gap-4 p-5 md:px-20 md:py-10">
            <div class="grid grid-cols-1 gap-2 p-5 rounded-md bg-white">
                <div class="flex items-center">
                    <span class="header-title text-2xl">{{ $postulacion->titulo }}</span>
                    @if ($postulacion->estado=='C')      
                        <span class="ml-4">                            
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </span>                  
                    @endif
                </div>
                <div>
                    <textarea rows="6" class="w-full border-none overflow-hidden" disabled readonly
                    >{{ $postulacion->descripcion }}</textarea>
                </div>
                @if ($postulacion->id_postulante_seleccionado!==NULL && $postulacion->estado=='C')
                    <div class="bg-emerald-300 bg-opacity-40 backdrop-blur-md rounded-md p-5">
                        <span class="font-semibold header-title mr-4">Profesionista seleccionado:</span><span>{{ $seleccionado->nombres?$seleccionado->nombres:" " }}&nbsp;{{ $seleccionado->apellidos?$seleccionado->apellidos:" " }}</span>
                    </div>
                @endif    
            </div>
            @foreach ($asignaciones as $item)
                <div class="p-5 rounded-md bg-white bg-opacity-70 backdrop-blur-md">
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <span class="header-title text-xl text-emerald-600">{{ $item->nombres?$item->nombres:" " }}&nbsp;{{ $item->apellidos?$item->apellidos:" " }}</span>
                        </div>
                        @if ($postulacion->id_postulante_seleccionado==NULL && $postulacion->estado!='C')
                            <form method="post" action="{{ route('postulacion.seleccion') }}">
                                @csrf
                                <x-jet-input id="id_profesionista" name="id_profesionista" type="text" value="{{ $item->id_usuario_creador }}" class="hidden"/>
                                <x-jet-input id="id_postulacion" name="id_postulacion" type="text"  value="{{ $item->id_postulacion }}" class="hidden"/>
                                <button type="submit" 
                                class="px-4 py-2 rounded-md bg-emerald-600 hover:bg-emerald-700 text-white">
                                    {{ __('Seleccionar') }}
                                </button>
                            </form>
                        @endif
                        <div class="mt-1 flex w-full rounded-md shadow-sm col-span-2 lg:col-span-1">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-neutral-500 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <x-jet-input 
                            class="w-full"  
                            type="text"
                            value="{{ $item->monto_propuesto }}"
                            disabled 
                            placeholder="??Por cu??nto realizar??as esta labor?" />
                        </div>
                        <div class="mt-1 flex w-full rounded-md shadow-sm col-span-2 lg:col-span-1">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-neutral-500 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                </svg>                                                          
                            </span>
                            <x-jet-textarea
                            class="w-full"  
                            type="text"
                            disabled 
                            placeholder="??Tiene algo que agregar?">{{ $item->comentario }}</x-jet-textarea>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>