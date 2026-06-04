# SQL 與 SQL Injection 視覺化教學網站

## 📋 專案簡介

這是一個互動式的 SQL 與 SQL Injection 教學網站，專為初學者設計，使用繁體中文與台灣用語，透過視覺化的方式讓沒有程式背景的人也能理解資料庫操作與資安概念。

## 🎯 課程內容

### 第一課：SQL 基礎與 CRUD 操作
- ✅ 學習資料庫的四大基本操作（新增、查詢、更新、刪除）
- ✅ 即時視覺化 SQL 指令執行過程
- ✅ 互動式資料庫狀態顯示

### 第二課：SQL Injection 入門
- ⚠️ 理解字串拼接的危險性
- ⚠️ 視覺化 SQL 注入攻擊流程
- ⚠️ 學習 WHERE 條件注入原理
- ⚠️ 了解單引號與註解符號的使用

### 第三課：數字型 SQL Injection
- 🔢 學習不需要單引號的注入攻擊
- 🔢 理解數字型參數的安全問題
- 🔢 掌握 OR/AND 邏輯運算子應用
- 🔢 實作防禦方法

### 第四課：Union Select 注入
- 🔗 學習進階資料竊取技術
- 🔗 使用 ORDER BY 探測欄位數量
- 🔗 掌握 UNION SELECT NULL 技巧
- 🔗 了解 information_schema 的利用

### 第五課：盲注 (Blind SQL Injection)
- 🕵️ 學習布林盲注（Boolean-based）
- 🕵️ 學習時間盲注（Time-based）
- 🕵️ 逐字元探測資料的方法
- 🕵️ 理解自動化攻擊原理

## 🚀 使用方法

### 方法一：直接開啟檔案
1. 用瀏覽器開啟 `index.html`
2. 點擊想學習的課程
3. 跟著指示進行互動操作

### 方法二：本機伺服器（推薦）
```bash
# 使用 Python 啟動簡易伺服器
cd sqldemo
python3 -m http.server 8000

# 然後在瀏覽器開啟
# http://localhost:8000
```

### 方法三：Live Server (VS Code)
1. 安裝 VS Code 的 Live Server 擴充套件
2. 在 `index.html` 上按右鍵
3. 選擇 "Open with Live Server"

## 📁 檔案結構

```
sqldemo/
├── index.html                    # 主頁面（課程導航）
├── page1-crud.html              # 第一課：SQL CRUD
├── page2-injection-basic.html   # 第二課：SQL Injection 基礎
├── page3-numeric-injection.html # 第三課：數字型注入
├── page4-union-select.html      # 第四課：Union Select
├── page5-blind-injection.html   # 第五課：盲注
├── styles.css                   # 共用樣式表
└── README.md                    # 說明文件
```

## ✨ 特色功能

### 🎮 互動式學習
- 每個範例都可以實際操作
- 即時顯示 SQL 指令
- 視覺化資料庫變化

### 📊 視覺化展示
- 流程圖顯示攻擊步驟
- 資料表即時更新
- 語法高亮顯示

### 🎯 循序漸進
- 從基礎到進階
- 每課都有詳細說明
- 包含防禦方法

### 🇹🇼 在地化
- 使用繁體中文
- 台灣用語與範例
- 適合華語學習者

## 🛡️ 安全提醒

⚠️ **重要：本教學網站僅供教育用途**

- ✅ 可用於：學習資安知識、了解漏洞原理、提升防禦能力
- ❌ 禁止：用於非法入侵、未經授權的測試、惡意攻擊

請遵守相關法律規範，將知識用於正當用途！

## 🎓 學習建議

1. **按順序學習**：建議從第一課開始，循序漸進
2. **動手操作**：每個範例都要親自測試
3. **理解原理**：不只記住步驟，更要理解為什麼
4. **注重防禦**：學習攻擊是為了更好地防禦

## 🔧 技術棧

- HTML5
- CSS3
- Vanilla JavaScript（純 JavaScript，無框架）
- 無需後端伺服器（純前端運行）

## 📝 授權

本專案僅供教育用途，請勿用於非法活動。

## 🙏 致謝

感謝所有為資訊安全教育貢獻的人們。

---

**製作日期**：2025
**語言**：繁體中文
**難度**：初學者友善
