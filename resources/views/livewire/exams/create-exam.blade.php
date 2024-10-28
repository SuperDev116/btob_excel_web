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
            <div class="w-full justify-end">
                <button
                    class="w-full justify-center rounded bg-blue-500 p-3 font-medium text-white hover:bg-opacity-90"
                    type="submit"
                >
                    保存
                </button>
            </div>
        </div>
    </form>
</div>
