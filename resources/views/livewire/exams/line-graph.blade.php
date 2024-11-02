<div>
    <div class="text-center">
        <p class="font-bold text-3xl">{{ $subject->first_name . " " . $subject->last_name}} のビタミンD値の推移</p>
    </div>

    @if (count($exams))
    <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between items-start w-full">
            <div class="flex-col items-center">
                
            </div>
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

        <!-- Line Chart -->
        <div id="line-chart"></div>
    </div>

    @else
    <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <p class="font-bold">検査データがありません。</p>
    </div>
    @endif
</div>

@script
<script>
    const examData = @json($exams);
    const resultArr = examData.map(exam => exam.result);
    const dateArr = examData.map(exam => exam.date);
    
    const options = {
        chart: {
            height: "400%",
            maxWidth: "100%",
            type: "line",
            fontFamily: "Inter, sans-serif",
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        tooltip: {
            enabled: true,
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 6,
        },
        grid: {
            show: true,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: -26
            },
        },
        series: [
            {
                name: "検査数値",
                data: resultArr,
                color: "#fbbf24",
            },
        ],
        markers: {
            size: 8,
            colors: "#fbbf24",
            // strokeColors: ["#3056D3", "#80CAEE"],
            // strokeWidth: 3,
            // strokeOpacity: 0.9,
            // strokeDashArray: 0,
            fillOpacity: 1,
            discrete: [],
            hover: {
                size: 10,
                sizeOffset: 5,
            },
        },
        legend: {
            show: true
        },
        stroke: {
            curve: 'straight'
        },
        xaxis: {
            categories: dateArr,
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                }
            },
            axisBorder: {
                show: true,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                }
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
    }

    if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("line-chart"), options);
        chart.render();
    }
</script>
@endscript