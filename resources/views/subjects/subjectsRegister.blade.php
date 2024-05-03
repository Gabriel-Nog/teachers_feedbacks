<x-guest-layout>
    <form method="POST" action="{{ route('subjectRegister/store') }}" class="grid grid-cols-2 gap-4">
        @csrf

        <!-- Name -->
        <div class="col-auto col-end-1">
            <x-input-label for="subject" :value="__('Disciplina para adicionar:')" />
            <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="old('subject')" required
                autofocus autocomplete="subject" />
            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                <x-primary-button class="ms-2 mt-5 col-auto">
                    {{ __('Register') }}
                </x-primary-button>
        </div>

        </div>
    </form>
</x-guest-layout>
