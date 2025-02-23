<div>
    @if (isset($selected_exam))
    <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-6 relative" id="result">
        <div class="flex justify-between items-start w-full">
            <div class="flex-col items-center">
                <p class="font-bold">{{ $subject->first_name . " " . $subject->last_name}}</p>
                <p class="font-bold">{{ $selected_exam->date }} 検査結果</p>
            </div>
            <div class="flex justify-center items-center">
                <div class="flex justify-center items-center">
                    <button
                        type="button"
                        wire:click="print"
                        title="印刷用レポートを表示。右上の同じアイコンをもう一度クリックし、詳細設定から、レイアウト（横）と倍率を調整し、印刷してください。"
                        class="bg-amber-400 hover:bg-gray-400 text-gray-800 font-bold text-lg p-2 rounded inline-flex items-center"
                    >
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd"/>
                        </svg>
                        <span>印刷画面へ</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-center mt-4 p-8 relative">
            <div class="relative w-96 h-48">
                <div
                    id="gauge-container"
                    class="flex justify-center items-center"
                    style="position: relative;"
                >
                    <canvas id="gauge" width="384" height="192"></canvas>
                    <input type="hidden" id="gaugeValue" min="0" max="200" value="{{ $selected_exam->result }}" step="1">

                    <div 
                        class="text-center pt-20" 
                        style="position: absolute;"
                    >
                        <p class="font-bold text-5xl">{{ $selected_exam->result }}</p>
                        <p class="font-bold text-xl mb-4">(ng/ml)</p>
                        @if ($selected_exam->result < 10)
                        <p class="font-bold text-xl">欠乏</p>
                        @elseif ($selected_exam->result > 9 && $selected_exam->result < 30)
                        <p class="font-bold text-xl">不足</p>
                        @elseif ($selected_exam->result > 29 && $selected_exam->result < 100)
                        <p class="font-bold text-xl">充足</p>
                        @elseif ($selected_exam->result > 99 && $selected_exam->result < 150)
                        <p class="font-bold text-xl">過剰</p>
                        @else
                        <p class="font-bold text-xl">毒性</p>
                        @endif
                    </div>
                </div>

                <div
                    class="absolute top-48 -left-2 transform -translate-x-1/2 translate-y-[-50%] text-center font-bold">
                    0</div>
                <div
                    class="absolute top-1/4 left-10 transform -translate-x-1/2 translate-y-[-50%] text-center font-bold">
                    40</div>
                <div
                    class="absolute -top-3 left-1/2 transform -translate-x-1/2 translate-y-[-50%] text-center font-bold">
                    80</div>
                <div
                    class="absolute top-1/4 right-10 transform translate-x-1/2 translate-y-[-50%] text-center font-bold">
                    120</div>
                <div
                    class="absolute top-48 -right-4 transform translate-x-1/2 translate-y-[-50%] text-center font-bold">
                    160</div>
            </div>
        </div>
    </div>
    @else
    <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-6 md:p-6">
        <p class="font-bold">検査データがありません。</p>
    </div>
    @endif
</div>

@script
<script>
    const canvas = document.getElementById('gauge');
    const ctx = canvas.getContext('2d');
    const gaugeValueInput = document.getElementById('gaugeValue');

    function updateGauge() {
        const gaugeValue = gaugeValueInput.value;
        drawGauge(gaugeValue);
    }

    function drawGauge(value) {
        const centerX = canvas.width / 2;
        const centerY = canvas.height;
        const radius = canvas.width / 2 - 15;

        // Clear canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Draw gauge background
        ctx.beginPath();
        ctx.arc(centerX, centerY, radius, Math.PI, 2 * Math.PI);
        ctx.lineWidth = 15;
        ctx.strokeStyle = '#ddd';
        ctx.stroke();

        // Draw gauge value
        const startAngle = Math.PI;
        if (value > 160) value = 160;
        const endAngle = (value / 160) * Math.PI + startAngle;
        ctx.beginPath();
        ctx.arc(centerX, centerY, radius, startAngle, endAngle);
        ctx.lineWidth = 15;
        ctx.strokeStyle = getColor(value);
        ctx.stroke();

        // Draw pointer
        // const pointerLength = radius - 40;
        // const pointerX = centerX + pointerLength * Math.cos(endAngle);
        // const pointerY = centerY + pointerLength * Math.sin(endAngle);

        // ctx.beginPath();
        // ctx.moveTo(centerX, centerY);
        // ctx.lineTo(pointerX, pointerY);
        // ctx.lineWidth = 5;
        // ctx.strokeStyle = '#333';
        // ctx.stroke();
    }

    function getColor(value) {
        if (value < 10) {
            return 'rgb(0 176 240)'; // 欠乏
        } else if (value < 30) {
            return 'rgb(146 208 80)'; // 不足
        } else if (value < 100) {
            return 'rgb(255 192 0)'; // 充足
        } else if (value < 150) {
            return 'rgb(255 0 0)'; // 過剰
        } else {
            return 'rgb(112 48 160)'; // 毒性
        }
    }

    // Initial draw with default value
    updateGauge();
</script>
@endscript