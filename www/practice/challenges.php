<?php

function CheckChallenges($link,$user_id,$challenges_name){

    $sql = "SELECT * FROM challenges WHERE user_id ='$user_id' AND  name='$challenges_name' ";
    $result = mysqli_query($link,$sql );
    if( mysqli_num_rows($result) > 0) {
        $sql = "UPDATE `challenges` SET `check` = '1' WHERE `user_id` = '$user_id' AND `name` = '$challenges_name'";
        if (mysqli_query($link, $sql)) {
            return array('alert', "已重複 ".$challenges_name." 答題<br>");
          } else {
            return array('alert', "SQL Error<br>");
          }
    }
    else
    {
        $sql = "INSERT INTO `challenges` (`id`, `name`, `check`, `user_id`) VALUES (NULL, '$challenges_name', '1', '$user_id');";
        if (mysqli_query($link, $sql)) {
            return array('success', "成功完成 ".$challenges_name." 答題<br>");
        } else {
            return array('alert', "SQL Error<br>");
        }
    }

}

function ChallengeStatus($link,$user_id,$challenges_name){

    $sql = "SELECT * FROM challenges WHERE user_id ='$user_id' AND  name='$challenges_name' ";
    $result = mysqli_query($link,$sql);
    if( mysqli_num_rows($result) > 0) {
        return '已答題';
    }
    return '尚未完成';
}


// function ChallengeStatus($link,$user_id,$challenges_name){

//     $sql = "SELECT * FROM challenges WHERE user_id ='$user_id' AND  name='$challenges_name' ";
//     $result = mysqli_query($link,$sql);
//     if( mysqli_num_rows($result) > 0) {
//         return '<button type="button" class="btn btn-success btn-sm">已完成</button>';
//     }
//     return '<button type="button" class="btn btn-danger btn-sm">未完成</button>';
// }



?>