<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ Auth::user()->name }}
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
                <x-filter></x-filter>
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
                            @foreach ($teachers as $user)
                                <x-t-row>
                                    <x-t-data>{{ $user->name }}</x-t-data>
                                    <x-t-data>{{ $user->userRole->name }}</x-t-data>
                                </x-t-row>
                            @endforeach
                        </x-table-body>
                    </x-table>
                </div>
                <div class="p-3 text-gray-900 dark:text-gray-100">
                    <x-table>
                        <x-table-head>
                            <x-t-row>
                                <x-t-head>{{ __('Disciplina') }}</x-t-head>
                                <x-t-head>{{ __('Turma') }}</x-t-head>
                                <x-t-head>{{ __('Avalie') }}</x-t-head>
                                <x-t-head>{{ __('Comentário') }}</x-t-head>
                            </x-t-row>
                        </x-table-head>
                        <x-table-body>
                            @foreach ($subjects as $subject)
                                <x-t-row>
                                    <x-t-data>{{ $subject->name }}</x-t-data>
                                    {{-- <x-t-data>{{ $subject-> }}</x-t-data> --}}
                                </x-t-row>
                            @endforeach
                        </x-table-body>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
