# lab.feifei.tw

Web 資安實戰練習平台，由 [Kiwi's Security 七維思資安](https://feifei.tw) 建置，提供 SQL Injection、XSS、RCE、LFI、XXE 等 OWASP 常見弱點的實作練習環境。

## 架構總覽

使用 Docker Compose 啟動多個服務：

| 服務 | Port | 說明 |
|------|------|------|
| **www** | 8080 | 主站（PHP 7 + Apache），包含所有練習題目 |
| **db** | 8081 | MySQL 5.7 資料庫 |
| **phpmyadmin** | 8082 | phpMyAdmin 資料庫管理介面 |
| **web2 (server)** | 8083 | 獨立靶機（CI、LFI、Upload 題目） |
| **web3 (ctf)** | 8084 | CTF 挑戰題 |
| **exam** | 8085 | 考試系統 |

## 快速啟動

```bash
docker-compose up -d
```

啟動後開啟瀏覽器訪問 `http://localhost:8080`。

## 練習題目分類

### 基礎觀念 (www/practice/basic)
- HTTP 協定、DevTools、cURL 操作、編碼解碼、Burp Suite

### 弱點實戰 (www/practice)

| 目錄 | 弱點類型 |
|------|----------|
| `sqli/` | SQL Injection（含 Union、Blind、Login Bypass） |
| `xss/` | Cross-Site Scripting（Reflected、Stored、DOM-based） |
| `rce/` | Remote Code Execution |
| `fi/` | File Inclusion（LFI / RFI） |
| `up/` | File Upload |
| `xxe/` | XML External Entity |
| `ci/` | Command Injection |
| `deserialization/` | PHP 反序列化 |
| `rf/` | SSRF（Server-Side Request Forgery） |
| `sensitive/` | 敏感資訊洩漏 |
| `access/` | 存取控制（IDOR） |
| `cors/` | CORS 跨域設定 |
| `auth/` | 認證與授權 |
| `client/` | 前端安全 |
| `cookie/` | Cookie 安全 |

### 進階與專題

| 目錄 | 說明 |
|------|------|
| `adv/` | 進階綜合題 |
| `vulnbasic/` | 弱點基礎概念 |
| `ssdlc/` | 安全軟體開發生命週期（SSDLC） |
| `vc/` | 版本控制安全 |
| `linux/` | Linux 基礎與權限 |
| `osint/` | 開源情報蒐集（OSINT） |
| `iot/` | IoT 安全 |
| `warm/` | 暖身題 |

### 教學 Demo (www/demo)
- SQL Injection 互動教學（5 個分級頁面）
- XSS 實作（Week 2 課程含 Reflected、Stored、DOM-based）
- 安全知識複習（OWASP Top 10 2025、HTTP、PHP 安全）

### CTF 挑戰 (ctf/)
- PHP 弱型別比較、正規表達式繞過、eval 利用、XOR 運算

### Linux 挑戰 (LinuxGame/)
- Linux 指令與環境變數練習

## 專案結構

```
lab.feifei.tw/
├── docker-compose.yml    # 服務編排
├── Dockerfile            # PHP 7 + Apache 映像檔
├── mysql/testdb.sql      # 資料庫初始化（含練習用資料）
├── config/custom.ini     # PHP 設定
├── www/                  # 主站（port 8080）
│   ├── practice/         # 所有練習題目（依弱點分類）
│   ├── demo/             # 互動教學頁面
│   ├── account/          # 帳號系統（登入、註冊）
│   ├── admin/            # 管理後台
│   └── php-inc/          # 共用元件（header、footer、WAF）
├── server/               # 獨立靶機（port 8083）
│   ├── ci/               # Command Injection
│   ├── lfi/              # Local File Inclusion
│   └── up/               # File Upload
├── ctf/                  # CTF 挑戰（port 8084）
├── exam/                 # 考試系統（port 8085）
├── flag/                 # Flag 檔案
├── log/                  # Apache 日誌
└── backup.sql            # 資料庫備份
```

## 注意事項

- 本平台僅供教學與授權測試使用，請勿用於非法用途
- 預設資料庫帳號：`user` / `test`，root 密碼：`test`
- 包含刻意設計的弱點程式碼，請勿部署於公開環境

## 授權

本專案為教學用途，由 Fei (飛飛) @ Kiwi's Security 維護。
