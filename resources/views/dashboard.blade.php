<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-5">
            <div class="w-full h-fit flex gap-3 grid-span-2">
                {{-- <button onclick="openFilters()"
                    class="h-18 min-w-fit w-fit text-lg flex items-center cursor-pointer hover:bg-gray-700 duration-300 text-white bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-3 mb-4 py-[2px]">
                    <iconify-icon icon="mage:filter-fill" class="text-white" width="20" height="20"></iconify-icon>
                    <span class="font-semibold ml-1">Filtros</span> --}}
                {{-- </button> --}}
                {{-- <x-filter></x-filter> --}}
                <div
                    class="h-15 min-w-fit text-lg flex items-center cursor-pointer text-white bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg py-[2px]">
                    @php
                        $baseClass =
                            'w-full font-light hover:text-indigo-600 border-b-2 border-solid border-transparent hover:border-b-indigo-600 hover:bg-indigo-600/10 duration-200 p-1 px-2';
                        $activedClass =
                            'w-full font-light font-semibold text-indigo-600 border-b-2 border-solid border-b-indigo-600 hover:bg-indigo-600/10 duration-200 p-1 px-2';
                        $isEmpty =
                            request('type') != 'students' &&
                            request('type') != 'teachers' &&
                            request('type') != 'classes'
                                ? true
                                : false;
                    @endphp

                    <a class="{{ request('type') == 'teachers' ? $activedClass : $baseClass }}"
                        href="/dashboard?type=teachers">Professores</a>
                    <a class="{{ request('type') == 'students' || $isEmpty ? $activedClass : $baseClass }}"
                        href="/dashboard?type=students">Alunos</a>
                    <a class="{{ request('type') == 'classes' ? $activedClass : $baseClass }}"
                        href="/dashboard?type=classes">Turmas</a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg col-start-1 col-end-1">
                <div class="p-3 text-gray-900 dark:text-gray-100">
                    <x-table>
                        @if (request('type') == 'teachers' || request('type') == 'students' || request('type') != 'classes')
                            <x-table-head>
                                <x-t-row>
                                    <x-t-head>{{ __('Name') }}</x-t-head>
                                    <x-t-head>{{ __('E-mail') }}</x-t-head>
                                    <x-t-head>{{ __('Role') }}</x-t-head>
                                    <x-t-head>{{ __('Actions') }}</x-t-head>
                                </x-t-row>
                            </x-table-head>
                        @else
                            <x-table-head>
                                <x-t-row>
                                    <x-t-head>{{ __('Class') }}</x-t-head>
                                    <x-t-head>{{ __('Year') }}</x-t-head>
                                    <x-t-head>{{ __('Shift') }}</x-t-head>
                                    <x-t-head>{{ __('Actions') }}</x-t-head>
                                </x-t-row>
                            </x-table-head>
                        @endif

                        <x-table-body>
                            @if (request('type') == 'teachers')
                                @foreach ($teachers as $user)
                                    <x-t-row>
                                        <x-t-data>{{ $user->name }}</x-t-data>
                                        <x-t-data>{{ $user->email }}</x-t-data>
                                        <x-t-data class="uppercase">{{ $user->userRole->name }}</x-t-data>
                                        <x-t-data>{{ __('') }}</x-t-data>
                                    </x-t-row>
                                @endforeach
                            @endif
                            @if (request('type') == 'students' || $isEmpty)
                                @foreach ($students as $user)
                                    <x-t-row>
                                        <x-t-data>{{ $user->name }}</x-t-data>
                                        <x-t-data>{{ $user->email }}</x-t-data>
                                        <x-t-data class="uppercase">{{ $user->userRole->name }}</x-t-data>
                                        <x-t-data>{{ __('') }}</x-t-data>
                                    </x-t-row>
                                @endforeach
                            @endif
                            @if (request('type') == 'classes')
                                @foreach ($classes as $class)
                                    <x-t-row>
                                        <x-t-data>{{ $class->name }}</x-t-data>
                                        <x-t-data>{{ $class->year }}</x-t-data>
                                        <x-t-data class="uppercase">{{ $class->shift }}</x-t-data>
                                    </x-t-row>
                                @endforeach
                            @endif
                        </x-table-body>
                    </x-table>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg col-start-2 col-end-2">
                <div class="p-3 text-gray-900 dark:text-gray-100">
                    <x-table>
                        <x-table-head>
                            <x-t-row>
                                <x-t-head>{{ __('Subject') }}</x-t-head>
                                <x-t-head>{{ __('') }}</x-t-head>
                                <x-t-head>{{ __('Created at') }}</x-t-head>
                                <x-t-head>{{ __('Actions') }}</x-t-head>
                            </x-t-row>
                        </x-table-head>
                        <x-table-body>
                            @foreach ($subjects as $subject)
                                <x-t-row>
                                    <x-t-data>{{ $subject->name }}</x-t-data>
                                    <x-t-data>{{ __('') }}</x-t-data>
                                    <x-t-data>{{ $subject->created_at }}</x-t-data>
                                    <x-t-data>{{ __('') }}</x-t-data>
                                </x-t-row>
                            @endforeach
                        </x-table-body>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
