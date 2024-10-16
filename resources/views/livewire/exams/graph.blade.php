<div>
    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between mb-3">
            <div>
                <button type="button" data-tooltip-target="data-tooltip" data-tooltip-placement="bottom"
                    class="hidden sm:inline-flex items-center justify-center text-gray-500 w-8 h-8 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm"><svg
                        class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 16 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                    </svg><span class="sr-only">Download data</span>
                </button>
                <div id="data-tooltip" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    CSVダウンロード
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>

        <!-- Donut Chart -->
        <div class="py-6" id="donut-chart"></div>
    </div>
</div>

@script
<script>
    const examData = <?php echo $exams; ?>;

    // Extracting results and dates using map
    const resultArr = examData.map(exam => exam.result);
    const dateArr = examData.map(exam => exam.date);
    
    const getChartOptions = () => {
        return {
            series: [15, 23, 75, 100],
            colors: ["#FDBA8C", "#1C64F2", "#16BDCA", "#E74694"],
            chart: {
                height: "100%",
                width: "100%",
                type: "donut",
            },
            stroke: {
            colors: ["transparent"],
                lineCap: "",
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontFamily: "Inter, sans-serif",
                                offsetY: 20,
                            },
                            total: {
                                showAlways: true,
                                show: true,
                                label: "ng/ml",
                                fontFamily: "Inter, sans-serif",
                                formatter: function (w) {
                                    const sum = resultArr.reduce((a, b) => {
                                        return Number(a) + Number(b)
                                    }, 0)
                                    return Math.floor(sum / resultArr.length);
                                },
                            },
                            value: {
                                show: true,
                                fontFamily: "Inter, sans-serif",
                                offsetY: -20,
                                formatter: function (value) {
                                    return value + "k"
                                },
                            },
                        },
                        size: "80%",
                    },
                },
            },
            grid: {
                padding: {
                    top: -2,
                },
            },
            labels: ["Deficient", "Insufficient", "Optimum", "Potential Toxicity"],
            dataLabels: {
                enabled: false,
            },
            legend: {
                position: "bottom",
                fontFamily: "Inter, sans-serif",
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        value + "k"
                    },
                },
            },
            xaxis: {
                labels: {
                    formatter: function (value) {
                        return value  + "k"
                    },
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
        }
    }

    if (document.getElementById("donut-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());
        chart.render();
    }
</script>
@endscript