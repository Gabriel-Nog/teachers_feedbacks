<x-guest-layout>
    <form class="bg-gray-700 w-2xl rounded-sm mx-auto my-16 text-white flex flex-col gap-3">
        <label for="csv" class="">Adicionar arquivo csv:</label>
        <input type="file" name="csv" id="csv">
        <x-primary-button class="w-fit">{{ __('Adicionar') }}</x-primary-button>
    </form>
</x-guest-layout>
