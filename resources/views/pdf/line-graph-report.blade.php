<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'B2B-Excel') }}</title>
        
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        x-data="{ page: 'tables', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
        x-init="
            darkMode = JSON.parse(localStorage.getItem('darkMode'));
            $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
        :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}"
        class="font-sans antialiased"
    >
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                        <div class="flex flex-row gap-4">
                            <div class="w-full">
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                                    <div class="p-6 text-gray-900 dark:text-gray-100">
                                        <div class="w-full flex flex-row justify-between">
                                            <div class="w-1/3 border border-black p-4">
                                                <p>出力日：{{ date('Y年m月d日'); }}</p>
                                                <p>機関名：{{ $subject->user->name }}</p>
                                                <p>お名：{{ $subject->first_name }} {{ $subject->last_name }}</p>
                                            </div>
                                            <div class="pr-4">
                                                <button
                                                    id="back-btn"
                                                    onclick="window.history.back();"
                                                    class="mr-4 w-4 h-4 rounded-lg">
                                                    <svg class="w-6 h-6 me-2 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                                                    </svg>
                                                </button>

                                                <button
                                                    id="download-btn"
                                                    class=" w-4 h-4 rounded-lg">
                                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div>
                                            @if (count($exams))
                                            <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                                                <div class="flex justify-between items-center w-2/3 pb-4">
                                                    <div class="flex-col items-center text-center">
                                                        <p class="font-bold text-xl">(ng/ml)</p>
                                                    </div>
                                                    <div class="flex-col items-center text-center">
                                                        <p class="font-bold text-2xl">あなたのビタミンD値の推移</p>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
        
        <script>
            const examData = @json($exams);
            const resultArr = examData.map(exam => exam.result);
            const dateArr = examData.map(exam => exam.date);
            
            const options = {
                chart: {
                    height: "300%",
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

            document.getElementById('download-btn').addEventListener('click', function (e) {
                document.getElementById('download-btn').style.visibility = 'hidden';
                document.getElementById('back-btn').style.visibility = 'hidden';
                window.print();
                document.getElementById('download-btn').style.visibility = 'visible';
                document.getElementById('back-btn').style.visibility = 'visible';
            });
        </script>
    </body>
</html>