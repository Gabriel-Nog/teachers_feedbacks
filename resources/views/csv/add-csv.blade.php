<x-guest-layout>
    <form class="grid grid-cols-2 gap-4">
        @csrf
        <div class="col-start-1 col-end-1">
            <x-input-label for="csvInput" :value="__('Adicione seu arquivo csv')" />
            <x-text-input id="csvInput" class="block mt-1" name="csvInput" :value="old('csvInput')" required
                autofocus autocomplete="csvInput" type="file"/>
            <x-input-error :messages="$errors->get('csvInput')" class="mt-2" />
        </div>
        <div class="col-start-3 col-end-1">
            <x-primary-button class="w-fit block mt-2">{{ __('Adicionar') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
