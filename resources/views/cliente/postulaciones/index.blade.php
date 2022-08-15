<?php
    $style_options="block p-2 font-mono hover:bg-guayaquil-400"
?>
<x-app-layout>
    <div class="min-w-screen min-h-screen bg-guayaquil-600 dark:bg-neutral-800 p-5 md:p-10">
        <div class="grid grid-cols-1 md:gap-4 gap-2 px-10">
            <span>
                <button type="button" onclick="showModal()" class="p-2 rounded-md bg-guayaquil-500">CREAR</button>
            </span>

            @foreach ($postulaciones as $postulacion )                
                <div class="grid grid-cols-1 bg-white rounded-md p-5 relative">
                    <span class="header-title text-xl text-neutral-800">{{ __($postulacion->titulo) }}</span>
                    <span class="font-mono font-light text-neutral-600">
                        {{ __($postulacion->descripcion) }}
                    </span>
                </div>
            @endforeach

        </div>

        <div id="modal" class="hidden">
            <div class="z-99 absolute top-0 right-0 bottom-0 left-0 min-w-full min-h-full bg-black bg-opacity-25 flex items-center justify-center"> 
                <div class="bg-guayaquil-100 rounded-md p-10 w-1/2 shadow-lg">
                    <form id="crearPostulacion">
                        <div class="grid grid-cols-1 gap-3">
                            <div>
                                <x-jet-label value="Titulo"/>
                                <x-jet-input onchange="handleInput(event)" class="w-full" name="titulo" id="titulo"  type="text"/>
                                <span id="error_titulo" name="error_titulo" class="text-danger-500"></span>
                            </div>
                            <div>
                                <x-jet-label value="Descripción"/>
                                <x-jet-textarea onchange="handleInput(event)" class="w-full" placeholder="Descripcion" name="descripcion" id="descripcion"/>
                                <span id="error_descripcion" name="error_descripcion" class="text-danger-500"></span>
                            </div>
                            <div>
                                <x-jet-button type="button" onclick="guardar()">{{ __('Guardar') }}</x-jet-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</x-app-layout>

<script>
    function showModal()
    {
        const modal=document.getElementById('modal')
        modal.classList.toggle('hidden')
    }

    async function guardar()
    {
        const titulo=document.getElementById('titulo');
        const descripcion=document.getElementById('descripcion');
        const request={
            titulo:titulo.value,
            descripcion:descripcion.value,
        }

        await peticionGuardar(request)
            .then(response=>{
                console.log("🚀 ~ file: index.blade.php ~ line 69 ~ data", response)
                if(response.status==401){
                    document.getElementById('error_titulo').innerHTML=response.error.titulo ? response.error.titulo : ''
                    document.getElementById('error_descripcion').innerHTML=response.error.descripcion ? response.error.descripcion : ''
                }
            });
    }

    function peticionGuardar(request)
    {
        const reqOption={
            method: "POST",
            headers:{
                'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
            },
            body:JSON.stringify(request),
        }

        return fetch('/postulacion',reqOption).
            then(response=>{
                console.log("🚀 ~ file: index.blade.php ~ line 91 ~ response", response)
                return response.json()
            }).catch(error=>{
                console.log("🚀 ~ file: index.blade.php ~ line 94 ~ error", error)
                return error
            });
    }

    function handleInput(event)
    {
        document.getElementById('error_titulo').innerHTML=''
        document.getElementById('error_descripcion').innerHTML=''
    }
</script>