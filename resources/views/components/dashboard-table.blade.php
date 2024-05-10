@props(['data'])

<div {{ $attributes->merge(['class' => 'w-full max-w-8xl mx-auto sm:px-6 lg:px-8']) }}>
    @if ($errors->all())
        <x-input-error :messages="$errors->all()" class="mt-2" />
    @endif

    @if (session('msg'))
        <x-input-success :messages="session('msg')" class="mt-2" />
    @endif

    <div class="w-full bg-white dark:bg-gray-800 text-white overflow-hidden shadow-sm sm:rounded-lg">
        @php

            $amount = 10;

            $allSubjects = $data['subjects'];
            $allClasses = $data['classes'];
            $allTeachers = $data['teachers'];
            $allStudents = $data['students'];
            $subjectsUser = $data['subjectsUser'];
            if (Auth::user()->roles[0]->name == 'teacher') {
                $allTeachers = [Auth::user()];

                if (Auth::user()->subjectAsParticipant->first()) {
                    $allSubjects = Auth::user()->subjectAsParticipant;
                }

                if (Auth::user()->classeAsParticipant->count() > 0) {
                    $allClasses = Auth::user()->classeAsParticipant;
                }

                $classesUser = [];
                $classes = [];
                foreach ($data['classesUser'] as $class) {
                    foreach ($allClasses as $ac) {
                        if ($ac->id == $class->id) {
                            array_push($classes, $ac);
                        }
                    }
                }

                $classesUser = collect($classes);

                $students = [];

                foreach ($allStudents as $s) {
                    foreach ($classesUser as $class) {
                        foreach ($data['classesUser'] as $c) {
                            if ($c->user_id == $s->id && $class->id == $c->classes_id) {
                                array_push($students, $s);
                            }
                        }
                    }
                }

                $allStudents = collect($students);
            }

            if (Auth::user()->roles[0]->name == 'student') {
                if (Auth::user()->classeAsParticipant->first()) {
                    $allClasses = Auth::user()->classeAsParticipant;
                    $classesUser = $data['classesUser']->filter(function ($class) use ($allClasses) {
                        return $allClasses->first()->id == $class->classes_id;
                    });

                    $teachers = [];
                    $subjects = [];
                    $teachersWithSubject = [];
                    foreach ($allSubjects as $s) {
                        foreach ($classesUser as $c) {
                            if ($c->subject == $s->name) {
                                array_push($subjects, $s);
                            }
                        }
                    }
                    foreach ($subjectsUser as $su) {
                        foreach ($subjects as $s) {
                            if ($teachersWithSubject) {
                                foreach ($teachersWithSubject as $ts) {
                                    if ($s->id == $su->subjects_id && !$ts->where('subjects_id', $s->id)) {
                                        array_push($teachersWithSubject, $su);
                                    }
                                }
                            } else {
                                if ($s->id == $su->subjects_id) {
                                    array_push($teachersWithSubject, $su);
                                }
                            }
                        }
                    }

                    foreach ($teachersWithSubject as $ts) {
                        foreach ($allTeachers as $t) {
                            if ($ts->user_id == $t->id) {
                                array_push($teachers, $t);
                            }
                        }
                    }

                    $allTeachers = collect($teachers);

                    $subjectsU = [];
                    foreach ($allSubjects as $s) {
                        foreach ($subjectsUser as $su) {
                            if ($su->subjects_id == $s->id) {
                                array_push($subjectsU, $s);
                            }
                        }
                    }

                    $allSubjects = collect($subjectsU);

                    $classesUser = $data['classesUser']->filter(function ($class) use ($allClasses) {
                        return $allClasses->first()->id == $class->classes_id;
                    });

                    $students = [];
                    foreach ($allStudents as $s) {
                        foreach ($classesUser as $c) {
                            if ($s->id == $allClasses->first()->user_id) {
                                $s->name += '(você)';
                            }
                            if ($c->user_id == $s->id) {
                                array_push($students, $s);
                            }
                        }
                    }

                    $allStudents = collect($students);
                } else {
                    $allStudents = [Auth::user()];
                    $allTeachers = [];
                    $allClasses = [];
                }
            }

            $isEmpty =
                request('type') != 'Alunos' && request('type') != 'Professores' && request('type') != 'Turmas'
                    ? true
                    : false;
        @endphp
        <x-table>
            @if (request('type') == 'Professores' || request('type') == 'Alunos' || (request('type') != 'Turmas' && !$isEmpty))
                <x-table-head>
                    @if (Auth::user()->roles[0]->name == 'teacher')
                        @if (request('type') == 'Professores')
                            <x-t-row>
                                <x-t-head>{{ __('Nome') }}</x-t-head>
                                <x-t-head>{{ __('E-mail') }}</x-t-head>
                                <x-t-head>{{ __('Turmas/Disciplinas') }}</x-t-head>
                                <x-t-head>{{ __('Ações') }}</x-t-head>
                            </x-t-row>
                        @else
                            <x-t-row>
                                <x-t-head>{{ __('Nome') }}</x-t-head>
                                <x-t-head>{{ __('E-mail') }}</x-t-head>
                                <x-t-head>{{ __('Turma') }}</x-t-head>
                            </x-t-row>
                        @endif
                    @endif
                    @if (Auth::user()->roles[0]->name == 'student')
                        @if (request('type') == 'Professores')
                            <x-t-row>
                                <x-t-head>{{ __('Nome') }}</x-t-head>
                                <x-t-head>{{ __('E-mail') }}</x-t-head>
                                <x-t-head>{{ __('Turmas/Disciplinas') }}</x-t-head>
                                <x-t-head>{{ __('Ações') }}</x-t-head>
                            </x-t-row>
                        @else
                            <x-t-row>
                                <x-t-head>{{ __('Nome') }}</x-t-head>
                                <x-t-head>{{ __('E-mail') }}</x-t-head>
                                <x-t-head>{{ __('Turma') }}</x-t-head>
                            </x-t-row>
                        @endif
                    @endif
                    @if (Auth::user()->roles[0]->name == 'super-admin')
                        @if (request('type') == 'Professores')
                            <x-t-row>
                                <x-t-head>{{ __('Nome') }}</x-t-head>
                                <x-t-head>{{ __('E-mail') }}</x-t-head>
                                <x-t-head>{{ __('Turmas/Disciplinas') }}</x-t-head>
                                <x-t-head>{{ __('Ações') }}</x-t-head>
                                <x-t-head>{{ __('Feedbacks') }}</x-t-head>
                            </x-t-row>
                        @else
                            <x-t-row>
                                <x-t-head>{{ __('Nome') }}</x-t-head>
                                <x-t-head>{{ __('E-mail') }}</x-t-head>
                                <x-t-head>{{ __('Turma') }}</x-t-head>
                                <x-t-head>{{ __('Ações') }}</x-t-head>
                            </x-t-row>
                        @endif
                    @endif
                </x-table-head>
            @else
                <x-table-head>
                    <x-t-row>
                        <x-t-head>{{ __('Turma') }}</x-t-head>
                        <x-t-head>{{ __('Ano') }}</x-t-head>
                        <x-t-head>{{ __('Turno') }}</x-t-head>
                    </x-t-row>
                </x-table-head>
            @endif

            <x-table-body>
                @if (request('type') == 'Professores')
                    @foreach ($allTeachers as $user)
                        <x-t-row>
                            <x-t-data>{{ $user->name }}</x-t-data>
                            <x-t-data>{{ $user->email }}</x-t-data>
                            @if ($user->classeAsParticipant->count() > 0)
                                <x-t-data>
                                    <a href="{{ route('classes.view-classes', $user->id) }}"
                                        class="text-gray-500 hover:underline">Ver turmas/disciplinas</a>
                                </x-t-data>
                            @else
                                <x-t-data>{{ __('N/A') }}</x-t-data>
                            @endif

                            @if (Auth::user()->roles[0]->name == 'student')
                                @if (!in_array(Auth::user()->email, $user->emails_feedbacks))
                                    <x-t-data>
                                        <x-nav-link x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'feedback-modal-{{ $user->id }}')">{{ __('Feedback') }}</x-nav-link>

                                        <x-modal name="feedback-modal-{{ $user->id }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                            <form method="POST" action="{{ route('feedbacks.store') }}" class="p-6">
                                                @csrf
                                                @method('POST')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ 'Avaliando: ' . $user->subjectAsParticipant->first()->name . ' > ' . $user->name }}

                                                </h2>

                                                <div>
                                                    <x-sucess-button class="active" type="button" class="p-6 mt-3 mr-2"
                                                        data-action="like" onclick="handleFeedbackAction(event)">
                                                        <div class="flex items-center gap-2">
                                                            <iconify-icon icon="mdi:like-outline" width="28"
                                                                height="28" style="color: #fff"
                                                                title="like"></iconify-icon>
                                                    </x-sucess-button>
                                                    <x-danger-button type="button" class="p-6 mt-3 ml-3"
                                                        data-action="dislike" onclick="handleFeedbackAction(event)">
                                                        <iconify-icon icon="mdi:like-outline" width="28"
                                                            height="28"
                                                            style="color: #fff; transform: rotate(.5turn);"
                                                            title="unlike"></iconify-icon>
                                                    </x-danger-button>
                                                </div>

                                                <input type="hidden" name="feedback_action" class="feedback_action" />
                                                <input type="hidden" name="teacher_id" value="{{ $user->id }}" />

                                                <div class="mt-6">
                                                    <x-input-label for="comment" value="{{ __('Comentário') }}" />

                                                    <x-text-area id="comment" name="comment" type="comment"
                                                        class="mt-1 auto w-5/6" />

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
                                @else
                                    <x-t-data>{{ 'Feedback enviado!' }}</x-t-data>
                                @endif
                            @endif
                            @if (Auth::user()->roles[0]->name == 'super-admin')
                                <x-t-data>
                                    <a href="{{ route('classes.attach-teacher', $user->id) }}"
                                        class="text-gray-500 hover:underline">Anexar/Editar turma ou disciplina</a>
                                </x-t-data>
                            @endif
                            @if (Auth::user()->roles[0]->name == 'teacher' || Auth::user()->roles[0]->name == 'super-admin')
                                <x-t-data>
                                    <a href="professores/{{ $user->id }}/feedbacks"
                                        class="text-gray-500 text-sm hover:underline">
                                        Ver Feedbacks
                                    </a>
                                </x-t-data>
                            @endif
                        </x-t-row>
                    @endforeach
                @endif
                @if (request('type') == 'Alunos')
                    @foreach ($allStudents as $user)
                        <x-t-row>
                            <x-t-data>{{ $user->name }}</x-t-data>
                            <x-t-data>{{ $user->email }}</x-t-data>
                            @if ($user->classeAsParticipant->count() > 0)
                                <x-t-data>{{ $user->classeAsParticipant->first()->name }}</x-t-data>
                            @else
                                <x-t-data>{{ __('N/A') }}</x-t-data>
                            @endif
                            @if (Auth::user()->roles[0]->name == 'super-admin')
                                <x-t-data>
                                    <a href="{{ route('classes.student', $user->id) }}"
                                        class="text-gray-500 hover:underline">Anexar a uma turma</a>
                                </x-t-data>
                            @endif
                        </x-t-row>
                    @endforeach
                   {{-- <div x-intersect.full="$wire.{{ (new App\Http\Controllers\UserController)->showAll()}}">{{$amount}}
                   </div> --}}
                @endif
                
                @if (request('type') == 'Turmas' || $isEmpty)
                    @foreach ($allClasses as $class)
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
