<?php

// php
// $a = '-~@#$%^&*_+|/?,<>`-=()[]';
// for($i=0;$i<strlen($a);$i++){
//     for($j=0;$j<strlen($a);$j){
//         if(ord($a[$i]^$a[$j])>64 && ord($a[$i]^$a[$j])<91){
//             echo $a[$i] . ' xor '.$a[$j]. ' is ';
//             echo chr(ord($a[$i]^$a[$j])).' ';
//             echo ord($a[$i]^$a[$j]);
//             echo "\n<br>" ;
        
//         }else if(ord($a[$i]^$a[$j])>96 && ord($a[$i]^$a[$j])<122){
//             echo $a[$i] . ' xor '.$a[$j]. ' is ';
//             echo chr(ord($a[$i]^$a[$j])).' ';
//             echo ord($a[$i]^$a[$j]);
//             echo "\n<br>" ;
//         }
//     }
// }


// python
// online:https://onlinegdb.com/IzScUSJV9
// a = "-~@#$%^&*_+|/?,<>`-=()[]";
// for i in range(len(a)):
//     for j in range(len(a)):
//         s = ord(a[i])^ord(a[j])
//         if s > 64 and s < 96:
//             print(a[i]+" ^ "+a[j]+" = "+str(s)+" "+chr(s))
//         elif s>96 and s<122:
//             print(a[i]+" ^ "+a[j]+" = "+str(s)+" "+chr(s))
 highlight_file(__FILE__);

?>