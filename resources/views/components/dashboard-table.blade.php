@props(['data'])
<div {{ $attributes->merge(['class' => 'max-w-8xl mx-auto sm:px-6 lg:px-8 flex gap-5']) }}>
    <div class="w-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        @php
            $isEmpty =
                request('type') != 'students' && request('type') != 'teachers' && request('type') != 'classes'
                    ? true
                    : false;
        @endphp
        <div class="w-full p-3 text-gray-900 dark:text-gray-100">
            <x-table>
                @if (request('type') == 'teachers' || request('type') == 'students' || request('type') != 'classes')
                    <x-table-head>
                        <x-t-row>
                            <x-t-head>{{ __('Name') }}</x-t-head>
                            <x-t-head>{{ __('E-mail') }}</x-t-head>
                            @if (request('type') == 'teachers')
                                <x-t-head>{{ __('Subject') }}</x-t-head>
                            @else
                                <x-t-head>{{ __('Role') }}</x-t-head>
                            @endif
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
                        @foreach ($data['teachers'] as $user)
                            <x-t-row>
                                <x-t-data>{{ $user->name }}</x-t-data>
                                <x-t-data>{{ $user->email }}</x-t-data>
                                @if ($user->subjectAsParticipant)
                                    <x-t-data>{{ $user->subjectAsParticipant->name }}</x-t-data>
                                @else
                                    <x-t-data>{{ __('N/A') }}</x-t-data>
                                @endif
                                <x-t-data>{{ __('') }}</x-t-data>
                            </x-t-row>
                        @endforeach
                    @endif
                    @if (request('type') == 'students' || $isEmpty)
                        @foreach ($data['students'] as $user)
                            <x-t-row>
                                <x-t-data>{{ $user->name }}</x-t-data>
                                <x-t-data>{{ $user->email }}</x-t-data>
                                <x-t-data class="uppercase">{{ $user->roles[0]->name }}</x-t-data>
                                <x-t-data>{{ __('') }}</x-t-data>
                            </x-t-row>
                        @endforeach
                    @endif
                    @if (request('type') == 'classes')
                        @foreach ($data['classes'] as $class)
                            <x-t-row>
                                <x-t-data>{{ $class->name }}</x-t-data>
                                <x-t-data>{{ $class->year }}</x-t-data>
                                <x-t-data class="uppercase">{{ $class->shift }}</x-t-data>
                                <x-t-data>{{ __('') }}</x-t-data>
                            </x-t-row>
                        @endforeach
                    @endif
                </x-table-body>
            </x-table>
        </div>
    </div>
    @can('view all' || 'view teacher')
        <div class="w-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 text-gray-900 dark:text-gray-100">
                <x-table>
                    <x-table-head>
                        <x-t-row>
                            <x-t-head>{{ __('Subject') }}</x-t-head>
                            <x-t-head>{{ __('Teacher') }}</x-t-head>
                            <x-t-head>{{ __('Created at') }}</x-t-head>
                            <x-t-head>{{ __('Actions') }}</x-t-head>
                        </x-t-row>
                    </x-table-head>
                    <x-table-body>
                        @foreach ($data['subjects'] as $subject)
                            <x-t-row>
                                <x-t-data>{{ $subject->name }}</x-t-data>
                                @if ($subject->user)
                                    <x-t-data>{{ $subject->user->name }}</x-t-data>
                                @else
                                    <x-t-data>{{ __('N/A') }}</x-t-data>
                                @endif
                                <x-t-data>{{ $subject->created_at }}</x-t-data>
                                <x-t-data>{{ __('') }}</x-t-data>
                            </x-t-row>
                        @endforeach
                    </x-table-body>
                </x-table>
            </div>
        </div>
    @endcan

</div>
