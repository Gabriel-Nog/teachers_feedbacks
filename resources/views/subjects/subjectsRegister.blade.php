<x-guest-layout>
    <form method="POST" action="{{ route('subjects.subjectsRegister.store') }}" class="grid grid-cols-2 gap-4">
        @csrf

        <!-- Name -->
        <div class="col-auto col-end-1">
            <x-input-label for="name" :value="__('Disciplina para adicionar:')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <x-primary-button class="ms-2 mt-5 col-auto">
                    {{ __('Register') }}
                </x-primary-button>
        </div>

        </div>
    </form>
</x-guest-layout>
