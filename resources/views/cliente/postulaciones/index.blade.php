@php
    $style_options="block p-2 font-mono hover:bg-guayaquil-400";
    $style_btn_primary="dark:bg-guayaquil-600 dark:hover:bg-guayaquil-700 dark:focus:bg-guayaquil-400 bg-neutral-800 hover:bg-neutral-900 text-white py-2 px-4 rounded-lg";

    $params=$_GET;
@endphp
<x-app-layout>
    <div x-data="modal()" class="bg-guayaquil-600 dark:bg-neutral-800 min-h-screen p-5 md:p-10">

        <div class="grid grid-cols-1 md:gap-4 gap-2 p-5">
            <span>
                <button x-on:click="open()" 
                type="button" 
                class="{{$style_btn_primary}}" 
                data-toggle="modal" data-target="#exampleModalTwo"
                >
                    Crear
                </button>
            </span>
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
                        <div class="flex">
                            <div>
                                <a class="text-guayaquil-500 hover:text-emerald-500" href="/postulacion/{{$postulacion->id}}">
                                    <svg class="h-6 w-6" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" transform="translate(3 3)">
                                        <path d="m2.5.5h10c1.1045695 0 2 .8954305 2 2v10c0 1.1045695-.8954305 2-2 2h-10c-1.1045695 0-2-.8954305-2-2v-10c0-1.1045695.8954305-2 2-2z"/><path d="m2.5 2.5h10c1.1045695 0 2 .8954305 2 2v-2c0-1-.8954305-2-2-2h-10c-1.1045695 0-2 1-2 2v2c0-1.1045695.8954305-2 2-2z" fill="currentColor"/><path d="m4.498 7.5h1"/><path d="m4.498 5.5h3.997"/><path d="m4.498 9.5h5.997"/><path d="m4.498 11.5h3.997"/></g>
                                    </svg>
                                </a>
                            </div>
                            <button 
                                type="button" onclick="eliminar({{ $postulacion->id }})"
                                class="text-neutral-900 hover:text-danger-500">
                                <svg class="h-6 w-6" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                                    <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" transform="translate(2 2)"><circle cx="8.5" cy="8.5" r="8"/><g transform="matrix(0 1 -1 0 17 0)"><path d="m5.5 11.5 6-6"/><path d="m5.5 5.5 6 6"/></g></g>
                                </svg>
                            </button>
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
                                <div>
                                    <x-jet-label value="Area de Labor"/>
                                    <x-jet-select class="w-full" id="id_area_labor" name="id_area_labor">
                                        <option value="0" selected disabled>--seleccione--</option>
                                        @foreach ($areas_labor as $area )
                                            <option value="{{$area->id}}">{{ $area->nombre }}</option>
                                        @endforeach
                                    </x-jet-select>
                                    <span id="error_id_area_labor" name="error_area_labor" class="text-danger-500"></span>
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
        const titulo=$('#titulo').val()
        const descripcion=$('#descripcion').val()
        const id_area_labor=$('#id_area_labor').val()

        const request={
            titulo,
            descripcion,
            id_area_labor,
        }

        await peticionGuardar(request)
            .then(response=>{
                if(response.status==401){
                    $('#error_titulo').html(response.error.titulo ? response.error.titulo : '');
                    $('#error_descripcion').html(response.error.descripcion ? response.error.descripcion : '')
                    $('#error_id_area_labor').html(response.error.id_area_labor ? response.error.id_area_labor : '')
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

    async function eliminar(id_postulacion)
    {
        const request={
            id_postulacion,
        }

        await peticionEliminar(request)
            .then(response=>{
                console.log("🚀 ~ file: index.blade.php ~ line 215 ~ response", response)
                if(response.status=200){
                    $(`#postulacion_${id_postulacion}`).addClass('animate-pulse')
                    Swal.fire({
                        title: 'Postulación Eliminada Correctamente',
                        icon: 'success',
                    })

                    setTimeout(()=>{
                        $(`#postulacion_${id_postulacion}`).remove()
                    },2000)
                }else{
                    Swal.fire({
                        title: 'ERROR',
                        message:'Algo salió mal):',
                        icon: 'error',
                    })
                }
            });
    }

    function peticionEliminar(request)
    {
        const reqOption={
            method: "DELETE",
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
</script>