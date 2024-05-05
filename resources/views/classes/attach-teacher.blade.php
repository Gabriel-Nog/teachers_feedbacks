<x-guest-layout>
    <form method="POST" action="{{ route('classes.attach-teachers', $id) }}" class="grid grid-cols-2 gap-3">
        @csrf

        <div>
            <x-input-label for="subjects" :value="__('Anexar a disciplina:')" />
            <select {{ $errors->has('subjects_id') ? 'is-invalid' : '' }}
                class="max-w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1"
                name="subjects_id" id="subjects">
                <option disabled select>Selecione a disciplina</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <x-input-label for="class" :value="__('Anexar a turma:')" />
            <select {{ $errors->has('classes_id') ? 'is-invalid' : '' }}
                class="max-w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1"
                name="classes_id" id="class">
                <option disabled select>Selecione a turma</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-center col-span-2">
            <x-primary-button class="w-[30%] grid place-items-center mt-3">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
