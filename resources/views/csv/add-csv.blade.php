<x-guest-layout>
    <form class="w-full flex flex-col h-fit gap-4 text-white" method="POST" enctype="multipart/form-data"
        action="{{ route('store.csv-file') }}">
        @csrf
        <h2 class="text-2xl w-full font-bold text-center mb-2">Formulário para arquivo CSV</h2>
        <div class="col-start-1 col-end-3">
            <x-input-label for="csvInput" :value="__('Adicione seu arquivo csv')" />
            <x-text-input type="file" id="csvInput" class="block mt-1" name="csvInput" :value="old('csvInput')" required
                autofocus autocomplete="csvInput" />
            <x-input-error :messages="$errors->get('csvInput')" class="mt-2" />
        </div>
        <div class="col-start-1 col-end-3">
            <x-input-label for="csvInput" :value="__('Tipo de arquivo csv de criação')" />
            <select name="type" id="type"
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="user">Usuário</option>
                <option value="class">Turma</option>
                <option value="subject">Disciplina</option>
            </select>
        </div>

        <div class="col-start-3 col-end-1 flex justify-between items-end">
            <a href="{{ url('./storage/example-files.zip') }}" download
                class="text-white hover:underline hover:text-gray-600 duration-200">Baixar
                arquivos de exemplo</a>
            <x-primary-button class="w-fit block mt-2">{{ __('Adicionar') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
