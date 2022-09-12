<x-app-layout>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
  
    <div class="bg-guayaquil-600 dark:bg-neutral-800 min-h-screen p-3 md:p-12">
        <div class="grid grid-cols-2 md:gap-4 gap-4 rounded-md p-4 bg-white">
            <span class="col-span-2 header-title text-2xl font-medium text-guayaquil-700">
                Estadísticas | Profesionista
            </span>
            <div class="col-span-2 lg:col-span-1 p-4 border border-guayaquil-600 shadow-md rounded-lg">
                @include('reporteria.profesionista.componentes.engageSeleccionChart');
            </div>
        </div>
    </div>
</x-app-layout>