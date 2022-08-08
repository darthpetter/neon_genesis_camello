<x-app-layout>
    <div class="min-h-screen min-w-screen bg-neutral-300">
        <div class="py-6 px-10">

            <div class="bg-white rounded-md grid grid-rows-2 gap-4 p-4 my-4 shadow-sm">
                <div class="flex items-center justify-between header-title">
                    <span class="text-xl">
                        {it.titulo}
                    </span>
                    <span>
                        <button type="button" class="text-gray-200 bg-guayaquil-600 hover:bg-guayaquil-700 focus:bg-guayaquil-500 py-2 px-4 rounded-md text-sm">
                            Postularse
                        </button>
                    </span>
                </div>
                <div>
                    {it.descripcion}
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>