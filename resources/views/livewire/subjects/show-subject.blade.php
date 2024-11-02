<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="border-b border-stroke px-6 py-4 dark:border-strokedark">
        <h3 class="font-medium text-black dark:text-white">
            {{ $first_name . ' ' . $last_name }}
        </h3>
    </div>
    <form wire:submit="update">
        <div class="p-6">
            <div class="mb-4 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        姓（ローマ字） <span class="text-meta-1">*</span>
                    </label>
                    <input
                        type="text"
                        wire:model="last_name"
                        placeholder="姓を入力"
                        oninput="this.value = this.value.toUpperCase()"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    />
                    @error("last_name") <em>{{ $message }}</em>@enderror
                </div>

                <div class="w-full xl:w-1/2">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        名（ローマ字） <span class="text-meta-1">*</span>
                    </label>
                    <input
                        type="text"
                        wire:model="first_name"
                        placeholder="名を入力"
                        oninput="this.value = this.value.toUpperCase()"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    />
                    @error("first_name") <em>{{ $message }}</em>@enderror
                </div>
            </div>
                
            <div class="mb-4 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        生年月日 <span class="text-meta-1">*</span>
                    </label>
                    <input
                        type="date"
                        wire:model="dob"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    />
                    @error("dob") <em>{{ $message }}</em>@enderror
                </div>

                <div class="w-full xl:w-1/2">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        性別 <span class="text-meta-1">*</span>
                    </label>
                    <div
                        x-data="{ isOptionSelected: false }"
                        class="relative z-20 bg-transparent dark:bg-form-input"
                    >
                        <select
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            :class="isOptionSelected && 'text-black dark:text-white'"
                            name="gender"
                            wire:model="gender"
                            @change="isOptionSelected = true"
                        >
                            <option value="" class="text-body"></option>
                            <option value="male" class="text-body" @if ($gender == 'male') selected @endif>男</option>
                            <option value="female" class="text-body" @if ($gender == 'female') selected @endif>女</option>
                        </select>
                        @error("gender") <em>{{ $message }}</em>@enderror
                    </div>
                </div>
            </div>

            <button
                class="flex w-full justify-center rounded bg-blue-500 p-3 mb-4 font-medium text-white hover:bg-opacity-90"
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
    </form>
</div>