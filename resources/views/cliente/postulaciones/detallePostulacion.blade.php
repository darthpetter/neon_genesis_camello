@php
    $style_navicon="px-4 py-2 border border-neutral-800 tex-neutral-800 hover:border-guayaquil-800 hover:text-guayaquil-800 hover:shadow-md hover:shadow-neutral-500/40 rounded-lg header-title";
@endphp
<x-app-layout>
    <div class="min-w-screen min-h-screen bg-guayaquil-600 dark:bg-neutral-800">
        <div class="flex items-center justify-center py-20 px-5">
            <div class="bg-white rounded-md w-3/4">
                <form class="w-full">
                    <div class="grid grid-cols-1 gap-4 p-4">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('postulaciones') }}"
                            class="{{ $style_navicon }}"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.333 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z" />
                                </svg>
                            </a>


                            <button type="button"
                            onclick="habilitar_edicion()"
                            class="{{ $style_navicon }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                        </div>
                        <div class="grid grid-cols-1 gap-4 border border-neutral-800 rounded-lg p-2">                            
                            <div>
                                <input
                                id="titulo" name="titulo"
                                type="text" 
                                class="w-full bg-none border-none header-title text-2xl font-semibold text-guayaquil-700"
                                value={{$postulacion->titulo}}
                                disabled
                                />
                            </div>
                            <div>
                                <x-jet-textarea
                                id="descripcion"
                                name="descripcion"
                                class="overflow-hidden w-full bg-none border-none font-mono font-light"
                                rows="10"
                                disabled
                                >{{ $postulacion->descripcion }}</x-jet-textarea>
                            </div>
                            <div>
                                <button type="submit" id="btn_update"
                                class="px-4 py-2 bg-guayaquil-700 text-white hover:bg-guayaquil-800 rounded-md hidden">
                                {{ __('Guardar') }}
                            </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function habilitar_edicion()
    {
        $("#titulo").attr('disabled',false);
        $("#descripcion").attr('disabled',false);
        $("#btn_update").removeClass("hidden");
    }
</script>