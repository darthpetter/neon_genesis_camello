@php
    $icons_style="h-6 w-6";
    $inputs_style="mt-1 flex w-full rounded-md shadow-sm col-span-2 lg:col-span-1";
@endphp

<div class="grid grid-cols-1 gap-4">
    <div>
        <h4 class="header-title text-2xl text-guayaquil-700 font-medium">Redes Sociales</h4>
    </div>

    <div class="p-4 border border-gray-300 rounded-md grid grid-cols-2 gap-5">
        
        <div class="{{ $inputs_style }}">
            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-neutral-500 text-sm">
                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="{{ $icons_style }}"  viewBox="0 0 24 24"><path d="M19,3H5C3.895,3,3,3.895,3,5v14c0,1.105,0.895,2,2,2h7.621v-6.961h-2.343v-2.725h2.343V9.309 c0-2.324,1.421-3.591,3.495-3.591c0.699-0.002,1.397,0.034,2.092,0.105v2.43h-1.428c-1.13,0-1.35,0.534-1.35,1.322v1.735h2.7 l-0.351,2.725h-2.365V21H19c1.105,0,2-0.895,2-2V5C21,3.895,20.105,3,19,3z"/></svg>                
            </span>
            <x-jet-input class="w-full" type="text" name="facebook_profile" id="facebook_profile" placeholder="@usuario" />
        </div>

        <div class="{{ $inputs_style }}">
            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-neutral-500 text-sm">
                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" class="{{ $icons_style }}"><path d="M 8 3 C 5.239 3 3 5.239 3 8 L 3 16 C 3 18.761 5.239 21 8 21 L 16 21 C 18.761 21 21 18.761 21 16 L 21 8 C 21 5.239 18.761 3 16 3 L 8 3 z M 18 5 C 18.552 5 19 5.448 19 6 C 19 6.552 18.552 7 18 7 C 17.448 7 17 6.552 17 6 C 17 5.448 17.448 5 18 5 z M 12 7 C 14.761 7 17 9.239 17 12 C 17 14.761 14.761 17 12 17 C 9.239 17 7 14.761 7 12 C 7 9.239 9.239 7 12 7 z M 12 9 A 3 3 0 0 0 9 12 A 3 3 0 0 0 12 15 A 3 3 0 0 0 15 12 A 3 3 0 0 0 12 9 z"/></svg>
            </span>
            <x-jet-input class="w-full"  type="text" name="instagram_profile" id="instagram_profile" placeholder="@usuario" />
        </div>

        <div class="{{ $inputs_style }}">
            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-neutral-500 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="{{ $icons_style }}" fill="currentColor" viewBox="0 0 1024 1024"><path fill="currentColor" d="M880 112H144c-17.7 0-32 14.3-32 32v736c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V144c0-17.7-14.3-32-32-32ZM727.3 401.7c.3 4.7.3 9.6.3 14.4 0 146.8-111.8 315.9-316.1 315.9-63 0-121.4-18.3-170.6-49.8 9 1 17.6 1.4 26.8 1.4 52 0 99.8-17.6 137.9-47.4-48.8-1-89.8-33-103.8-77 17.1 2.5 32.5 2.5 50.1-2a111.001 111.001 0 0 1-88.9-109v-1.4c14.7 8.3 32 13.4 50.1 14.1a111.135 111.135 0 0 1-49.5-92.4c0-20.7 5.4-39.6 15.1-56a315.285 315.285 0 0 0 229 116.1C492 353.1 548.4 292 616.2 292c32 0 60.8 13.4 81.1 35 25.1-4.7 49.1-14.1 70.5-26.7-8.3 25.7-25.7 47.4-48.8 61.1 22.4-2.4 44-8.6 64-17.3-15.1 22.2-34 41.9-55.7 57.6Z"/></svg>
            </span>
            <x-jet-input class="w-full"  type="text" name="twitter_profile" id="twitter_profile" placeholder="@usuario" />
        </div>

        <div class="{{ $inputs_style }}">
            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-neutral-500 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="{{ $icons_style }}" fill="currentColor" viewBox="0 0 24 24"><path fill="currentColor" d="M8.95 13.4H6.58a5.5 5.5 0 0 1 0-2.8h2.37a11.56 11.56 0 0 0-.1 1.4c.005.468.038.936.1 1.4M7.16 9.2H9.2a12.06 12.06 0 0 1 .98-2.49A5.55 5.55 0 0 0 7.16 9.2m9.68 0a5.59 5.59 0 0 0-3.03-2.49c.424.787.75 1.624.97 2.49M12 17.57a9.502 9.502 0 0 0 1.34-2.77h-2.68c.293.99.746 1.926 1.34 2.77m0-11.15a9.532 9.532 0 0 0-1.34 2.78h2.68A9.532 9.532 0 0 0 12 6.42M7.16 14.8a5.61 5.61 0 0 0 3.02 2.49 12.06 12.06 0 0 1-.98-2.49M21 5v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Zm-2 7a7 7 0 1 0-14 0 7 7 0 0 0 14 0m-3.85 0c-.005.468-.038.936-.1 1.4h2.37a5.499 5.499 0 0 0 0-2.8h-2.37c.062.464.095.932.1 1.4m-1.34 5.29a5.62 5.62 0 0 0 3.03-2.49h-2.06a10.95 10.95 0 0 1-.97 2.49m-3.45-6.69a8.808 8.808 0 0 0 0 2.8h3.28a10.3 10.3 0 0 0 .11-1.4 10.205 10.205 0 0 0-.11-1.4h-3.28Z"/></svg>
            </span>
            <x-jet-input class="w-full"  type="text" name="url_personal" id="url_personal" placeholder="www.ejemplo.com" />
        </div>

        <div class="col-span-2 flex items-center justify-end">
            <button id="btn_guardar-perfil" class="py-2 px-4 bg-guayaquil-600 text-white rounded-md hover:bg-guayaquil-700 focus:bg-guayaquil-400">
                Guardar
            </button>
        </div>

    </div>
</div>