<?php

echo "<li>查詢結果如下</li>";



if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["category"])  ){
    $input_query = $_GET["category"];
    echo "<li>使用者輸入的 SQL 查詢語言</li>";
    echo "<pre>";
    echo "SELECT * FROM `products`WHERE `category`='" . $input_query  ."' AND `released` = 1;";
    echo "</pre><br>";

    $sql="SELECT * FROM `products`WHERE `category`='" . $input_query  ."' AND `released` = 1;";
    
    include('config.php'); 
    if($result = mysqli_query($link_select, $sql)){
        echo "<li>查詢結果如下</li><div class='table-responsive'>";
        // $row = mysqli_fetch_array($result);
        // echo build_table($row);
        // $num_count =  count($row);
        $check_first = 0;
        while($row = mysqli_fetch_array($result)){
            
            if($check_first==0){
                echo "<table class='table table-sm table-hover'><tr>";
                foreach($row as $key => $item) {
                    if (is_int($key) == 0){
                        echo "<th>".$key."</th>";
                    }
                }
                $check_first = $check_first +1;
                echo "</tr>";
            }
            $num_count =  count($row);
           
            echo "<tr>";
            for ( $i=0 ; $i<$num_count ; $i++ ) {
                echo "<td>".$row[$i]."</td>";
            }
            echo "</tr>";
            

        }
        echo "</table></div>";
    }else{
        echo "SQL Error";
    }
}

?>