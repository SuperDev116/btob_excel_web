<div>
    <p class="font-bold">{{ $subject->first_name . " " . $subject->last_name}} の検査データ</p>
    @if (count($exams))
    <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
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
            height: 500,
            // height: "300%",
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
            x: {
                show: false,
            },
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
                color: "#7E3AF2",
            },
        ],
        legend: {
            show: false
        },
        stroke: {
            curve: 'smooth'
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
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            show: false,
        },
    }

    if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("line-chart"), options);
        chart.render();
    }
</script>
@endscript