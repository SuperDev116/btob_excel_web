<!-- resources/views/pdf/line-graph.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'B2B-Excel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    x-data="{ page: 'tables', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
            darkMode = JSON.parse(localStorage.getItem('darkMode'));
            $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}" class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex flex-row gap-4">
                        <div class="w-full">
                            <div class="p-16 bg-white dark:bg-gray-800 overflow-hidden rounded-lg">
                                <div id="report-header" class="text-gray-800">
                                    <div class="justify-center items-center text-center mb-8">
                                        <p class="font-bold text-3xl">あなたの検査結果</p>
                                    </div>
                                    <div class="flex flex-row justify-between text-gray-800 font-bold">
                                        <div class="w-1/3 border border-black p-4">
                                            <p>出力日：{{ date('Y年m月d日'); }}</p>
                                            <p>機関名：{{ $user->name }}</p>
                                            <p>検査日：{{ date('Y年m月d日', strtotime($exam->date)) }}</p>
                                            <p>お名：{{ $subject->first_name }} {{ $subject->last_name }}</p>
                                        </div>
                                        <div class="w-1/3" id="print-btn-group">
                                            <div class="flex flex-row justify-between">
                                                <button id="back-btn"
                                                    type="button"
                                                    onclick="window.history.back();"
                                                    class="bg-sky-400 hover:bg-gray-400 p-2 rounded inline-flex items-center"
                                                >
                                                    <svg class="w-6 h-6 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                                                    </svg>
                                                    <span>前の画面に戻る</span>
                                                </button>
                                                <button id="download-btn"
                                                    type="button"
                                                    class="bg-amber-400 hover:bg-gray-400 p-2 rounded inline-flex items-center"
                                                >
                                                    <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span>印刷プレビュー</span>
                                                </button>
                                            </div>
                                            <div class="mt-4 border border-amber-400 w-full p-2">
                                                <p>★プレビュー画面でレイアウトと倍率を<br/>　調節してから印刷してください。</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="report-content" class="px-16">
                                    <p class="font-bold text-lg my-8">総25-ヒドロキシビタミンD（25-OH ビタミンD）</p>
                                    <div class="flex flex-row justify-center my-8 relative gap-16">
                                        <div class="w-2/3">
                                            <div class="relative w-96 h-48">
                                                <div id="gauge-container" class="flex justify-center items-center" style="position: relative;">
                                                    <canvas id="gauge" width="384" height="192"></canvas>
                                                    <input type="hidden" id="gaugeValue" min="0" max="" value="{{ $exam->result }}" step="1">
                            
                                                    <div class="text-center pt-20" style="position: absolute;">
                                                        <p class="font-bold text-5xl">{{ $exam->result }}</p>
                                                        <p class="font-bold text-xl mb-4">(ng/ml)</p>
                                                        @if ($exam->result < 10)
                                                            <p class="font-bold text-xl">欠乏</p>
                                                        @elseif ($exam->result > 9 && $exam->result < 30)
                                                            <p class="font-bold text-xl">不足</p>
                                                        @elseif ($exam->result > 29 && $exam->result < 100)
                                                            <p class="font-bold text-xl">充足</p>
                                                        @elseif ($exam->result > 99 && $exam->result < 150)
                                                            <p class="font-bold text-xl">過剰</p>
                                                        @else
                                                            <p class="font-bold text-xl">毒性</p>
                                                        @endif
                                                    </div>
                                                </div>
                            
                                                <div class="absolute top-48 -left-2 transform -translate-x-1/2 translate-y-[-50%] text-center font-bold">0</div>
                                                <div class="absolute top-1/4 left-10 transform -translate-x-1/2 translate-y-[-50%] text-center font-bold">40</div>
                                                <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 translate-y-[-50%] text-center font-bold">80</div>
                                                <div class="absolute top-1/4 right-10 transform translate-x-1/2 translate-y-[-50%] text-center font-bold">120</div>
                                                <div class="absolute top-48 -right-4 transform translate-x-1/2 translate-y-[-50%] text-center font-bold">160</div>
                                            </div>
                                        </div>

                                        <div class="w-1/3 flex flex-col border border-black p-4 font-bold">
                                            <div class="flex justify-between items-center w-full mb-2">
                                                <span>0~10</span><span style="color: rgb(0, 176, 240);">欠乏</span>
                                            </div>
                                            <div class="flex justify-between items-center w-full mb-2">
                                                <span>10~30</span><span style="color: rgb(146, 208, 80);">不足</span>
                                            </div>
                                            <div class="flex justify-between items-center w-full mb-2">
                                                <span>30~100</span><span style="color: rgb(255, 192, 0);">充足</span>
                                            </div>
                                            <div class="flex justify-between items-center w-full mb-2">
                                                <span>100~150</span><span style="color: rgb(255, 0, 0);">過剰</span>
                                            </div>
                                            <div class="flex justify-between items-center w-full">
                                                <span>150~</span><span style="color: rgb(112, 48, 160);">毒性</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="report-footer">
                                    <div class="w-full flex flex-row p-8 gap-4">
                                        <div class="w-3/5 border-black border-2">
                                            <div class="p-2 bg-amber-400 text-center">
                                                ビタミンDはなぜ重要？
                                            </div>
                                            <div class="p-2">
                                                <ul class="list-none">
                                                    <li class="flex items-center mb-2">
                                                        <span class="mr-2">✓</span>骨と歯を健康にします。
                                                    </li>
                                                    <li class="flex items-center mb-2">
                                                        <span class="mr-2">✓</span>インフルエンザ、うつ病、心臓発作、ガンのリスクを軽減します。
                                                    </li>
                                                    <li class="flex items-center">
                                                        <span class="mr-2">✓</span>免疫システム全体を改善し、乳児の成長を助けます。
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="w-2/5 border-black border-2">
                                            <div class="p-2 bg-amber-400 text-center">
                                                ビタミンDが助けとなる体の不調
                                            </div>
                                            <div class="p-2">
                                                疲労感、うつ病、脱力感、関節痛、筋肉痛、皮膚のトラブル、血糖値の上昇、アレルギー、腹痛、排便習慣の変化、膨満感、血圧の上昇 など
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full flex flex-row gap-4">
                                        <div class="p-4 border-amber-400 border-2">
                                            <div class="mb-2">
                                                <p class="font-bold">紫外線とビタミン D</p>
                                                私たちの体にとって、紫外線とビタミンDは切っても切れない関係にあります。ビタミンDの主な働きは、腸からのカルシウムの吸収を2－5倍程度に増加させることです。ビタミンDが不足すると、食事でカルシウムを摂っていても十分吸収されず、カルシウム不足におちいります。血液中のカルシウム濃度が低下すると、けいれんなどの大きな症状が起こるため、骨からカルシウムを溶かしだして供給するようになります。その結果、骨の強度が低下して曲がりやすくなり、くる病（主に成長期の子ども）や骨軟化症（成人）といった病気を起こすようになります。
                                            </div>
                                            <div class="mb-2">
                                                <p class="font-bold">ビタミンDの確保 D</p>
                                                ビタミンDは食物としては、きのこ類や脂身の魚類に多く含まれていますが、その他の食品には少ししか含まれておらず、必要量を食事だけから摂るのは困難です。そのため、多くの人は必要ビタミンD（一日400－1000単位、10－25μg）の半分以上を日光紫外線に依存しているのが現状です。
                                            </div>
                                            <div class="mb-2">
                                                <p class="font-bold">ビタミンD不足による影響 D</p>
                                                日本では近年、特に乳幼児のビタミンD欠乏症が増加しており、高度のO脚や、けいれんで外来に受診する乳幼児が急増しています。日焼けを避ける若年女性が増えたことがあり、妊婦さんがビタミンD欠乏状態にあり、元々骨量の少ない赤ちゃんが多いうえに、完全母乳栄養やアトピー性皮膚炎に対する除去食、生後の日光浴不足が重なることがリスク要因と考えられています。　食物からの摂取や日光浴等が難しい妊婦さんや日常的に紫外線予防を行う妊婦さんは、生活スタイルによらず、信頼できる供給元からの、ビタミンDのサプリメントを利用することも一つの方法として勧められています。
                                            </div>
                                            <div class="text-right">
                                                <p>環境省発行「紫外線環境保健マニュアル2020」より抜粋 D</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

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
    
        document.getElementById('download-btn').addEventListener('click', function (e) {
            document.getElementById('print-btn-group').style.visibility = 'hidden';
            window.print();
            document.getElementById('print-btn-group').style.visibility = 'visible';
        });
    </script>
</body>

</html>