<?php

use App\Models\Subject;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('メニュー一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-row gap-4">
                <div class="lg:w-1/3 md:w-1/2 sm:w-full">
                    {{-- Number of subjects --}}
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="max-w-sm p-6 bg-white">
                                {{-- <svg class="w-10 h-10 text-gray-500 dark:text-gray-400 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                                </svg> --}}
                                <h4
                                    class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ App\Models\User::find(Auth::id())->name }}</h4>
                                @if (Auth::user()->role == 'user')
                                <h5
                                    class="mb-2 text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    被検者数 : {{ Subject::where('user_id', Auth::id())->count() }}名</h5>
                                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">{{ Subject::where('user_id', Auth::id())->count() }}名の被検者が登録されています。</p>
                                
                                <div class="pt-6 text-gray-900 dark:text-gray-100">
                                    <a href="{{ route('subjects.index') }}" class="bg-amber-400 w-full inline-flex items-center justify-center text-center px-4 py-2 border border-transparent rounded-md font-semibold">
                                        被検者・検査データの入力・変更・閲覧
                                    </a>
                                </div>
                                @endif

                                @if (Auth::user()->role == 'admin')
                                <div class="pt-6 text-gray-900 dark:text-gray-100">
                                    <a href="{{ route('users.index') }}" class="bg-amber-400 w-full inline-flex items-center justify-center text-center px-4 py-2 border border-transparent rounded-md font-semibold">
                                        機関一覧
                                    </a>
                                </div>
                                @endif
                                
                                <div class="pt-6 text-gray-900 dark:text-gray-100">
                                    <a href="{{ route('profile') }}" class="bg-amber-400 w-full inline-flex items-center justify-center text-center px-4 py-2 border border-transparent rounded-md font-semibold">
                                        アカウント情報・パスワードの変更
                                    </a>
                                </div>
                                
                                <div class="pt-6 text-gray-900 dark:text-gray-100 flex justify-end">
                                    <a class="underline text-gray-600 dark:text-gray-400 font-bold" href="{{ asset('spark.pdf') }}" target="_blank">
                                        {{ __('規約') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                        </div>
                    </div> --}}
                </div>

                <div class="lg:w-1/3 md:w-1/2 sm:w-full">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4 flex flex-col">
                    </div>

                    {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                        </div>
                    </div> --}}
                </div>
            </div>

            {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                </div>
            </div> --}}
        </div>
    </div>
</x-app-layout>