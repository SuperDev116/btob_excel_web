<div id="create-form">
    <form wire:submit="store">
        <div class="flex flex-col">
            <div class="w-full justify-end">
                <button
                    class="w-full justify-center bg-blue-500 font-bold text-2xl p-2 text-white "
                    type="button" disabled
                >
                    検査結果を追加
                </button>
            </div>
        </div>
        <div class="mb-4">
            <p class="font-bold">
                検査日付と結果数値を入力してください。
            </p>
        </div>
        <div class="mb-4 flex flex-col">
            <div class="w-full">
                <label class="mb-1 block text-sm font-medium text-black dark:text-white">
                    検査日付 <span class="text-meta-1">*</span>
                </label>
                <input
                    type="date"
                    max="{{ date('Y-m-d') }}"
                    wire:model="date"
                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                />
                @error("date") <em>{{ $message }}</em>@enderror
            </div>
        </div>
        <div class="mb-4 flex flex-col">
            <div class="w-full">
                <label class="mb-1 block text-sm font-medium text-black dark:text-white">
                    結果数値 <span class="text-meta-1">*</span>
                </label>
                <input
                    type="number"
                    min="0"
                    max=""
                    wire:model="result"
                    placeholder="結果数値を入力"
                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                />
                @error("result") <em>{{ $message }}</em>@enderror
            </div>
        </div>
        <div class="flex flex-col">
            <div class="w-full">
                <button
                    class="w-full justify-center rounded bg-blue-500 p-3 font-medium text-white hover:bg-opacity-90 mb-4"
                    type="submit"
                >
                    保存
                </button>

                <button
                    type="button"
                    onclick="window.history.back();"
                    class="w-full bg-blue-500 hover:bg-gray-400 text-white hover:bg-opacity-90 p-3 justify-center rounded inline-flex items-center"
                >
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                    </svg>
                    <span>そのまま前の画面に戻る</span>
                </button>
            </div>
        </div>
    </form>
</div>
