<x-guest-layout>
    <form method="POST" action="{{ route('subjects.subjectsRegister.store') }}" class="flex flex-col gap-3">
        @csrf

        <!-- Name -->
        <x-input-label for="name" :value="__('Disciplina para adicionar:')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
            autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-primary-button class="mt-2 w-fit">
            {{ __('Registrar') }}
        </x-primary-button>

        </div>
    </form>
</x-guest-layout>
