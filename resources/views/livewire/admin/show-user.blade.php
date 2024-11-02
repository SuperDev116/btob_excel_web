<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="border-b border-stroke px-6 py-4 dark:border-strokedark">
        <h3 class="font-medium text-black dark:text-white">
            {{ $user->name }}
        </h3>
    </div>
    <form wire:submit="update">
        <div class="p-6">
            <div class="mb-4 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        機関名 <span class="text-meta-1">*</span>
                    </label>
                    <input
                        type="text"
                        wire:model="name"
                        placeholder="機関名を入力"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    />
                    @error("name") <em>{{ $message }}</em>@enderror
                </div>

                <div class="w-full xl:w-1/2">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        電話番号 <span class="text-meta-1">*</span>
                    </label>
                    <input
                        type="text"
                        wire:model="phone"
                        placeholder="電話番号を入力"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    />
                    @error("phone") <em>{{ $message }}</em>@enderror
                </div>

                <div class="w-full xl:w-1/2">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        メールアドレス(ログイン時のID) <span class="text-meta-1">*</span>
                    </label>
                    <input
                        type="email"
                        wire:model="email"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    />
                    @error("email") <em>{{ $message }}</em>@enderror
                </div>
            </div>

            <button
                class="flex w-full justify-center rounded bg-blue-500 p-3 font-medium text-white hover:bg-opacity-90"
                type="submit"
            >
                保存
            </button>
        </div>
    </form>
</div>