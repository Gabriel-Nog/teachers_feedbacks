<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full h-fit flex gap-5">
                <div
                    class="h-10 w-fit text-lg flex items-center cursor-pointer hover:bg-gray-600 duration-300 text-white bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-3 mb-4">
                    <iconify-icon icon="mage:filter-fill" class="text-white" width="20" height="20"></iconify-icon>
                    <span class="font-semibold ml-3">Filtros</span>
                </div>
                <div
                    class="h-10 w-fit text-lg flex items-center gap-3 cursor-pointer text-white bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-5 mb-4">
                    <span class="font-light hover:underline duration-200">Professores</span>/
                    <span class="font-semibold underline hover:underline duration-200">Alunos</span>/
                    <span class="font-light hover:underline duration-200">Turmas</span>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <x-table>
                        <x-table-head>
                            <x-t-row class="border-b-2 border-solid border-white border-opacity-20">
                                <x-t-head>{{ __('Nome') }}</x-t-head>
                                <x-t-head>{{ __('Turma') }}</x-t-head>
                                <x-t-head>{{ __('Status') }}</x-t-head>
                                <x-t-head>{{ __('Ações') }}</x-t-head>
                            </x-t-row>
                        </x-table-head>
                        <x-table-body>
                            <x-t-row>
                                <x-t-data>{{ __('Jair') }}</x-t-data>
                                <x-t-data>{{ __('ADS 2022.1') }}</x-t-data>
                                <x-t-data>{{ __('Ativo') }}</x-t-data>
                                <x-t-data>{{ __('Editar') }}</x-t-data>
                            </x-t-row>
                            <x-t-row>
                                <x-t-data>{{ __('Kauã Santiago') }}</x-t-data>
                                <x-t-data>{{ __('S.I 2024.1') }}</x-t-data>
                                <x-t-data>{{ __('Ativo') }}</x-t-data>
                                <x-t-data>{{ __('Editar') }}</x-t-data>
                            </x-t-row>
                            <x-t-row>
                                <x-t-data>{{ __('João Gabriel') }}</x-t-data>
                                <x-t-data>{{ __('C.C 2022.1') }}</x-t-data>
                                <x-t-data>{{ __('Ativo') }}</x-t-data>
                                <x-t-data>{{ __('Editar') }}</x-t-data>
                            </x-t-row>
                            <x-t-row>
                                <x-t-data>{{ __('Aglayrton Julião') }}</x-t-data>
                                <x-t-data>{{ __('ADS 1543.1') }}</x-t-data>
                                <x-t-data>{{ __('Ativo') }}</x-t-data>
                                <x-t-data>{{ __('Editar') }}</x-t-data>
                            </x-t-row>
                        </x-table-body>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
