<?
function hehun_conver($s) {
        $s=str_replace("|","©¦",$s);
        $s=str_replace("<","&lt;",$s);
        $s=str_replace(">","&gt;",$s);
        $s=str_replace("\r","",$s);
        $s=str_replace("\t","",$s);
        @$s=str_replace("\n","<br>",$s);
        $s=str_replace(" ","&nbsp;",$s);
        return $s;          }
function hehun_convet($s) {
        $s=str_replace("|","",$s);
        $s=str_replace("<","",$s);
        $s=str_replace(">","",$s);
        $s=str_replace("\r","",$s);
        $s=str_replace("\t","",$s);
        $s=str_replace("\\","",$s);
        $s=str_replace("\n","",$s);
        $s=str_replace(" ","",$s);
        $s=str_replace("'","",$s);
        $s=str_replace("*","",$s);
        $s=str_replace("@","",$s);
        $s=str_replace("?","",$s);
        $s=str_replace("!","",$s);
        $s=str_replace("=","",$s);
        $s=str_replace("+","",$s);
        $s=str_replace(":","",$s);
        $s=str_replace("<?","",$s);
        $s=str_replace("?>","",$s);
        $s=str_replace("<%","",$s);
        $s=str_replace("%>","",$s);
        return $s;          }
?>