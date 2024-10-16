<form wire:submit="store">
    <p class="font-bold mb-4">
        検査日付と結果数値を入力してください。
    </p>
    <div class="mb-4 flex flex-col">
        <div class="w-full">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                検査日付 <span class="text-meta-1">*</span>
            </label>
            <input
                type="date"
                wire:model="date"
                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
            />
            @error("date") <em>{{ $message }}</em>@enderror
        </div>
    </div>
    <div class="mb-4 flex flex-col">
        <div class="w-full">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                結果数値 <span class="text-meta-1">*</span>
            </label>
            <input
                type="number"
                min="0"
                max="100"
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
