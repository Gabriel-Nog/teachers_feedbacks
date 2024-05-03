<x-guest-layout>
    <form method="POST" action="{{ route('classes.classesRegister.store') }}" class="grid grid-cols-2 gap-4">
        @csrf

        <!-- Name -->
        <div class="col-auto">
            <x-input-label for="name" :value="__('Turma para adicionar:')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-label for="shift" :value="__('Turno da turma:')" />
            <x-text-input id="shift" class="block mt-1 w-full" type="text" name="shift" :value="old('shift')" required
                autofocus autocomplete="shift" />
            <x-input-label for="year" :value="__('Ano:')" />
            <x-text-input id="year" class="block mt-1 w-full" type="text" name="year" :value="old('year')" required
                autofocus autocomplete="year" />
            <x-input-label for="subject" :value="__('Disciplina para adicionar:')" />
            <select {{ $errors->has('subjects_id') ? 'is-invalid' : '' }}"
                name="subjects_id" id="subjects_id">
                <option value="">Selecione</option>
                @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
              </select>
                <x-primary-button class="ms-2 mt-5 col-auto">
                    {{ __('Registrar') }}
                </x-primary-button>
        </div>

        </div>
    </form>
</x-guest-layout>