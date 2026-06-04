<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}

include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answer"])){
    $input_answer = $_POST["answer"];
    if($input_answer=="flag{deserialization_easy_flag}"){
        $user_id = $_SESSION["id"];
        $challenges_name = "Insecure-Deserialization-1";
        include_once('../challenges.php');
        $challenge_array = CheckChallenges($link,$user_id,$challenges_name);
    }else{
        $challenge_array = array('alert','答案錯誤');
    }
}
$challenge_type = isset($challenge_array[0]) ? $challenge_array[0] : '';
$challenge_messange = isset($challenge_array[1]) ? $challenge_array[1] : '';
?>

<?php
    $titlename='反序列化安全 - Lab 1';
	include_once('../../php-inc/header.php');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h1>PHP 反序列化安全漏洞</h1>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h4>什麼是反序列化漏洞？</h4>
                        <p>反序列化漏洞（Insecure Deserialization）是一種常見的安全漏洞，當應用程式在還原（反序列化）使用者可控制的資料時，未進行適當的驗證，可能導致遠端程式碼執行、繞過認證、拒絕服務等安全問題。</p>
                        <p>常見於 PHP 的 <code>unserialize()</code> 函數，這個函數能將字串轉換回 PHP 物件。但若使用者能控制被反序列化的字串，則可能導致安全風險。</p>
                    </div>

                    <h2>Lab 1 - 基本反序列化漏洞實作</h2>
                    <p>在這個實驗中，我們將展示如何利用 PHP 的魔術方法（Magic Methods）來觸發反序列化漏洞。</p>
                    <p><strong>目標</strong>：找出並利用反序列化漏洞讀取位於 <code>/etc/.desflag</code> 的 flag。</p>

                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h3>提供的類別</h3>
                        </div>
                        <div class="card-body">
                            <pre class="bg-light p-3"><code>
/**
 * Logger 類別 - 用於讀取檔案
 */
class Logger
{
    public $FileName = 'error.log';
         
    public function __toString()
    {
        return file_get_contents($this->FileName);
    }
}

/**
 * Person 類別 - 基本使用者資訊
 */
class Person {
    public $num;
    public $name;
    
    public function __construct($num, $name){
        $this->num = $num;
        $this->name = $name;
    }
    
    public function __toString()
    {
        return $this->name;
    }
}
</code></pre>
                            <div class="alert alert-warning">
                                <h5>這些類別有什麼特點？</h5>
                                <ul>
                                    <li><strong>__toString()</strong> 魔術方法：當物件被當作字串使用時會自動呼叫</li>
                                    <li><strong>Logger</strong> 類別：使用 <code>file_get_contents()</code> 讀取檔案</li>
                                    <li><strong>Person</strong> 類別：存儲使用者訊息</li>
                                </ul>
                                <p>想想看：如何利用這些特性來達成目標？</p>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h3>序列化範例</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            // 定義類別
                            class Logger
                            {
                                public $FileName = 'error.log';
                                     
                                public function __toString()
                                {
                                    return file_get_contents($this->FileName);
                                }
                            }

                            class Person {
                                public $num;
                                public $name;
                                
                                public function __construct($num, $name){
                                    $this->num = $num;
                                    $this->name = $name;
                                }
                                
                                public function __toString()
                                {
                                    return $this->name;
                                }
                            }

                            // 建立物件並序列化
                            $obj = new Person(10, "小明");
                            $serialized = serialize($obj);
                            ?>

                            <h4>序列化範例</h4>
                            <p>我們建立了一個 <code>Person</code> 物件並序列化它：</p>
                            <code>$obj = new Person(10, "小明");</code>
                            <p>序列化結果：</p>
                            <div class="bg-light p-2 mb-3">
                                <code><?php echo htmlspecialchars($serialized); ?></code>
                            </div>
                            <p>序列化的格式解釋：</p>
                            <ul>
                                <li><code>O:6:"Person"</code> - 物件，類別名稱長度為6，名稱為 "Person"</li>
                                <li><code>2</code> - 有2個屬性</li>
                                <li><code>s:3:"num";i:10;</code> - 屬性名為 "num"，值為整數 10</li>
                                <li><code>s:4:"name";s:6:"小明";</code> - 屬性名為 "name"，值為字串 "小明"</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-danger text-white">
                            <h3>實驗環節</h3>
                        </div>
                        <div class="card-body">
                            <p>請嘗試修改下方輸入框中的序列化字串，讓系統反序列化後觸發漏洞。</p>
                            <p>提示：思考如何讓系統在反序列化後呼叫 <code>__toString()</code> 方法，並改變 <code>$FileName</code> 屬性指向 <code>/etc/.desflag</code>。</p>

                            <form method="GET" class="mb-4">
                                <div class="form-group">
                                    <label for="obj"><strong>序列化字串：</strong></label>
                                    <input type='text' class='form-control' value='<?php echo htmlspecialchars($serialized); ?>' id='obj' name='obj'>
                                </div>
                                <button type="submit" class="btn btn-primary">送出</button>
                            </form>

                            <div class="bg-light p-3 mb-3">
                                <h4>反序列化結果：</h4>
                                <?php
                                if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["obj"])){
                                    echo "<div class='mb-3'><strong>您提交的序列化字串：</strong> ";
                                    echo htmlspecialchars($_GET["obj"]);
                                    echo "</div>";
                                    
                                    try {
                                        $ready_serialized_object = unserialize($_GET['obj']);
                                        echo "<div class='mb-3'><strong>反序列化後的物件：</strong> ";
                                        echo var_dump($ready_serialized_object);
                                        echo "</div>";
                                        
                                        echo "<div class='mb-3'><strong>當作字串使用（呼叫 __toString）：</strong> <br>";
                                        echo htmlspecialchars($ready_serialized_object);
                                        echo "</div>";
                                    } catch (Exception $e) {
                                        echo "<div class='alert alert-danger'>反序列化錯誤：" . $e->getMessage() . "</div>";
                                    }
                                }
                                ?>
                            </div>
                            
                            <div class="alert alert-success">
                                <h5>提示</h5>
                                <p>如果您成功利用漏洞，將可以讀取 <code>/etc/.desflag</code> 檔案的內容。</p>
                                <p>成功後，您會看到 flag 格式為：<code>flag{...}</code></p>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h3>答案提交</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="answer">請輸入您找到的 flag：</label>
                                    <input type="text" class="form-control" placeholder="例如：flag{example_flag}" id="answer" name="answer">
                                </div>
                                <button type="submit" class="btn btn-success">提交答案</button>
                            </form>
                            
                            <?php if(isset($challenge_type) && !empty($challenge_type)): ?>
                            <div class="mt-3 alert alert-<?php echo $challenge_type == 'success' ? 'success' : 'danger'; ?>">
                                <?php echo $challenge_messange; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h3>參考指令</h3>
                        </div>
                        <div class="card-body">
                            <h4>解題步驟指南</h4>
                            <p>以下是解決此問題的步驟和參考指令：</p>
                            
                            <div class="alert alert-secondary">
                                <h5>步驟 1: 了解漏洞原理</h5>
                                <p>當系統對一個字串做反序列化時，會轉成對應的物件。如果物件在某個情境下被當作字串使用，會自動呼叫該物件的 <code>__toString()</code> 方法。</p>
                            </div>
                            
                            <div class="alert alert-secondary">
                                <h5>步驟 2: 觀察可用的類別</h5>
                                <p>我們注意到 <code>Logger</code> 類別的 <code>__toString()</code> 方法會讀取 <code>$FileName</code> 指定的檔案內容：</p>
                                <pre class="bg-light p-2"><code>public function __toString()
{
    return file_get_contents($this->FileName);
}</code></pre>
                            </div>
                            
                            <div class="alert alert-secondary">
                                <h5>步驟 3: 構造攻擊字串</h5>
                                <p>我們可以構造一個 <code>Logger</code> 物件，將其 <code>$FileName</code> 指向目標檔案 <code>/etc/.desflag</code>：</p>
                                <pre class="bg-light p-2"><code>$logger = new Logger();
$logger->FileName = '/etc/.desflag';
echo serialize($logger);</code></pre>
                                <p>產生的序列化字串大約會是：</p>
                                <pre class="bg-light p-2"><code>O:6:"Logger":1:{s:8:"FileName";s:13:"/etc/.desflag";}</code></pre>
                            </div>
                            
                            <div class="alert alert-secondary">
                                <h5>步驟 4: 提交攻擊字串</h5>
                                <p>將上面的序列化字串複製到輸入框中提交。系統會反序列化這個字串，產生一個 <code>Logger</code> 物件。</p>
                                <p>當系統執行 <code>echo $ready_serialized_object;</code> 時，會觸發 <code>__toString()</code> 方法，讀取並顯示 <code>/etc/.desflag</code> 的內容。</p>
                            </div>
                            
                            <div class="alert alert-info">
                                <h5>提示：手動構造序列化字串</h5>
                                <p>如果您無法在環境中執行 PHP 代碼，也可以手動構造序列化字串：</p>
                                <ol>
                                    <li><code>O:6:"Logger"</code> - 物件，類別名稱為 "Logger"（長度為6）</li>
                                    <li><code>:1:{</code> - 有1個屬性</li>
                                    <li><code>s:8:"FileName";</code> - 屬性名為 "FileName"（長度為8）</li>
                                    <li><code>s:13:"/etc/.desflag";</code> - 值為字串 "/etc/.desflag"（長度為13）</li>
                                    <li><code>}</code> - 結束</li>
                                </ol>
                                <p>完整的序列化字串：<code>O:6:"Logger":1:{s:8:"FileName";s:13:"/etc/.desflag";}</code></p>
                            </div>
                            

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h3>學習更多</h3>
                        </div>
                        <div class="card-body">
                            <h4>防禦措施</h4>
                            <ol>
                                <li>不要使用 <code>unserialize()</code> 處理不可信的資料</li>
                                <li>使用更安全的資料交換格式，如 JSON</li>
                                <li>在反序列化前進行數位簽名驗證</li>
                                <li>使用 PHP 7.0+ 的 <code>unserialize()</code> 的 <code>allowed_classes</code> 參數</li>
                            </ol>

                            <h4>相關資源</h4>
                            <ul>
                                <li><a href="https://owasp.org/www-project-top-ten/2017/A8_2017-Insecure_Deserialization" target="_blank">OWASP Top 10 - A8:2017 不安全的反序列化</a></li>
                                <li><a href="https://www.php.net/manual/en/function.unserialize.php" target="_blank">PHP unserialize() 文件</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
	include_once('../../php-inc/footer.php');
?>