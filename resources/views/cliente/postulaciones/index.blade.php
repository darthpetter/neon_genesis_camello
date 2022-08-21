@php
    $style_options="block p-2 font-mono hover:bg-guayaquil-400";
    $style_btn_primary="dark:bg-guayaquil-600 dark:hover:bg-guayaquil-700 dark:focus:bg-guayaquil-400 bg-neutral-800 hover:bg-neutral-900 text-white py-2 px-4 rounded-lg";
@endphp
<x-app-layout>
    <div x-data="modal()" class="bg-guayaquil-600 dark:bg-neutral-800 min-h-screen p-5 md:p-10">

        <div class="grid grid-cols-1 md:gap-4 gap-2 px-10">
            <span>
                <button x-on:click="open()" 
                type="button" 
                class="{{$style_btn_primary}}" 
                data-toggle="modal" data-target="#exampleModalTwo"
                >
                    Crear
                </button>
            </span>

            @foreach ($postulaciones as $postulacion )                
                <div class="grid grid-cols-1 bg-white rounded-md p-5 relative">
                    <span class="header-title text-xl text-neutral-800">{{ __($postulacion->titulo) }}</span>
                    <span class="font-mono font-light text-neutral-600">
                        <textarea class="bg-none border-none overflow-hidden w-full min-h-fit" 
                        rows="auto" disabled style="resize: none">{{ __($postulacion->descripcion) }}</textarea>
                    </span>
                    <a class="text-green-500 " href="/postulacion/{{$postulacion->id}}">Detalles</a>
                </div>
            @endforeach

        </div>
      
        <!-- MODAL CONTAINER WITH BACKDROP -->
        <div x-show="isOpening()">
      
          <!-- MODAL -->
          <div
            :class="{ 'opacity-0': isOpening(), 'opacity-100': isOpen() }"
            class="fixed z-50 top-0 left-0 w-full h-full outline-none transition-opacity duration-200 linear"
            tabindex="-1"
            role="dialog"
          >
      
            <!-- MODAL DIALOG -->
            <div
              :class="{ 'mt-4': isOpening(), 'mt-8': isOpen() }"
              class="relative w-auto pointer-events-none max-w-lg mt-8 mx-auto transition-all duration-200 ease-out"
            >
      
              <!-- MODAL CONTAINER -->
              <div class="relative flex flex-col w-full pointer-events-auto bg-white border border-gray-300 rounded-lg shadow-xl">
                <div class="flex items-start justify-between p-4 border-b border-gray-300 rounded-t">
                  <h5 class="mb-0 text-lg leading-normal">Nueva Postulación</h5>
                  <button
                    type="button"
                    class="close"
                    x-on:click="close()"
                  >&times;</button>
                </div>
                <div class="relative flex p-4">
                    <div class="w-full">
                        <form id="crearPostulacion" class="w-full">
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
                            </div>
                        </form>
                    </div>
                </div>
                <div class="flex items-center justify-end p-4 border-t border-gray-300">
                  <button
                    x-on:click="close()"
                    type="button"
                    class="inline-block font-normal text-center px-3 py-2 leading-normal text-base rounded cursor-pointer text-white bg-gray-600 mr-2"
                  >Cancelar</button>
                  <button
                    type="button"
                    id="btn_guardar_postulacion"
                    onclick="guardar()"
                    class="inline-block font-normal text-center px-3 py-2 leading-normal text-base rounded cursor-pointer text-white bg-guayaquil-600"
                  >Guardar</button>
                </div>
              </div>
            </div>
          </div>
      
          <!-- BACKDROP -->
          <div
            :class="{ 'opacity-25': isOpen() }"
            class="z-40 fixed top-0 left-0 bottom-0 right-0 bg-black opacity-0 transition-opacity duration-200 linear"
          ></div>
        </div>
    </div>
</x-app-layout>


<script>

    function modal() {
        return {
        state: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
        open() {
            this.state = 'TRANSITION'
            setTimeout(() => { this.state = 'OPEN' }, 50)
        },
        close() {
            this.state = 'TRANSITION'
            setTimeout(() => { this.state = 'CLOSED' }, 300)
        },
        isOpen() { return this.state === 'OPEN' },
        isOpening() { return this.state !== 'CLOSED' },
        }
    }
    function modal2() {
        return {
        state: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
        open() {
            this.state = 'TRANSITION'
            setTimeout(() => { this.state = 'OPEN' }, 50)
        },
        close() {
            this.state = 'TRANSITION'
            setTimeout(() => { this.state = 'CLOSED' }, 300)
        },
        isOpen() { return this.state === 'OPEN' },
        isOpening() { return this.state !== 'CLOSED' },
        }
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
                if(response.status==401){
                    $('#error_titulo').html(response.error.titulo ? response.error.titulo : '');
                    $('#error_descripcion').html(response.error.descripcion ? response.error.descripcion : '')
                }else if(response.status==200){
                    $("#btn_guardar_postulacion").attr("disabled", true);
                    Swal.fire({
                        title: 'Postulación guardada correctamente',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    document.location.reload()
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
        $(`#error_${event.target.id}`).html('')
    }
</script>