<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TDEE 計算器</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#e6f5ea',
                            100: '#c3e7cc',
                            500: '#4ade80',
                            600: '#22c55e',
                            700: '#16a34a',
                        },
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer components {
            .form-input {
                @apply w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500;
            }
            .form-label {
                @apply block text-sm font-medium text-gray-700 mb-1;
            }
            .btn-primary {
                @apply bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded-lg transition-colors shadow-md;
            }
            .card {
                @apply bg-white p-6 rounded-xl shadow-lg border border-gray-100;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <!-- 頁首 Header -->
        <header class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <i class="fas fa-dumbbell text-5xl text-primary-600"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">TDEE 計算器</h1>
            <p class="text-gray-600">計算您的每日總能量消耗和建議攝取熱量</p>
        </header>

        <!-- 計算表單區 Form -->
        <div class="card mb-8">
            <form id="tdeeForm" class="space-y-6">
                <!-- 性別選擇 -->
                <div>
                    <label class="form-label">性別</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" value="male" class="form-input" checked>
                            <span class="ml-2"><i class="fas fa-mars text-blue-500 mr-1"></i> 男</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" value="female" class="form-input">
                            <span class="ml-2"><i class="fas fa-venus text-pink-500 mr-1"></i> 女</span>
                        </label>
                    </div>
                </div>

                <!-- 數值輸入區域 -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- 年齡 -->
                    <div>
                        <label for="age" class="form-label">年齡 (歲)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fas fa-birthday-cake"></i>
                            </span>
                            <input type="number" id="age" name="age" min="10" max="120" class="form-input pl-10" placeholder="20-80" required>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">10-120 歲</p>
                    </div>

                    <!-- 身高 -->
                    <div>
                        <label for="height" class="form-label">身高 (cm)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fas fa-ruler-vertical"></i>
                            </span>
                            <input type="number" id="height" name="height" min="100" max="250" class="form-input pl-10" placeholder="160-180" required>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">100-250 公分</p>
                    </div>

                    <!-- 體重 -->
                    <div>
                        <label for="weight" class="form-label">體重 (kg)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fas fa-weight"></i>
                            </span>
                            <input type="number" id="weight" name="weight" min="20" max="250" class="form-input pl-10" placeholder="50-100" required>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">20-250 公斤</p>
                    </div>
                </div>

                <!-- 活動量 -->
                <div>
                    <label for="activity" class="form-label">活動量</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-running"></i>
                        </span>
                        <select id="activity" name="activity" class="form-input pl-10" required>
                            <option value="1.2">久坐不動 (1.2)</option>
                            <option value="1.375">輕度活動 (1.375)</option>
                            <option value="1.55" selected>中度活動 (1.55)</option>
                            <option value="1.725">高度活動 (1.725)</option>
                            <option value="1.9">非常活躍 (1.9)</option>
                        </select>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">選擇最接近您日常生活的活動水平</p>
                </div>

                <!-- 目標 -->
                <div>
                    <label class="form-label">目標</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <label class="relative flex p-3 bg-white rounded-lg border border-gray-200 cursor-pointer hover:border-primary-500 focus-within:ring-2 focus-within:ring-primary-500">
                            <input type="radio" name="goal" value="0.8" class="sr-only" aria-labelledby="goal-option-1">
                            <span class="flex items-center">
                                <i class="fas fa-fire-alt text-orange-500 mr-2"></i>
                                <span id="goal-option-1" class="text-sm font-medium text-gray-900">減脂</span>
                            </span>
                        </label>
                        <label class="relative flex p-3 bg-white rounded-lg border border-gray-200 cursor-pointer hover:border-primary-500 focus-within:ring-2 focus-within:ring-primary-500">
                            <input type="radio" name="goal" value="1" class="sr-only" aria-labelledby="goal-option-2" checked>
                            <span class="flex items-center">
                                <i class="fas fa-balance-scale text-blue-500 mr-2"></i>
                                <span id="goal-option-2" class="text-sm font-medium text-gray-900">維持</span>
                            </span>
                        </label>
                        <label class="relative flex p-3 bg-white rounded-lg border border-gray-200 cursor-pointer hover:border-primary-500 focus-within:ring-2 focus-within:ring-primary-500">
                            <input type="radio" name="goal" value="1.1" class="sr-only" aria-labelledby="goal-option-3">
                            <span class="flex items-center">
                                <i class="fas fa-dumbbell text-green-500 mr-2"></i>
                                <span id="goal-option-3" class="text-sm font-medium text-gray-900">增肌</span>
                            </span>
                        </label>
                    </div>
                </div>

                <!-- 計算按鈕 -->
                <div class="text-center">
                    <button type="submit" class="btn-primary w-full md:w-auto">
                        <i class="fas fa-calculator mr-2"></i>計算 TDEE
                    </button>
                </div>
            </form>
        </div>

        <!-- 結果顯示區 Result -->
        <div id="resultSection" class="hidden opacity-0 transition-all duration-500 ease-in-out">
            <div class="card bg-gradient-to-br from-primary-50 to-white">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-pie text-primary-600 mr-2"></i>計算結果
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <!-- BMR 卡片 -->
                    <div class="card bg-white hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center p-2 bg-blue-100 rounded-full mb-2">
                                <i class="fas fa-fire text-blue-600 text-xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-800">基礎代謝率</h3>
                            <p class="text-gray-500 text-xs mb-2">BMR</p>
                            <div class="text-2xl font-bold text-blue-600" id="bmrResult">0</div>
                            <p class="text-gray-500 text-xs">卡路里/天</p>
                        </div>
                    </div>
                    
                    <!-- TDEE 卡片 -->
                    <div class="card bg-white hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center p-2 bg-green-100 rounded-full mb-2">
                                <i class="fas fa-running text-green-600 text-xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-800">每日總消耗熱量</h3>
                            <p class="text-gray-500 text-xs mb-2">TDEE</p>
                            <div class="text-2xl font-bold text-green-600" id="tdeeResult">0</div>
                            <p class="text-gray-500 text-xs">卡路里/天</p>
                        </div>
                    </div>
                    
                    <!-- 建議攝取熱量卡片 -->
                    <div class="card bg-white hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center p-2 bg-orange-100 rounded-full mb-2">
                                <i class="fas fa-utensils text-orange-600 text-xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-800">建議攝取熱量</h3>
                            <p class="text-gray-500 text-xs mb-2">根據您的目標</p>
                            <div class="text-2xl font-bold text-orange-600" id="calorieResult">0</div>
                            <p class="text-gray-500 text-xs">卡路里/天</p>
                        </div>
                    </div>
                </div>
                
                <!-- CTA 區域 -->
                <div class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <button id="recalcButton" class="btn-primary flex items-center justify-center">
                        <i class="fas fa-redo mr-2"></i>重新計算
                    </button>
                    <button id="shareButton" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition-colors shadow-md flex items-center justify-center">
                        <i class="fas fa-share-alt mr-2"></i>分享結果
                    </button>
                </div>
            </div>
        </div>

        <!-- 頁尾 Footer -->
        <footer class="mt-12 text-center text-gray-500 text-sm">
            <p>© 2023 TDEE 計算器 | 使用 <a href="https://tailwindcss.com" class="text-primary-600 hover:underline">Tailwind CSS</a></p>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('tdeeForm');
            const resultSection = document.getElementById('resultSection');
            const recalcButton = document.getElementById('recalcButton');
            const shareButton = document.getElementById('shareButton');
            const bmrResult = document.getElementById('bmrResult');
            const tdeeResult = document.getElementById('tdeeResult');
            const calorieResult = document.getElementById('calorieResult');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                calculateTDEE();
            });

            recalcButton.addEventListener('click', function() {
                resultSection.classList.add('hidden', 'opacity-0');
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            shareButton.addEventListener('click', function() {
                // 簡單的分享功能 - 複製結果到剪貼簿
                const results = `我的TDEE計算結果：
BMR: ${bmrResult.textContent} 卡路里/天
TDEE: ${tdeeResult.textContent} 卡路里/天
建議攝取熱量: ${calorieResult.textContent} 卡路里/天`;
                
                navigator.clipboard.writeText(results).then(function() {
                    alert('結果已複製到剪貼簿！');
                }, function() {
                    alert('無法複製結果');
                });
            });

            function calculateTDEE() {
                // 獲取表單數據
                const gender = document.querySelector('input[name="gender"]:checked').value;
                const age = parseInt(document.getElementById('age').value);
                const height = parseInt(document.getElementById('height').value);
                const weight = parseInt(document.getElementById('weight').value);
                const activityLevel = parseFloat(document.getElementById('activity').value);
                const goal = parseFloat(document.querySelector('input[name="goal"]:checked').value);

                // 驗證輸入
                if (!age || !height || !weight) {
                    alert('請填寫所有必填欄位');
                    return;
                }

                if (age < 10 || age > 120) {
                    alert('年齡必須在 10-120 歲之間');
                    return;
                }

                if (height < 100 || height > 250) {
                    alert('身高必須在 100-250 公分之間');
                    return;
                }

                if (weight < 20 || weight > 250) {
                    alert('體重必須在 20-250 公斤之間');
                    return;
                }

                // 計算 BMR
                let bmr;
                if (gender === 'male') {
                    bmr = 10 * weight + 6.25 * height - 5 * age + 5;
                } else {
                    bmr = 10 * weight + 6.25 * height - 5 * age - 161;
                }

                // 計算 TDEE
                const tdee = bmr * activityLevel;

                // 計算建議攝取熱量
                const calories = tdee * goal;

                // 顯示結果
                bmrResult.textContent = Math.round(bmr);
                tdeeResult.textContent = Math.round(tdee);
                calorieResult.textContent = Math.round(calories);

                // 顯示結果區段
                resultSection.classList.remove('hidden');
                setTimeout(() => {
                    resultSection.classList.remove('opacity-0');
                }, 10);

                // 滾動到結果區域
                resultSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    </script>
</body>
</html>
