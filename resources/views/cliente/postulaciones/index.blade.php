<?php
    $style_options="block p-2 font-mono hover:bg-guayaquil-400"
?>
<x-app-layout>
    <div class="min-w-screen min-h-screen bg-guayaquil-600 dark:bg-neutral-800 p-5 md:p-10">
        <div class="grid grid-cols-1 md:gap-4 gap-2 px-10">

            <div class="grid grid-cols-3 bg-white rounded-md p-5 relative">
                <div class="absolute top-0 right-0">
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
    
                            <x-slot name="content">
                                <div class="w-40">

                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                </div>
                <span class="header-title text-xl text-neutral-800">Se busca una persona que sepa amar</span>
                <span class="font-mono font-light text-neutral-600">
                    se busca persona que tenga experiencia en el area del no se que y no se cuanto.
                </span>
            </div>

    </div>
</x-app-layout>