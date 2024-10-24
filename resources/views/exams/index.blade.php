<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('検査データ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-row gap-4">
                <div class="lg:w-1/3 md:w-1/2 sm:w-full">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <livewire:exams.create-exam :subject="$subject">
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{-- <livewire:exams.graph :subject="$subject"> --}}
                            <livewire:exams.graph :subject="$subject" :selected_exam="$selected_exam">
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-2/3 md:w-1/2 sm:w-full">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <livewire:exams.show-exams :subject="$subject">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-row gap-4">
                <div class="w-full">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <livewire:exams.line-graph :subject="$subject">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>