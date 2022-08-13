@php
    $inputs_span="grid grid-cols-1 gap-3";
@endphp
<form method="post" action="{{ route('perfil.store') }}">
    @csrf
    <div class="grid grid-cols-1 gap-4">
        <div>
            <h4 class="header-title text-2xl text-guayaquil-700 font-medium">Datos Personales</h4>
        </div>
        <x-jet-validation-errors class="mb-4" />
        <div class="p-4 border border-gray-300 rounded-md grid grid-cols-2 gap-5">
            
            <div class="{{$inputs_span}}">
                <x-jet-label>Tipo de Identificación<span class="text-danger-500">*</span></x-jet-label>
                <x-jet-select id="id_tipo_identificacion" name="id_tipo_identificacion" required>
                    <option selected disabled>-- Seleccione--</option>
                    @foreach($tipos_id as $tipo)
                        <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
                    @endforeach
                </x-jet-select>
            </div>
            
            <div class="{{$inputs_span}}">
                <x-jet-label>Identificación<span class="text-danger-500">*</span></x-jet-label>
                <x-jet-input id="identificacion" name="identificacion" type="text" required value="{{ old('identificacion') }}"/>
            </div>

            <div class="{{$inputs_span}}">
                <x-jet-label>Nombres<span class="text-danger-500">*</span></x-jet-label>
                <x-jet-input type="text" id="nombres" name="nombres" required value="{{ old('nombres') }}"/>
            </div> 

            <div class="{{$inputs_span}}">
                <x-jet-label>Apellidos<span class="text-danger-500">*</span></x-jet-label>
                <x-jet-input type="text" id="apellidos" name="apellidos" required value="{{ old('apellidos') }}"/>
            </div>

            <div class="{{$inputs_span}}">
                <x-jet-label>Fecha de Nacimiento</x-jet-label>
                <x-jet-input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required value="{{ old('fecha_nacimiento') }}"/>
            </div>

            <div class="{{$inputs_span}}">
                <x-jet-label>Sexo</x-jet-label>
                <x-jet-select id="id_sexo" name="id_sexo">
                    <option selected disabled>-- Seleccione--</option>
                    @foreach($sexos as $sexo)
                        <option value="{{$sexo->id}}">{{$sexo->name}}</option>
                    @endforeach
                </x-jet-select>
            </div>

            <div class="col-span-2 {{$inputs_span}}">
                <x-jet-label>Biografía<span class="text-danger-500">*</span></x-jet-label>
                <x-jet-textarea id="bio" name="bio" required value="{{ __(old('bio'))}}"/>
            </div>

            <div class="{{$inputs_span}}">
                <x-jet-label>Dirección Domicilio</x-jet-label>
                <x-jet-input type="text" id="direccion_domicilio" name="direccion_domicilio" value="{{ old('direccion_domicilio') }}"/>
            </div>

            <div class="{{$inputs_span}}">
                <x-jet-label>Dirección Trabajo</x-jet-label>
                <x-jet-input type="text" id="direccion_trabajo" name="direccion_trabajo" value="{{ old('direccion_trabajo') }}"/>
            </div>

            <div class="{{$inputs_span}}">
                <x-jet-label >Telefono 1</x-jet-label>
                <x-jet-input type="number" id="telefono1" name="telefono1" value="{{ old('telefono1') }}"/>
            </div>

            <div class="{{$inputs_span}}">
                <x-jet-label>Telefono 2</x-jet-label>
                <x-jet-input type="number" id="telefono2" name="telefono2" value="{{ old('telefono2') }}"/>
            </div>

            <div class="{{$inputs_span}}">
                <x-jet-label>Celular 1</x-jet-label>
                <x-jet-input type="number" id="calular1" name="calular1" value="{{ old('celular1') }}"/>
            </div>

            <div class="{{$inputs_span}}">
                <x-jet-label>Celular 2</x-jet-label>
                <x-jet-input type="number" id="calular2" name="calular2" value="{{ old('celular2') }}"/>
            </div>

            <div class="col-span-2 flex items-center justify-end">
                <button id="btn_guardar-perfil" type="submit" class="py-2 px-4 bg-guayaquil-600 text-white rounded-md hover:bg-guayaquil-700 focus:bg-guayaquil-400">
                {{ __('Guardar') }}
                </button>
            </div>
            
        </div>
    </div>
</form>