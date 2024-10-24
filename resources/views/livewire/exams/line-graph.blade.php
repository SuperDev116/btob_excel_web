<div>
    <p class="font-bold">{{ $subject->first_name . " " . $subject->last_name}} のビタミンD値の推移</p>

    @if (count($exams))
    <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between items-start w-full">
            <div class="flex-col items-center">
                
            </div>
            <div class="flex justify-center items-center">
                <button
                    wire:click="print"
                    class="items-center justify-center text-blue-500 w-8 h-8 rounded-lg">
                    <svg
                        class="w-6 h-6 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                        <path
                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>
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