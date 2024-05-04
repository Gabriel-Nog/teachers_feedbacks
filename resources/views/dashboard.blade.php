<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-tables-navbar class="mx-8"></x-tables-navbar>
        <x-dashboard-table :data="[
            'teachers' => $teachers,
            'students' => $students,
            'subjects' => $subjects,
            'classes' => $classes,
        ]"></x-dashboard-table>
    </div>
</x-app-layout>
