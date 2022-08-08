<x-guest-layout>
    <div class="min-w-screen min-h-screen bg-guayaquil-500 flex items-center justify-center p-5 md:p-10">
        <div class="bg-white rounded-md px-5 md:px-10 py-5 shadow-lg">
            <div class="grid grid-cols-1 gap-6">
                @include('perfil_rrss.secciones.perfil')
                @include('perfil_rrss.secciones.redes_sociales')
            </div>
        </div>
    </div>
</x-guest-layout>