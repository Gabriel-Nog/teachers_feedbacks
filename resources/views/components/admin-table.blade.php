@props(['data'])

<div {{ $attributes->merge(['class' => 'max-w-8xl mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-5']) }}>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg col-start-1 col-end-1">
        @php
            $isEmpty =
                request('type') != 'students' && request('type') != 'teachers' && request('type') != 'classes'
                    ? true
                    : false;
        @endphp
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
                        @foreach ($data['teachers'] as $user)
                            <x-t-row>
                                <x-t-data>{{ $user->name }}</x-t-data>
                                <x-t-data>{{ $user->email }}</x-t-data>
                                <x-t-data class="uppercase">{{ $user->userRole->name }}</x-t-data>
                                <x-t-data>{{ __('') }}</x-t-data>
                            </x-t-row>
                        @endforeach
                    @endif
                    @if (request('type') == 'students' || $isEmpty)
                        @foreach ($data['students'] as $user)
                            <x-t-row>
                                <x-t-data>{{ $user->name }}</x-t-data>
                                <x-t-data>{{ $user->email }}</x-t-data>
                                <x-t-data class="uppercase">{{ $user->userRole->name }}</x-t-data>
                                <x-t-data>
                                <x-nav-link
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                >{{ __('Feedback') }}</x-nav-link>

                                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                    <form method="POST" action="" class="p-6">
                                        @csrf
                                        @method('create')
                            
                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ __('Avalie seu professor') }}
                                        </h2>
                            
                                        <x-sucess-button class="p-6 mt-3">Like</x-sucess-button>
                                        <x-danger-button class="p-6 mt-3 ml-3">Deslike</x-danger-button>
                                        <div class="mt-6">
                                            <x-input-label for="comment" value="{{ __('Comentário') }}"/>
                            
                                            <x-text-area
                                                id="comment"
                                                name="comment"
                                                type="comment"
                                                class="mt-1 auto w-5/6"
                                            />
                            
                                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                        </div>
                            
                                        <div class="mt-6 flex justify-end">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('Cancelar') }}
                                            </x-secondary-button>
                            
                                            <x-primary-button class="ms-3">
                                                {{ __('Enviar') }}
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </x-modal>
                                </x-t-data>
                                
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
                    @foreach ($data['subjects'] as $subject)
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
