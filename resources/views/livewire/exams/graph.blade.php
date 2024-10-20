<div>
    @if (isset($last_exam))
    <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-6 md:p-6 relative" id="result">
        <p class="font-bold">{{ $last_exam->date }} あなたの検査結果（{{ $last_exam->result }} ng/ml）</p>

        <div class="flex items-center justify-center p-8 relative">
            <div class="relative w-96 h-48">

                <div
                    id="gauge-container"
                    class="flex justify-center items-center"
                    style="position: relative;"
                >
                    <canvas id="gauge" width="384" height="192"></canvas>
                    <input type="hidden" id="gaugeValue" min="0" max="100" value="{{ $last_exam->result }}" step="1">

                    <div 
                        class="text-center pt-20" 
                        style="position: absolute;"
                    >
                        <p class="font-bold text-5xl">{{ $last_exam->result }}</p>
                        <p class="font-bold text-xl mb-4">(ng/ml)</p>
                        @if ($last_exam->result < 15)
                        <p class="font-bold text-xl">欠乏</p>
                        @elseif ($last_exam->result > 14 && $last_exam->result < 23)
                        <p class="font-bold text-xl">不足</p>
                        @elseif ($last_exam->result > 22 && $last_exam->result < 75)
                        <p class="font-bold text-xl">至適</p>
                        @else
                        <p class="font-bold text-xl">過剰</p>
                        @endif
                    </div>
                </div>

                <div
                    class="absolute top-48 -left-2 transform -translate-x-1/2 translate-y-[-50%] text-center font-bold">
                    0</div>
                <div
                    class="absolute top-1/4 left-10 transform -translate-x-1/2 translate-y-[-50%] text-center font-bold">
                    25</div>
                <div
                    class="absolute -top-3 left-1/2 transform -translate-x-1/2 translate-y-[-50%] text-center font-bold">
                    50</div>
                <div
                    class="absolute top-1/4 right-10 transform translate-x-1/2 translate-y-[-50%] text-center font-bold">
                    75</div>
                <div
                    class="absolute top-48 -right-4 transform translate-x-1/2 translate-y-[-50%] text-center font-bold">
                    100</div>
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
        const endAngle = (value / 100) * Math.PI + startAngle;
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
        if (value < 15) {
            return '#ff9900'; // 欠乏 - Orange
        } else if (value < 23) {
            return '#ffff00'; // 不足 - Yellow
        } else if (value < 75) {
            return '#00ff00'; // 至適 - Green
        } else {
            return '#ff0000'; // 過剰 - Red
        }
    }

    // Initial draw with default value
    updateGauge();
</script>
@endscript