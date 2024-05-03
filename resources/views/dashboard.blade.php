<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full h-fit flex gap-3">
                <button onclick="openFilters()"
                    class="h-18 min-w-fit w-fit text-lg flex items-center cursor-pointer hover:bg-gray-700 duration-300 text-white bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-3 mb-4 py-[2px]">
                    <iconify-icon icon="mage:filter-fill" class="text-white" width="20" height="20"></iconify-icon>
                    <span class="font-semibold ml-1">Filtros</span>
                </button>
                <div
                    class="filters h-15 w-0 text-lg flex items-center gap-2 cursor-pointer duration-500 text-white bg-white dark:bg-gray-800 overflow-hidden whitespace-nowrap shadow-sm sm:rounded-lg px-0 mb-4 py-[2px]">
                    <select name="" id=""
                        class="bg-transparent border-2 border-solid border-white border-opacity-40  focus:border-indigo-600 rounded-md h-[80%] py-0">
                        <option disabled selected class="bg-white dark:bg-gray-800 font-semibold">Tipo de busca
                        </option>
                        <option value="name" class="bg-white dark:bg-gray-800">
                            Nome
                        </option>
                        <option value="class" class="bg-white dark:bg-gray-800">
                            Turma
                        </option>
                        <option value="status" class="bg-white dark:bg-gray-800">
                            Status
                        </option>
                    </select>
                    <input type="search"
                        class="bg-transparent border-2 w-full border-solid border-white border-opacity-40 focus:border-indigo-600 rounded-md h-[80%] py-0"
                        placeholder="Buscar por registro">
                </div>
                <div
                    class="h-15 min-w-fit text-lg flex items-center cursor-pointer text-white bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4 py-[2px]">
                    <span
                        class="w-full font-light hover:text-indigo-600 border-b-2 border-solid border-transparent hover:border-b-indigo-600 hover:bg-indigo-600/10 duration-200 p-1 px-2">Professores</span>
                    <span
                        class="w-full font-semibold text-indigo-600 border-b-2 border-solid border-b-indigo-600 hover:bg-indigo-600/10 duration-200 p-1 px-2">Alunos</span>
                    <span
                        class="w-full font-ligh hover:text-indigo-600 border-b-2 border-solid border-transparent hover:border-b-indigo-600 hover:bg-indigo-600/10 duration-200 p-1 px-2">Turmas</span>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 text-gray-900 dark:text-gray-100">
                    <x-table>
                        <x-table-head>
                            <x-t-row>
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
