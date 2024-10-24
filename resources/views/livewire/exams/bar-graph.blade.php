<div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-6 md:p-6">
    <p class="font-bold">{{ $selected_exam->date }} あなたの検査結果（{{ $selected_exam->result }} ng/ml）</p>
    <div class="py-8 justify-center" id="result">
        <input id="minmax-range" type="range" min="0" max="100" value="{{ $selected_exam->result }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">

        <div class="flex flex-row gap-2" id="range-result">
            <div class="w-1/6 text-center">
                <p class="font-bold">欠乏</p>
                <div class="w-full h-8 bg-orange-300 text-black text-center py-2 m-2">
                    @if ($selected_exam->result < 15)
                        <p class="font-bold">{{ $selected_exam->result }}</p>
                    @endif
                </div>
                <p>0-15</p>
            </div>
            <div class="w-1/12 text-center">
                <p class="font-bold">不足</p>
                <div class="w-full h-8 bg-yellow-300 text-black text-center py-2 m-2">
                    @if ($selected_exam->result > 14 && $selected_exam->result < 23)
                    <span class="font-bold">{{ $selected_exam->result }}</span>
                    @endif
                </div>
                <p>15-22</p>
            </div>
            <div class="w-1/2 text-center">
                <p class="font-bold">至適</p>
                <div class="w-full h-8 bg-green-300 text-black text-center py-2 m-2">
                    @if ($selected_exam->result > 22 && $selected_exam->result < 75)
                        <span class="font-bold">{{ $selected_exam->result }}</span>
                    @endif
                </div>
                <p>23-74</p>
            </div>
            <div class="w-1/4 text-center">
                <p class="font-bold">過剰</p>
                <div class="w-full h-8 bg-red-400 text-black text-center py-2 m-2">
                    @if ($selected_exam->result > 74)
                        <span class="font-bold">{{ $selected_exam->result }}</span>
                    @endif
                </div>
                <p>75-100</p>
            </div>
        </div>
        
        <div class="mt-8 flex justify-center" id="text-result">
            <div class="w-1/4 text-center">
                <div class="w-full h-8 bg-blue-500 text-white text-center py-2">
                    <p class="font-bold">25-Hydroxy D Total</p>
                </div>
                <div class="w-full h-8 border-solid border-2 border-blue-500 text-black text-center py-2">
                    <p class="font-bold">{{ $selected_exam->result }}</p>
                </div>
            </div>
        </div>
    </div>
</div>