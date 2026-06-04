
/*
    * ╔═══════════════════════════════════════════╗
    * ║  恭喜！你找到最後一個 FLAG 片段！         ║
    * ║  JavaScript FLAG 片段: J4v45cr1p7}        ║
    * ║                                           ║
    * ║  現在把三個片段組合起來：                  ║
    * ║  HTML 片段 + CSS 片段 + JS 片段           ║
    * ║  = 完整的 FLAG                            ║
    * ╚═══════════════════════════════════════════╝
    */


// 切換分頁功能
function showTab(tabName) {
    const tabs = document.querySelectorAll('.tab');
    const sections = document.querySelectorAll('.content-section');
    
    tabs.forEach(tab => tab.classList.remove('active'));
    sections.forEach(section => section.classList.remove('active'));
    
    event.target.classList.add('active');
    document.getElementById(tabName).classList.add('active');
}

// 驗證 FLAG
const correctFlag = "KIWIS{H7ML_C55_4nd_J4v45cr1p7}";
let foundParts = 0;
function checkFlag() {
    const input = document.getElementById('flagInput').value.trim();
    const result = document.getElementById('flagResult');
    
    if (input === correctFlag) {
        result.className = 'flag-result success';
        result.textContent = '🎉 恭喜！FLAG 正確！你已經掌握前端三劍客的基礎了！';
        updateProgress(100);
        
        // 煙火效果
        setTimeout(() => {
            alert('🏆 任務完成！\n\n你已經學會：\n✓ HTML 的結構\n✓ CSS 的美化\n✓ JavaScript 的互動\n\n繼續加油，成為前端大師！');
        }, 500);
    } else if (input.includes('KIWIS{') && input.includes('}')) {
        result.className = 'flag-result error';
        result.textContent = '❌ FLAG 格式正確，但內容不對！再檢查一次註解中的片段。';
        updateProgress(50);
    } else {
        result.className = 'flag-result error';
        result.textContent = '❌ FLAG 不正確！提示：格式應該是 KIWIS{...}';
        updateProgress(25);
    }
}

// 更新進度條
function updateProgress(percent) {
    const progressBar = document.getElementById('progressBar');
    progressBar.style.width = percent + '%';
    progressBar.textContent = percent + '%';
}

// CSS 範例
function applyStyle() {
    const demo = document.getElementById('cssDemo');
    demo.innerHTML = `
        <p style="
            color: rgb(102, 80, 64);
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            background: linear-gradient(135deg, rgb(245, 214, 82), rgb(207, 232, 103));
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transform: scale(1.05);
            transition: all 0.3s;
        ">
            🎨 CSS 讓文字變美了！
        </p>
    `;
}

// JavaScript 範例
function runJsDemo() {
    const demo = document.getElementById('jsDemo');
    const colors = ['rgb(245, 214, 82)', 'rgb(207, 232, 103)', 'rgb(251, 240, 187)'];
    let index = 0;
    
    const interval = setInterval(() => {
        demo.style.background = colors[index % colors.length];
        demo.innerHTML = `
            <p style="font-size: 20px; font-weight: bold; text-align: center;">
                ⚡ JavaScript 正在執行... ${index + 1}
            </p>
        `;
        index++;
        
        if (index >= 10) {
            clearInterval(interval);
            demo.innerHTML = `
                <p style="font-size: 20px; font-weight: bold; text-align: center; color: rgb(102, 80, 64);">
                    ✨ JavaScript 執行完畢！這就是程式的魔力！
                </p>
            `;
        }
    }, 300);
}

// 實際計數器功能
let liveCountValue = 0;

function liveIncrement() {
    liveCountValue++;
    document.getElementById('liveCount').textContent = liveCountValue;
}

function liveDecrement() {
    liveCountValue--;
    document.getElementById('liveCount').textContent = liveCountValue;
}

function liveReset() {
    liveCountValue = 0;
    document.getElementById('liveCount').textContent = liveCountValue;
}

// 頁面載入提示
window.addEventListener('load', function() {
    setTimeout(() => {
        if (confirm('🔍 想要接受挑戰嗎？\n\n你的任務是在 HTML、CSS 和 JavaScript 的註解中找出三個 FLAG 片段，並組合成完整的 FLAG！\n\n提示：按 Ctrl+U (或 Cmd+U) 可以檢視網頁原始碼。\n\n準備好了嗎？')) {
            alert('💪 很好！開始你的尋寶之旅吧！\n\n記得仔細檢查每個註解區塊～');
        }
    }, 1000);
});
