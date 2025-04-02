<?php
/** Adminer Editor - Compact database editor
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2009 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.17.1
*/$ca="4.17.1";function
adminer_errors($cc,$dc){return!!preg_match('~^(Trying to access array offset on( value of type)? null|Undefined (array key|property))~',$dc);}error_reporting(6135);set_error_handler('adminer_errors',E_WARNING);$sc=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($sc||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$yg=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($yg)$$X=$yg;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$h;return$h;}function
adminer(){global$b;return$b;}function
version(){global$ca;return$ca;}function
idf_unescape($t){if(!preg_match('~^[`\'"[]~',$t))return$t;$wd=substr($t,-1);return
str_replace($wd.$wd,$wd,substr($t,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($Le,$sc=false){if(function_exists("get_magic_quotes_gpc")&&get_magic_quotes_gpc()){while(list($x,$X)=each($Le)){foreach($X
as$od=>$W){unset($Le[$x][$od]);if(is_array($W)){$Le[$x][stripslashes($od)]=$W;$Le[]=&$Le[$x][stripslashes($od)];}else$Le[$x][stripslashes($od)]=($sc?$W:stripslashes($W));}}}}function
bracket_escape($t,$Fa=false){static$jg=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($t,($Fa?array_flip($jg):$jg));}function
min_version($Jg,$Gd="",$i=null){global$h;if(!$i)$i=$h;$tf=$i->server_info;if($Gd&&preg_match('~([\d.]+)-MariaDB~',$tf,$_)){$tf=$_[1];$Jg=$Gd;}return$Jg&&version_compare($tf,$Jg)>=0;}function
charset($h){return(min_version("5.5.3",0,$h)?"utf8mb4":"utf8");}function
script($Bf,$ig="\n"){return"<script".nonce().">$Bf</script>$ig";}function
script_src($Cg){return"<script src='".h($Cg)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($P){return
str_replace("\0","&#0;",htmlspecialchars($P,ENT_QUOTES,'utf-8'));}function
nl_br($P){return
str_replace("\n","<br>",$P);}function
checkbox($A,$Y,$Ua,$sd="",$he="",$Xa="",$td=""){$G="<input type='checkbox' name='$A' value='".h($Y)."'".($Ua?" checked":"").($td?" aria-labelledby='$td'":"").">".($he?script("qsl('input').onclick = function () { $he };",""):"");return($sd!=""||$Xa?"<label".($Xa?" class='$Xa'":"").">$G".h($sd)."</label>":$G);}function
optionlist($B,$mf=null,$Fg=false){$G="";foreach($B
as$od=>$W){$me=array($od=>$W);if(is_array($W)){$G.='<optgroup label="'.h($od).'">';$me=$W;}foreach($me
as$x=>$X)$G.='<option'.($Fg||is_string($x)?' value="'.h($x).'"':'').($mf!==null&&($Fg||is_string($x)?(string)$x:$X)===$mf?' selected':'').'>'.h($X);if(is_array($W))$G.='</optgroup>';}return$G;}function
html_select($A,$B,$Y="",$ge=true,$td=""){if($ge)return"<select name='".h($A)."'".($td?" aria-labelledby='$td'":"").">".optionlist($B,$Y)."</select>".(is_string($ge)?script("qsl('select').onchange = function () { $ge };",""):"");$G="";foreach($B
as$x=>$X)$G.="<label><input type='radio' name='".h($A)."' value='".h($x)."'".($x==$Y?" checked":"").">".h($X)."</label>";return$G;}function
confirm($Od="",$nf="qsl('input')"){return
script("$nf.onclick = function () { return confirm('".($Od?js_escape($Od):lang(0))."'); };","");}function
print_fieldset($Wc,$yd,$Mg=false){echo"<fieldset><legend>","<a href='#fieldset-$Wc'>$yd</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$Wc');",""),"</legend>","<div id='fieldset-$Wc'".($Mg?"":" class='hidden'").">\n";}function
bold($Ma,$Xa=""){return($Ma?" class='active $Xa'":($Xa?" class='$Xa'":""));}function
js_escape($P){return
addcslashes($P,"\r\n'\\/");}function
ini_bool($fd){$X=ini_get($fd);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$G;if($G===null)$G=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$G;}function
set_password($Ig,$L,$V,$D){$_SESSION["pwds"][$Ig][$L][$V]=($_COOKIE["adminer_key"]&&is_string($D)?array(encrypt_string($D,$_COOKIE["adminer_key"])):$D);}function
get_password(){$G=get_session("pwds");if(is_array($G))$G=($_COOKIE["adminer_key"]?decrypt_string($G[0],$_COOKIE["adminer_key"]):false);return$G;}function
q($P){global$h;return$h->quote($P);}function
get_vals($E,$e=0){global$h;$G=array();$F=$h->query($E);if(is_object($F)){while($H=$F->fetch_row())$G[]=$H[$e];}return$G;}function
get_key_vals($E,$i=null,$wf=true){global$h;if(!is_object($i))$i=$h;$G=array();$F=$i->query($E);if(is_object($F)){while($H=$F->fetch_row()){if($wf)$G[$H[0]]=$H[1];else$G[]=$H[0];}}return$G;}function
get_rows($E,$i=null,$n="<p class='error'>"){global$h;$kb=(is_object($i)?$i:$h);$G=array();$F=$kb->query($E);if(is_object($F)){while($H=$F->fetch_assoc())$G[]=$H;}elseif(!$F&&!is_object($i)&&$n&&(defined("PAGE_HEADER")||$n=="-- "))echo$n.error()."\n";return$G;}function
unique_array($H,$v){foreach($v
as$u){if(preg_match("~PRIMARY|UNIQUE~",$u["type"])){$G=array();foreach($u["columns"]as$x){if(!isset($H[$x]))continue
2;$G[$x]=$H[$x];}return$G;}}}function
escape_key($x){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$x,$_))return$_[1].idf_escape(idf_unescape($_[2])).$_[3];return
idf_escape($x);}function
where($Z,$p=array()){global$h,$w;$G=array();foreach((array)$Z["where"]as$x=>$X){$x=bracket_escape($x,1);$e=escape_key($x);$G[]=$e.($w=="sql"&&$p[$x]["type"]=="json"?" = CAST(".q($X)." AS JSON)":($w=="sql"&&is_numeric($X)&&preg_match('~\.~',$X)?" LIKE ".q($X):($w=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($p[$x],q($X)))));if($w=="sql"&&preg_match('~char|text~',$p[$x]["type"])&&preg_match("~[^ -@]~",$X))$G[]="$e = ".q($X)." COLLATE ".charset($h)."_bin";}foreach((array)$Z["null"]as$x)$G[]=escape_key($x)." IS NULL";return
implode(" AND ",$G);}function
where_check($X,$p=array()){parse_str($X,$Sa);remove_slashes(array(&$Sa));return
where($Sa,$p);}function
where_link($s,$e,$Y,$je="="){return"&where%5B$s%5D%5Bcol%5D=".urlencode($e)."&where%5B$s%5D%5Bop%5D=".urlencode(($Y!==null?$je:"IS NULL"))."&where%5B$s%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($f,$p,$J=array()){$G="";foreach($f
as$x=>$X){if($J&&!in_array(idf_escape($x),$J))continue;$ya=convert_field($p[$x]);if($ya)$G.=", $ya AS ".idf_escape($x);}return$G;}function
cookie($A,$Y,$Ad=2592000){global$aa;return
header("Set-Cookie: $A=".urlencode($Y).($Ad?"; expires=".gmdate("D, d M Y H:i:s",time()+$Ad)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($aa?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($yc=false){$Eg=ini_bool("session.use_cookies");if(!$Eg||$yc){session_write_close();if($Eg&&@ini_set("session.use_cookies",false)===false)session_start();}}function&get_session($x){return$_SESSION[$x][DRIVER][SERVER][$_GET["username"]];}function
set_session($x,$X){$_SESSION[$x][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($Ig,$L,$V,$l=null){global$Mb;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($Mb))."|username|".($l!==null?"db|":"").session_name()),$_);return"$_[1]?".(sid()?SID."&":"").($Ig!="server"||$L!=""?urlencode($Ig)."=".urlencode($L)."&":"")."username=".urlencode($V).($l!=""?"&db=".urlencode($l):"").($_[2]?"&$_[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($Cd,$Od=null){if($Od!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($Cd!==null?$Cd:$_SERVER["REQUEST_URI"]))][]=$Od;}if($Cd!==null){if($Cd=="")$Cd=".";header("Location: $Cd");exit;}}function
query_redirect($E,$Cd,$Od,$Te=true,$hc=true,$mc=false,$Yf=""){global$h,$n,$b;if($hc){$Hf=microtime(true);$mc=!$h->query($E);$Yf=format_time($Hf);}$Ef="";if($E)$Ef=$b->messageQuery($E,$Yf,$mc);if($mc){$n=error().$Ef.script("messagesPrint();");return
false;}if($Te)redirect($Cd,$Od.$Ef);return
true;}function
queries($E){global$h;static$Oe=array();static$Hf;if(!$Hf)$Hf=microtime(true);if($E===null)return
array(implode("\n",$Oe),format_time($Hf));$Oe[]=(preg_match('~;$~',$E)?"DELIMITER ;;\n$E;\nDELIMITER ":$E).";";return$h->query($E);}function
apply_queries($E,$S,$ec='table'){foreach($S
as$Q){if(!queries("$E ".$ec($Q)))return
false;}return
true;}function
queries_redirect($Cd,$Od,$Te){list($Oe,$Yf)=queries(null);return
query_redirect($Oe,$Cd,$Od,$Te,false,!$Te,$Yf);}function
format_time($Hf){return
lang(1,max(0,microtime(true)-$Hf));}function
relative_uri(){return
str_replace(":","%3a",preg_replace('~^[^?]*/([^?]*)~','\1',$_SERVER["REQUEST_URI"]));}function
remove_from_uri($xe=""){return
substr(preg_replace("~(?<=[?&])($xe".(SID?"":"|".session_name()).")=[^&]*&~",'',relative_uri()."&"),0,-1);}function
pagination($C,$yb){return" ".($C==$yb?$C+1:'<a href="'.h(remove_from_uri("page").($C?"&page=$C".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($C+1)."</a>");}function
get_file($x,$Bb=false){$qc=$_FILES[$x];if(!$qc)return
null;foreach($qc
as$x=>$X)$qc[$x]=(array)$X;$G='';foreach($qc["error"]as$x=>$n){if($n)return$n;$A=$qc["name"][$x];$fg=$qc["tmp_name"][$x];$pb=file_get_contents($Bb&&preg_match('~\.gz$~',$A)?"compress.zlib://$fg":$fg);if($Bb){$Hf=substr($pb,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Hf,$Ue))$pb=iconv("utf-16","utf-8",$pb);elseif($Hf=="\xEF\xBB\xBF")$pb=substr($pb,3);$G.=$pb."\n\n";}else$G.=$pb;}return$G;}function
upload_error($n){$Ld=($n==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($n?lang(2).($Ld?" ".lang(3,$Ld):""):lang(4));}function
repeat_pattern($Ae,$zd){return
str_repeat("$Ae{0,65535}",$zd/65535)."$Ae{0,".($zd%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($P,$zd=80,$Mf=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$zd).")($)?)u",$P,$_))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$zd).")($)?)",$P,$_);return
h($_[1]).$Mf.(isset($_[2])?"":"<i>â€¦</i>");}function
format_number($X){return
strtr(number_format($X,0,".",lang(5)),preg_split('~~u',lang(6),-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($Le,$Zc=array(),$Ge=''){$G=false;foreach($Le
as$x=>$X){if(!in_array($x,$Zc)){if(is_array($X))hidden_fields($X,array(),$x);else{$G=true;echo'<input type="hidden" name="'.h($Ge?$Ge."[$x]":$x).'" value="'.h($X).'">';}}}return$G;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($Q,$nc=false){$G=table_status($Q,$nc);return($G?$G:array("Name"=>$Q));}function
column_foreign_keys($Q){global$b;$G=array();foreach($b->foreignKeys($Q)as$Bc){foreach($Bc["source"]as$X)$G[$X][]=$Bc;}return$G;}function
enum_input($T,$Aa,$o,$Y,$Xb=null){global$b,$w;preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$Id);$G=($Xb!==null?"<label><input type='$T'$Aa value='$Xb'".((is_array($Y)?in_array($Xb,$Y):$Y===0)?" checked":"")."><i>".lang(7)."</i></label>":"");foreach($Id[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$Ua=(is_int($Y)?$Y==$s+1:(is_array($Y)?in_array($s+1,$Y):$Y===$X));$G.=" <label><input type='$T'$Aa value='".($w=="sql"?$s+1:h($X))."'".($Ua?' checked':'').'>'.h($b->editVal($X,$o)).'</label>';}return$G;}function
input($o,$Y,$r){global$U,$Jf,$b,$w;$A=h(bracket_escape($o["field"]));echo"<td class='function'>";if(is_array($Y)&&!$r){$wa=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$wa[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$wa);$r="json";}$Ze=($w=="mssql"&&$o["auto_increment"]);if($Ze&&!$_POST["save"])$r=null;$Hc=(isset($_GET["select"])||$Ze?array("orig"=>lang(8)):array())+$b->editFunctions($o);$Jb=stripos($o["default"],"GENERATED ALWAYS AS ")===0?" disabled=''":"";$Aa=" name='fields[$A]'$Jb";if($w=="pgsql"&&in_array($o["type"],(array)$Jf[lang(9)])){$ac=get_vals("SELECT enumlabel FROM pg_enum WHERE enumtypid = ".$U[$o["type"]]." ORDER BY enumsortorder");if($ac){$o["type"]="enum";$o["length"]="'".implode("','",array_map('addslashes',$ac))."'";}}if($o["type"]=="enum")echo
h($Hc[""])."<td>".$b->editInput($_GET["edit"],$o,$Aa,$Y);else{$Oc=(in_array($r,$Hc)||isset($Hc[$r]));echo(count($Hc)>1?"<select name='function[$A]'$Jb>".optionlist($Hc,$r===null||$Oc?$r:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($Hc))).'<td>';$hd=$b->editInput($_GET["edit"],$o,$Aa,$Y);if($hd!="")echo$hd;elseif(preg_match('~bool~',$o["type"]))echo"<input type='hidden'$Aa value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Aa value='1'>";elseif($o["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$Id);foreach($Id[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$Ua=(is_int($Y)?($Y>>$s)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$A][$s]' value='".(1<<$s)."'".($Ua?' checked':'').">".h($b->editVal($X,$o)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$A'>";elseif(($Uf=preg_match('~text|lob|memo~i',$o["type"]))||preg_match("~\n~",$Y)){if($Uf&&$w!="sqlite")$Aa.=" cols='50' rows='12'";else{$I=min(12,substr_count($Y,"\n")+1);$Aa.=" cols='30' rows='$I'".($I==1?" style='height: 1.2em;'":"");}echo"<textarea$Aa>".h($Y).'</textarea>';}elseif($r=="json"||preg_match('~^jsonb?$~',$o["type"]))echo"<textarea$Aa cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Nd=(!preg_match('~int~',$o["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$o["length"],$_)?((preg_match("~binary~",$o["type"])?2:1)*$_[1]+($_[3]?1:0)+($_[2]&&!$o["unsigned"]?1:0)):($U[$o["type"]]?$U[$o["type"]]+($o["unsigned"]?0:1):0));if($w=='sql'&&min_version(5.6)&&preg_match('~time~',$o["type"]))$Nd+=7;echo"<input".((!$Oc||$r==="")&&preg_match('~(?<!o)int(?!er)~',$o["type"])&&!preg_match('~\[\]~',$o["full_type"])?" type='number'":"")." value='".h($Y)."'".($Nd?" data-maxlength='$Nd'":"").(preg_match('~char|binary~',$o["type"])&&$Nd>20?" size='40'":"")."$Aa>";}echo$b->editHint($_GET["edit"],$o,$Y);$tc=0;foreach($Hc
as$x=>$X){if($x===""||!$X)break;$tc++;}if($tc)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $tc), oninput: function () { this.onchange(); }});");}}function
process_input($o){global$b,$m;if(stripos($o["default"],"GENERATED ALWAYS AS ")===0)return
null;$t=bracket_escape($o["field"]);$r=$_POST["function"][$t];$Y=$_POST["fields"][$t];if($o["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($o["auto_increment"]&&$Y=="")return
null;if($r=="orig")return(preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?idf_escape($o["field"]):false);if($r=="NULL")return"NULL";if($o["type"]=="set")return
array_sum((array)$Y);if($r=="json"){$r="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads")){$qc=get_file("fields-$t");if(!is_string($qc))return
false;return$m->quoteBinary($qc);}return$b->processInput($o,$Y,$r);}function
fields_from_edit(){global$m;$G=array();foreach((array)$_POST["field_keys"]as$x=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$x];$_POST["fields"][$X]=$_POST["field_vals"][$x];}}foreach((array)$_POST["fields"]as$x=>$X){$A=bracket_escape($x,1);$G[$A]=array("field"=>$A,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($x==$m->primary),);}return$G;}function
search_tables(){global$b,$h;$_GET["where"][0]["val"]=$_POST["query"];$pf="<ul>\n";foreach(table_status('',true)as$Q=>$R){$A=$b->tableName($R);if(isset($R["Engine"])&&$A!=""&&(!$_POST["tables"]||in_array($Q,$_POST["tables"]))){$F=$h->query("SELECT".limit("1 FROM ".table($Q)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($Q),array())),1));if(!$F||$F->fetch_row()){$Je="<a href='".h(ME."select=".urlencode($Q)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$A</a>";echo"$pf<li>".($F?$Je:"<p class='error'>$Je: ".error())."\n";$pf="";}}}echo($pf?"<p class='message'>".lang(10):"</ul>")."\n";}function
dump_headers($Xc,$Sd=false){global$b;$G=$b->dumpHeaders($Xc,$Sd);$te=$_POST["output"];if($te!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Xc).".$G".($te!="file"&&preg_match('~^[0-9a-z]+$~',$te)?".$te":""));session_write_close();ob_flush();flush();return$G;}function
dump_csv($H){foreach($H
as$x=>$X){if(preg_match('~["\n,;\t]|^0|\.\d*0$~',$X)||$X==="")$H[$x]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$H)."\r\n";}function
apply_sql_function($r,$e){return($r?($r=="unixepoch"?"DATETIME($e, '$r')":($r=="count distinct"?"COUNT(DISTINCT ":strtoupper("$r("))."$e)"):$e);}function
get_temp_dir(){$G=ini_get("upload_tmp_dir");if(!$G){if(function_exists('sys_get_temp_dir'))$G=sys_get_temp_dir();else{$q=@tempnam("","");if(!$q)return
false;$G=dirname($q);unlink($q);}}return$G;}function
file_open_lock($q){$Fc=@fopen($q,"r+");if(!$Fc){$Fc=@fopen($q,"w");if(!$Fc)return;chmod($q,0660);}flock($Fc,LOCK_EX);return$Fc;}function
file_write_unlock($Fc,$zb){rewind($Fc);fwrite($Fc,$zb);ftruncate($Fc,strlen($zb));flock($Fc,LOCK_UN);fclose($Fc);}function
password_file($tb){$q=get_temp_dir()."/adminer.key";$G=@file_get_contents($q);if($G||!$tb)return$G;$Fc=@fopen($q,"w");if($Fc){chmod($q,0660);$G=rand_string();fwrite($Fc,$G);fclose($Fc);}return$G;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$z,$o,$Wf){global$b;if(is_array($X)){$G="";foreach($X
as$od=>$W)$G.="<tr>".($X!=array_values($X)?"<th>".h($od):"")."<td>".select_value($W,$z,$o,$Wf);return"<table>$G</table>";}if(!$z)$z=$b->selectLink($X,$o);if($z===null){if(is_mail($X))$z="mailto:$X";if(is_url($X))$z=$X;}$G=$b->editVal($X,$o);if($G!==null){if(!is_utf8($G))$G="\0";elseif($Wf!=""&&is_shortable($o))$G=shorten_utf8($G,max(0,+$Wf));else$G=h($G);}return$b->selectVal($G,$z,$o,$X);}function
is_mail($Ub){$za='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$Lb='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$Ae="$za+(\\.$za+)*@($Lb?\\.)+$Lb";return
is_string($Ub)&&preg_match("(^$Ae(,\\s*$Ae)*\$)i",$Ub);}function
is_url($P){$Lb='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($Lb?\\.)+$Lb(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$P);}function
is_shortable($o){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$o["type"]);}function
count_rows($Q,$Z,$ld,$Ic){global$w;$E=" FROM ".table($Q).($Z?" WHERE ".implode(" AND ",$Z):"");return($ld&&($w=="sql"||count($Ic)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$Ic).")$E":"SELECT COUNT(*)".($ld?" FROM (SELECT 1$E GROUP BY ".implode(", ",$Ic).") x":$E));}function
slow_query($E){global$b,$hg,$m;$l=$b->database();$Zf=$b->queryTimeout();$zf=$m->slowQuery($E,$Zf);if(!$zf&&support("kill")&&is_object($i=connect())&&($l==""||$i->select_db($l))){$rd=$i->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$rd,'&token=',$hg,'\');
}, ',1000*$Zf,');
</script>
';}else$i=null;ob_flush();flush();$G=@get_key_vals(($zf?$zf:$E),$i,false);if($i){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$G;}function
get_token(){$Re=rand(1,1e6);return($Re^$_SESSION["token"]).":$Re";}function
verify_token(){list($hg,$Re)=explode(":",$_POST["token"]);return($Re^$_SESSION["token"])==$hg;}function
lzw_decompress($Ka){$Ib=256;$La=8;$Za=array();$bf=0;$cf=0;for($s=0;$s<strlen($Ka);$s++){$bf=($bf<<8)+ord($Ka[$s]);$cf+=8;if($cf>=$La){$cf-=$La;$Za[]=$bf>>$cf;$bf&=(1<<$cf)-1;$Ib++;if($Ib>>$La)$La++;}}$Hb=range("\0","\xFF");$G="";foreach($Za
as$s=>$Ya){$Tb=$Hb[$Ya];if(!isset($Tb))$Tb=$Vg.$Vg[0];$G.=$Tb;if($s)$Hb[]=$Vg.$Tb[0];$Vg=$Tb;}return$G;}function
on_help($fb,$xf=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $fb, $xf) }, onmouseout: helpMouseout});","");}function
edit_form($Q,$p,$H,$Ag){global$b,$w,$hg,$n;$Qf=$b->tableName(table_status1($Q,true));page_header(($Ag?lang(11):lang(12)),$n,array("select"=>array($Q,$Qf)),$Qf);$b->editRowPrint($Q,$p,$H,$Ag);if($H===false){echo"<p class='error'>".lang(13)."\n";return;}echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$p)echo"<p class='error'>".lang(14)."\n";else{echo"<table class='layout'>".script("qsl('table').onkeydown = editingKeydown;");foreach($p
as$A=>$o){echo"<tr><th>".$b->fieldName($o);$Cb=$_GET["set"][bracket_escape($A)];if($Cb===null){$Cb=$o["default"];if($o["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Cb,$Ue))$Cb=$Ue[1];}$Y=($H!==null?($H[$A]!=""&&$w=="sql"&&preg_match("~enum|set~",$o["type"])?(is_array($H[$A])?array_sum($H[$A]):+$H[$A]):(is_bool($H[$A])?+$H[$A]:$H[$A])):(!$Ag&&$o["auto_increment"]?"":(isset($_GET["select"])?false:$Cb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$o);$r=($_POST["save"]?(string)$_POST["function"][$A]:($Ag&&preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(!$_POST&&!$Ag&&$Y==$o["default"]&&preg_match('~^[\w.]+\(~',$Y))$r="SQL";if(preg_match("~time~",$o["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$r="now";}if($o["type"]=="uuid"&&$Y=="uuid()"){$Y="";$r="uuid";}input($o,$Y,$r);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($p){echo"<input type='submit' value='".lang(15)."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Ag?lang(16):lang(17))."' title='Ctrl+Shift+Enter'>\n",($Ag?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".lang(18)."â€¦', this); };"):"");}}echo($Ag?"<input type='submit' name='delete' value='".lang(19)."'>".confirm()."\n":($_POST||!$p?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$hg,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0„\0\n @\0´C„è\"\0`EãQ¸àÿ‡?ÀtvM'”JdÁd\\Œb0\0Ä\"™ÀfÓˆ¤îs5›ÏçÑAXPaJ“0„¥‘8„#RŠT©‘z`ˆ#.©ÇcíXÃşÈ€?À-\0¡Im? .«M¶€\0È¯(Ì‰ıÀ/(%Œ\0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1Ì‡“ÙŒŞl7œ‡B1„4vb0˜Ífs‘¼ên2BÌÑ±Ù˜Şn:‡#(¼b.\rDc)ÈÈa7E„‘¤Âl¦Ã±”èi1Ìs˜´ç-4™‡fÓ	ÈÎi7†º€´îi2\r£1¤è-ƒH²ÙôÃƒÂGF#aÔÊ;:Oó!–r0Ïãã£t~ßf':ñ”Éh„B¦'cÍ”Â:6T\rc£A¾zrcğXKŒg+—ÄZXk…Êév„ŞM7¸½Ôå‘7_Ì\"ëÏ)––öº{¾ª÷}Øã…Æ£©ÌĞ-4NÎ}:¨rf§K) b{H(Æ“Ñ”t1É)tÚ}F¦p0™•8è\\82›DŒ>®ÀN‡Cy·¾8\0æƒ«\0FÁê>¯ã(Ò3	\nú9)ƒ`vç-Ao\r¡èŠ&Šµ¨XËº¡“±»në¾ğ„¯œ¨*A\0`A„\0¡ˆq\0oCÔö=Ïƒäú\r¯²\\–¿#{öş¿ğÈŒ2©ÃR‡;0dBHL+¢H¢,Œ!oR”>œNíA°|\"¾KÉ¼í0‘Pb¼Jd^¨È‘”d²£Ğ ÷=<ª’Ê:J# Â¶£Ú®¬«aŠĞ‘‚¦>ÑTeòFìkÆjš#K6#‚9ÕET·Ë1K¼‘Å´ÀÈ+CİF×I°	(ÀğL|õÏjPø„pfúÓEuLQG­íØZ›ÁêˆØ2ŒÎ¥š2½!sk[:¢1¬kˆå½6%ŒYpkf+W[Ş·\rrˆL1ÈÌÔ\0ÒŒŠ8è=½c˜áT.€ÜØ-ìº~ –»#sOàávGö+İy¾O{ëJª9COÕî–×²|`‡+(áMÏr\r‘OÀ5\nÊ4£8÷‰(	¾-l‡Cj°2[r5yKÑyŸ)ƒÂ¬¬+AÔk¤äÍÉ¯¨2ëgß³3iÄ”ÂÜHS>–ÜWÆÖ<í®fá}ÚöÏjfMiBÏ¹Ğú84uÃL¦ÜZCI\$‰2P•\r¨øß…\"+ÿ2¸n-~Cû24ª€à:œ2çÄ,è¥:ÈÜ‘ÕgcwGÒ¨öØÇƒè¦‡ŒhÏV“Ğö] \\ºŒÃê6`ıRŒ4=#xï^†1¿£\0ÃPçÙ…Íâ:-å8ŞoŸé¾~”oïv>Æ£mØ·ØßÕùƒ'è|ĞÑëøC¸Â<èØö¶Öè:G)M&WYQQi=Òğ\\[ya\r…¿²ÖB‘eÆ\\ÂóB•Ø7Ne}:àl•©Ãk\$44rÆq}\rP®ğØALa§C5’sƒ¨m\rÁîÈ Y©Î­&°Ò(ë ú ”²\n›\$¬jE%™^qx\rÆĞï—hW’0FuR„mŒJ:—Œz@:rğj7F5,wr©Á\n' ú‰iP|>‡8´Wøfm2 9H @›\$M’\$qX¦Ô¹!ü‡\r¡”9”0Î£R¨:\"ˆŒ7DÉ Şä””r”0ÊuÄ¢ÖÜŒJê‰¼¹àFFÓ<”‘PÂYÊeòò^)	8nÖLo2EÊ”®\rÂ1ä¼¸Ë©°CfÄ,q]N\08d8b*4‚J—îˆ\\MÍº’4ÃHl€ àRÜdÌ¯!aĞJ	¡ğ.šeØ5Ë€ËÎI0Ñ’Q\nC¨µQ.n^ÄàÉ0Iü£‘†ØF¬Ğ7<R3woMÑ¦weDš¥È4¢b7+‘‹ÓF»¦á>gŠ64Jj„`Ğt!ÁF¨öªx;©ÅmãÀ¸Ìd8oè7B·j]˜=SjÀÂ¨Ö*ªê¼0A”;¸¢R–ÙĞQFD1Á¢\"OÉín“É¼€Ï¨4ÃŠ¨4e±q\nK”*;9Hóä9@ƒÕ‰#Æ¹'ì«Y‘íéSócl‰anÒ.Í¶k:h\$‡„ª9ª¸¦Öd9É\rŒÌ1‡Pä€ÛqÊƒDy%˜‹Øsba¬ÆŸ£ø¢Êœ\rÀ¶£’ZÎRH‹Œá_%\0@Sˆ„ü Ô›¹w¡€77ER³Éjw˜M¤Pô°2@\n.Àa»W~íİÛêJH,—än¸ÀJŸé`o·¡Èà@zÃµoN|¥LƒÚ¨VK ·x	uºÁ3*±qK‚ã`á]„¡–AG˜Í¦iU¹µ°aàŞÈ³‹Qre\$[W\"@b…Ä¸U¥\rŠğé=.E¿E¨\0âêˆ}rœDH\"ImÇŒïÍutÏ®GPÖP¬Ì—8Á\0p¿D ò‡;ô¦VØsˆ‹¶(¤#æÈîR†uÊ–ã\$ÇÈË–\0cÏE”æB¡\nÌg¡Ú\0004¿ó	+Ş‡™ğ2c önf!>¢ÇŸ3õ]ĞJ35|G‰tTaU ïHi'ç¥K¬­ÉZgé¼Ò	#Í‘ˆ‡iV”ÀÏ…„¸’4TWòÂ\0É\"1Åİ•Q½ÔºŠ_>“}â>Q‰qrç‚àm–Vá!<ù²d¬´‡—ƒƒŒ9S›‰,v¡¨÷'íu±æykb]p¿Ûå—Mûy•I¾œ[&ØÉì\\©„š9GvÀi¼‡±u7¸ãE«„k‰^[×%AÊa;­H#t,¦kğ[–³Xİ‘½š5Q^yÅI}Û§‚Uƒ(b\rexó%KÍéÁÉ\\Œä”Å“¬ÕÓ+!Yİ_ )òeøF`É[[nZœ‰=åwnü¤_ù\$+\$ÑÉ#F—FjÚïicÌ•l™Ÿkë¸ì·ç6[ÓY„®Ám ·ààt\rQâ±x­´W%ºAØz¥@º‡ƒ¿ƒt\r€€4\"n,Ê4ÊŞCÉfaä|³óşvaŸGäÁtÅ¼úüïÅ„ıt\$? Y9“¿ı³ÚìHt¿Îy0G¯O¬Ø(ÑÀ§şü¤•šÙ<«ØùĞG¸W¶äÜÙj³ƒ¼W½R/—á_'û \\z%>júïë{Ÿ±ïZsÁ€¹ı?ÇıøÏçå“ğ†âße³V/§@Ù0:ûhú¬€ı.ÿFÄQ£Ö4j^/g]`ú	F=nÆ&ï&&¢¢je @p° öûëÎüOnú©ö‡HÉÎX*+„5JêïÎ\nŠŒ¼ÿPë€uf&ªKZ÷OâÉO€×ÌŒöïá…PX°fÇl(øúÒú@Ú“à÷šõÀ”€öÅpH{/¬d¹K˜÷0‚ıÜP˜“¬ü€û°&ÌÂ&­|ÿ\0Î¿Pd‡&æÎÁNLËMŠÉP”ÜmË	¯üÉŠìNU*)hüEERÜí@”	 ");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:›ŒgCI¼Ü\n8œÅ3)°Ë7œ…†81ĞÊx:\nOg#)Ğêr7\n\"†è´`ø|2ÌgSi–H)N¦S‘ä§\r‡\"0¹Ä@ä)Ÿ`(\$s6O!ÓèœV/=Œ' T4æ=„˜iS˜6IO G#ÒX·VCÆs¡ Z1.Ğhp8,³[¦Häµ~Cz§Éå2¹l¾c3šÍés£‘ÙI†bâ4\néF8Tà†I˜İ©U*fz¹är0EÆÀØy¸ñfY.:æƒIŒÊ(Øc·áÎ‹!_l™í^·^(¶šN{S–“)rËqÁY“–lÙ¦3Š3Ú\n˜+G¥Óêyºí†Ëi¶ÂîxV3w³uhã^rØÀº´aÛ”ú¹cØè\r“¨ë(.ÂˆºChÒ<\r)èÑ£¡`æ7£íò43'm5Œ£È\nPÜ:2£P»ª‹q òÿÅC“}Ä«ˆúÊÁê38‹BØ0hR‰Èr(œ0¥¡b\\0ŒHr44ŒÁB!¡pÇ\$rZZË2Ü‰.Éƒ(\\5Ã|\nC(Î\"€P…ğø.ĞNÌRTÊÎ“Àæ>HN…8HPá\\¬7Jp~„Üû2%¡ĞOC¨1ã.ƒ§C8Î‡HÈò*ˆj°…á÷S(¹/¡ì¬6KUœÊ‡¡<2‰pOI„ôÕ`Ôäâ³ˆdOH Ş5-üÆ4ŒãpX25-Ò¢òÛˆ°z7£¸\"(°P \\32:]UÚèíâß…!]¸<·AÛÛ¤’ĞßiÚ°‹l\rÔ\0v²Î#J8«ÏwmíÉ¤¨<ŠÉ æü%m;p#ã`XDŒø÷iZøN0Œ•È9ø¨å Áè`…wJD¿¾2Ò9tŒ¢*øÎyìËNiIh\\9ÆÕèĞ:ƒ€æáxï­µyl*šÈˆÎæY Ü‡øê8’W³â?µŞ›3ÙğÊ!\"6å›n[¬Ê\r­*\$¶Æ§¾nzxÆ9\rì|*3×£pŞï»¶:(p\\;ÔËmz¢ü§9óĞÑÂŒü8N…Áj2½«Î\rÉHîH&Œ²(Ãz„Á7iÛk£ ‹Š¤‚c¤‹eòı§tœÌÌ2:SHóÈ Ã/)–xŞ@éåt‰ri9¥½õëœ8ÏÀËïyÒ·½°VÄ+^WÚ¦­¬kZæY—l·Ê£Œ4ÖÈÆ‹ª¶À¬‚ğ\\EÈ{î7\0¹p†€•D€„i”-TæşÚû0l°%=Á ĞËƒ9(„5ğ\n\n€n,4‡\0èa}Üƒ.°öRsï‚ª\02B\\Ûb1ŸS±\0003,ÔXPHJspåd“Kƒ CA!°2*WŸÔñÚ2\$ä+Âf^\n„1Œ´òzEƒ Iv¤\\äœ2É .*A°™”E(d±á°ÃbêÂÜ„Æ9‡‚â€ÁDh&­ª?ÄH°sQ˜2’x~nÃJ‹T2ù&ãàeRœ½™GÒQTwêİ‘»õPˆâã\\ )6¦ôâœÂòsh\\3¨\0R	À'\r+*;RğHà.“!Ñ[Í'~­%t< çpÜK#Â‘æ!ñlßÌğLeŒ³œÙ,ÄÀ®&á\$	Á½`”–CXš‰Ó†0Ö­å¼û³Ä:Méh	çÚœGäÑ!&3 D<!è23„Ã?h¤J©e Úğhá\r¡m•˜ğNi¸£´’†ÊNØHl7¡®v‚êWIå.´Á-Ó5Ö§ey\rEJ\ni*¼\$@ÚRU0,\$U¿E†¦ÔÔÂªu)@(tÎSJkáp!€~­‚àd`Ì>¯•\nÃ;#\rp9†jÉ¹Ü]&Nc(r€ˆ•TQUª½S·Ú\08n`«—y•b¤ÅLÜO5‚î,¤ò‘>‚†xââ±fä´’âØ+–\"ÑI€{kMÈ[\r%Æ[	¤eôaÔ1! èÿí³Ô®©F@«b)RŸ£72ˆî0¡\nW¨™±L²ÜœÒ®tdÕ+íÜ0wglø0n@òêÉ¢ÕiíM«ƒ\nA§M5nì\$E³×±NÛál©İŸ×ì%ª1 AÜûºú÷İkñrîiFB÷Ïùol,muNx-Í_ Ö¤C( fél\r1p[9x(i´BÒ–²ÛzQlüº8CÔ	´©XU Tb£İIİ`•p+V\0î‹Ñ;‹CbÎÀXñ+Ï’sïü]H÷Ò[ák‹x¬G*ô†]·awnú!Å6‚òâÛĞmSí¾“IŞÍKË~/Ó¥7ŞùeeNÉòªS«/;dåA†>}l~Ïê ¨%^´fçØ¢pÚœDEîÃa·‚t\nx=ÃkĞ„*dºêğT—ºüûj2ŸÉjœ\n‘ É ,˜e=‘†M84ôûÔa•j@îTÃsÔänf©İ\nî6ª\rdœ¼0ŞíôYŠ'%Ô“íŞ~	Ò¨†<ÖË–Aî‹–H¿G‚8ñ¿Îƒ\$z«ğ{¶»²u2*†àa–À>»(wŒK.bP‚{…ƒoı”Â´«zµ#ë2ö8=É8>ª¤³A,°e°À…+ìCè§xõ*ÃáÒ-b=m‡™Ÿ,‹a’Ãlzkï\$Wõ,mJiæÊ§á÷+‹èı0°[¯ÿ.RÊsKùÇäXçİZLËç2`Ì(ïCàvZ¡ÜİÀ¶è\$×¹,åD?H±ÖNxXôó)’îM¨‰\$ó,Í*\nÑ£\$<qÿÅŸh!¿¹S“âƒÀŸxsA!˜:´K¥Á}Á²“ù¬£œRşšA2k·Xp\n<÷ş¦ıëlì§Ù3¯ø¦È•VV¬}£g&Yİ!†+ó;<¸YÇóŸYE3r³Ùñ›Cío5¦Åù¢Õ³Ïkkş…ø°ÖÛ£«Ït÷’Uø…­)û[ıßÁî}ïØu´«lç¢:DŸø+Ï _oãäh140ÖáÊ0ø¯bäK˜ã¬’ öşé»lGª„#ªš©ê†¦©ì|Udæ¶IK«êÂ7à^ìà¸@º®O\0HÅğHiŠ6\r‡Û©Ü\\cg\0öãë2BÄ*eà\n€š	…zr!nWz& {H–ğ'\$X  w@Ò8ëDGr*ëÄİHVéŞw8ìJè\nm@¦OÈ#P²Ï@úYp²ÏÃ¶wàÊğÀP\r8ÀXë\$Xü Pİd–	ÀQ\0Rx1\"T]\"êĞè Í	°êQĞğàÀbR`MÛğà-àRSE8Go0 ê	æd‚B^±\0ÂÜ\":ÜmN.Şj%ß@æ3(ªx Âl ÌÅŞ	‘€W ßåŞ\nç:\r\0}®@³qm;@È-¢Ş¤Zôg.zFÂf@Ì\rW®Äck‰Œ ñ<	é0‡Ëúz'4\rñ­\0îjELYˆğ(ğ%€\nM‡ÄDÃÂoFøB¨q‘ÖKg²ä#ÄZ¨¸³àä\"\nçÀĞ®ÅêhŞÒ‹2-n§\"jy\"¥ê§èşì\"÷ğgı!,Ä*ŒTù x¢ÅËPú‚5%Làèò`¾LÖM†¬@¶ Z@ºìÊÒ`^Q0R%9&jv‘häX ğoöö‹G#æ’ö²DÙòHùKÂ¼lX¼ï¦Í-äû2hWli+æ&ÄÕs'rzìàÉ(„Òˆ‚ò¼¿%tKå6ûrâ¶ëràïáK.î¢‰Â‚*Ğ,*vbgj#²óLÈ®v®Z‹€Q\$pÜn*hòÀòvÂBñôâÀ\\FJˆX%x f\$óA4K74 a#¤¦3\n¨(|°Z,³e2äl\r|Kû0Ğò¿³¦ÎW2-m)	)‘¾Z'%€Ü	ªè7å.›*í*\0O;’®C¥*¯—\$ËA;’VÌò¸ë‚(€ÚlìØt‚Kã.DÆ›_>á:¥v¢3Ÿ=dö\$Ræ“ øSlß7ˆºB[ì!@È]à[63zS…e>sòr„Dz€í;T0²SÁ*ïCË+oª\\\0ÒÀ{D´Ükè€z@·= »¥·Dª4Vç‚Ê•*\0Wÿ³tÿäv¶¥yDÌ-¢5CŒæ3•¾…ıD´–t”›!’_ U”XL´]F÷Fn—F ì&@%b>cˆêPÜÛIö)3<’@ `ä\r“55Ş%¤/3Qœó@Gó5\rÍÄÑ±T£è,§ŞEÍNÈ&j\0ÆhÌ¾\$Üá È353‘TB'FLâÀ¦'DäñøU#±LÑÉPm*Ñ \\\r@êò@¨)íşE­ÓUUU•]V†ñïŞ`‡MµÒóRD³FV {4Õ`3U4•‹5§‚#ÃT`èQ(ğßµq7M÷*@SVMÈÄ¢#ê~ƒ2 Õ´Ñjl¤@·\\ İ.J|2“U¡\\¬º Ëv·°«\\b;^\0Û6x·Î‡]ëµ^uøîõULµZ§å—MPÖ™¬4Hû9µ\$0å3Í'VuTõ@ƒKW•|ñ/\$J*D´÷]î	X“·_pªõšŞ•Ñ¥ÄÕ²uü¤I¬Ü…zä¢®ÀÖr…Ş\n€Ò%¤8š“i^Èò»U¡15³n;I\n§R­Ÿ3§ÙQU45…5`z€ac¶­b°`qOtÙNu 6)õTÿ¯‹jµ“X–´ReÈ#ÈJ-„S@á\"U¶ëÀÎÒCÊUUß8³‘6Ø-kií/YÊ¡ R\$ğ¼!·\rn×[6Vİ­íqÕ€Ê.åÎB‘¢°¦cp­pps!\0»Ow\"çngsôX³wGiÈ{Z\0Su*k`”ÎÖa!Qo'd òx Caö ö¤cë!ƒºŞ60P°\rÊ‚‹T¯ÒœµËú¦ï¿,jÁ&ğ@Êƒ( OA€æP÷T¯jÕßGhÎ»b¶¯Ì\"%°\n‹qX€z %‚ÃÅÈÎëm~@Ï~‹r¶ÖJnWâ~ Î	¨]RXûFÖír’ÍxNmHp ñ+@Ñkl#€Û\0ËívÔX&…Ø,iÍd¥zÔÓ\0äNıø~wêü¸„×û€Ø\0äWá·ı\0ñKNÆm†	0ÍpÓíB×¥Ó'X)„`Y†e±‡XyI: Ë`dÑ t¶\nÚ('N\r€àHGuKše¨\0Ÿ€Ä*3’æ)n3Í¤ oä“Vò}vö¯ô¦æN\\°ØØèÜ1i)\".`t„>\rØÛcÈßó—fãŒoA—©\"×­±³ É OyYïFÒ\rá[5BÂo*/t“(ÅÅ%²úR[<òï8V‘“\$AMï¨¬5¨±9'*ŒX¤úö†‡ğÜ…ˆ\\†æ\"jrDÔ\re·ˆàX|ªê^©n#‚dÍ¥lÙÇn‚©¦ªM¹¦t€~\\…Í›\0™›@á›‚g=Ñ2¬À‚.†*\0@Ô'9¾—yÚ ™ß9æ dæ	£zq„6ò€]œP~\n€ Pì:‰Ù<ƒ¥œâ DY„:]5[[¢'I¢—ËFùö…º\$Bâ<“P’P—@N”0/Eú:^ DÈJw¹¥\0€_Cdz#¢zFW4(Kú{¤U[¨ı{>\0^%ĞM@XSÚ‡£ZŒSlWº™¥…wYº Ş”\"B*R` 	à¦\n…ŠàºĞQCFè*º»ˆYÌÍ§e‡Æêˆ+âH¸j™\$ÕQ À^\0Zk`îªV¦B%Â(X**2šÍºèº»®æôN`°ºê| È±„-©“ ‡í³«~8Zæ Æ‡Rz2\"È	Jî4›S~J»&tŠ¾e‚m¤Và}®ºNÖÍ³'²Úrú5f.&1ùÀ›jâğ‹§§úK¤åm¹{‰¤`º†w Ü!•^#5¥TK¥„¹Eâhq€å¦\$÷ñ®kçx|Úm¥:sDºd…zA§Ú‹?…¾ºˆ“[ğLÒÈ¬Z²Xœ®: ¹„¸[(!‡k¬X²V¹yƒ¾° ©Â“­ï\$\0C¢9ˆdSi¹in‚ {`”\n`	ÀÄ|K Â¸:ç»5ä»º# t}xĞN„÷»{»[¸)êûC£ÊFKZâj™Â€PFY–BäpFk–›0<Ú@ÊD<JE™ºi0“5Ãø®•T\"¬ãVhº¬Á”ÄNÌŒ“HùWDeSsŒ’ûNŠô\0ËxD²¸L1„ªë¬<!ÎÔ\r3ÚÍÅqd´öK3…P”ÓyÈÔë¢E/`ğƒPz€Ş–\n ùÏdYÏ¼şš½5Xïı8W•ÑI8w[7Û³`ª\n@’¨€Û»Cpš¬¨PÛÔåƒÕ=V\rıZ{*qİ\$ R”×Ö“ŠÆeqĞ¬Ä+U`ŞB¤çOf*†CÌLºMCä`_ èüü½ËµO\næTâ5Ú&C×½©@¸à\\WÅe&_X_Ü».·8œ4d YÃ¼œ‰Âp\$ezAµµ[\$]ò<]»|`,\rul\r5áqpÊdu èéˆ±ç´Œ£ö¯ÀYi@û¥çz\nâ¨Ş7ßş;“È€‚¼­½Ü7ßb'¼dmh×â@qíõChö+6.J­×W¶Éc÷e]ó‘eïkZ‚0ßåşZ_yŠè‡fØpc8&‰©æÍ‚üœz\0„EØÎÍ7º0€	ŒÓ\"ö\$êÇ=‹İìÅ!>úæ€‚g7B-QÆ/e&ßÆ‡­6a€˜p\rÄe3›cÕNIjn-Ä\$*x-WVİjõ”@oÎ#wó5óˆ'OÏ.œöÇMÇÙˆ\0èHøCÖ9ïÚÀ-míP™îƒ8S v!Àè;gtLŞ5,	ñ€#¿n# •Ş‘“x-7ùf5`Ø#\"NÓb÷¯g˜Ÿ£ö Üeübãå÷,7S§¥òGjÙíoÕ‹F?ÀTŒ6ƒİîËmÄÌs‘š€¸-§˜m6§£q‘œ;‚dl¤ÕÏé0fE€8ô]P'X\n›ÿàMGï–\0£Üx‡\0É5¢€ÂÍ*Ä#ø*à1>*]È–Ws\rœ®,¿’àÀØ\0öO–,q2Íj•+H ÃŞFG€º³E¶>d@bÑ÷±¢Iz¡aR¸à8@7¡LB¦åş‚H‚ ½è¦A¸Ë³Ép¥p@Ê	 d¨kƒz4EƒA‚	Ã‚ƒß‰ºóWA1\"À2bGk\"£\0ÀdƒhíRD¥p !fPs3`FÔ´¿e	OkLA¦Ó‘C—/ ´a@|@¦²€:!âƒ‹á˜‚»…o‰T/b¼“¡‚Èá¤lL8èˆDjÊ„öë@2ºÙüÎº€ƒìENë\"¾1ÃÈzqÂ,\\^ãÔ)8V°½qÓÁÂ1	â<í'4ÙÖÏÌÊäáC!ÎFš…´4 €f‰‡t cº†±µÂ\r¸m—z¡*M¦®(ÁƒA†¸†„÷À2Á)’Pr¬ÆŠà²ˆ¤45	 Î\0Z[dá9¨hY‡ »ˆŞt1e¯EŒ\$o`ÆX ¡gèUd\0G¨~DR<èÒhUp€y¦“=­T(‰DZ-bHÓÈ ú‘ya¢H²¯°lb¬b(œâHLÀú8e¤sC«½Ûe³I¬=Dğë{ĞĞŞú]È<ÑaâœŠQ=Tû\$!CáOÙ¾UèG²â)ª“Q¼VÃTb\".\r­Í@<)‘o¢`œV\r0q—j‹s¡Xˆ¤F\"*åbIùÚ¢|øÄAˆ hp\\	²‹X¨j#ˆbË#œ©ÅO>5w°?TóÉ¾;öÁªlò1aÖc\"t5v©Ä®Á¾`‹x\\CM=ib„¨!.¯HLÂmâH–ÛÒ¬ãñ–%+¥£ĞD4FøÚ¼Ñé£C©[KX}P¹  >e:V¡t—;ì#Ñ¦„Ä&‡Rñ©‘È´p’,aË˜ HåÆœ·ÑÎDt\0é\$qŸµñÀ/t›õ–~‡J›¥·éî`Ãö,ãº¼¶‰]ÀÎ`å%3®>Ş¢´@N­Óx1,ö¯ªùrÏxr):ğ˜8ÓäÀˆˆ 0†Ì‘ÚB«,EúAˆò‡íùåàBá0(•üÈEùã8@Œn[	(–ñåhídDÙ	HR£Q¼†^µ!± Èv<² „„‘6œÕı’Eò\"œ&ç…¸ÅV(GBü’UªËé_¦«ûHü½sÛ@Õ*BN)QH£ˆævTG‚Æ0ùhØRÙ¥Ù†+õ-Ô&TúCó?ÀÀzd\0\$¨bSÚ¡<ÆãÜ‰Q„í@º P®ÀdpOÓ>+‰>x|Ì	¡Me‰EˆùR€4 ‡k(W{´*-¨G\$ …È	'Òj\0œ‡H½ü¥¥	(ØÑ™>A%‡YêÏÀÊ´ñ6Évò«£ÇŞ^¦K• G%2ÌEdÍ”<öJ¡#ÀDE{0\$…T+ş2T%Š#&ˆŠW2Íe³ä¹\nSä§†Lã–cšdÇ—²°hÀ=–ê|e²\"' ¢[­¼óa2#%=ËuÉk©:6É,ÒüKÎ\\’âd¼È—YGr;Â·–Á=ÀØ  ²öLÉ´XyVšh*…‚ŒO *»ÍFšˆà-bK*Š#‚†‰:.<ÇRY\"EU'x3eQÁŸÚü©”’qÍ@>™bK®‰×+‹Ôo\$‚šmT´‰#å’)ÒSB¨Å¶25€»æ7šBt•[*ôPÍğ3MNœ¬&¤cst\"Ä|nGºDŞt ÁøbA¨ù†wÓ·¤1±ÖScH,4E–ïU9€®²uÃ«Š6BÅÜSà(ÁSÆ¦5QöÍô\r“ƒuUZ<°/øW“x\$à‡Ò0·9	Íª03‚œ!Wá|ğgíÍ‚r}z4Ç4\\!ë&!¢l5´ææÔüÆ<`(´zCó\\A:HaN:lŒqCß&ÔÊá`¼bn¹!Q¢L‡X¹ İ\$IğQjßÑ^Ê\0b¨ŞŒ)àf²Jš	js]GËĞÀÇ)´®Pî`'sÏB:ª„VÕêj{\nÕUĞµÅQN |SëóçÖúU²ÎÊm¤œBüê\nAY³NÎm¶ÔÚçrê‡UBÎw®€‹x§‚Ô©á»­“Óš\n|ç×9áéTHc×8ä…È9Eæ U!€LF‘ ‡M_ˆ\\4¥r)²í5êVH³âæ÷4S\";~‰uN\"éÑ‘“™”\0( ");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress('');}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo'';break;case"cross.gif":echo'';break;case"up.gif":echo'';break;case"down.gif":echo'';break;case"arrow.gif":echo'';break;}}exit;}if($_GET["script"]=="version"){$Fc=file_open_lock(get_temp_dir()."/adminer.version");if($Fc)file_write_unlock($Fc,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$h,$m,$Mb,$Rb,$Zb,$n,$Hc,$Lc,$aa,$gd,$w,$ba,$vd,$fe,$Ce,$Jf,$Pc,$hg,$lg,$U,$_g,$ca;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$aa=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$ye=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$aa);if(version_compare(PHP_VERSION,'5.2.0')>=0)$ye[]=true;call_user_func_array('session_set_cookie_params',$ye);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$sc);if(function_exists("get_magic_quotes_runtime")&&get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);$vd=array('en'=>'English','ar'=>'Ø§Ù„Ø¹Ø±Ø¨ÙŠØ©','bg'=>'Ğ‘ÑŠĞ»Ğ³Ğ°Ñ€ÑĞºĞ¸','bn'=>'à¦¬à¦¾à¦‚à¦²à¦¾','bs'=>'Bosanski','ca'=>'CatalÃ ','cs'=>'ÄŒeÅ¡tina','da'=>'Dansk','de'=>'Deutsch','el'=>'Î•Î»Î»Î·Î½Î¹ÎºÎ¬','es'=>'EspaÃ±ol','et'=>'Eesti','fa'=>'ÙØ§Ø±Ø³ÛŒ','fi'=>'Suomi','fr'=>'FranÃ§ais','gl'=>'Galego','he'=>'×¢×‘×¨×™×ª','hu'=>'Magyar','id'=>'Bahasa Indonesia','it'=>'Italiano','ja'=>'æ—¥æœ¬èª','ka'=>'áƒ¥áƒáƒ áƒ—áƒ£áƒšáƒ˜','ko'=>'í•œêµ­ì–´','lt'=>'LietuviÅ³','lv'=>'LatvieÅ¡u','ms'=>'Bahasa Melayu','nl'=>'Nederlands','no'=>'Norsk','pl'=>'Polski','pt'=>'PortuguÃªs','pt-br'=>'PortuguÃªs (Brazil)','ro'=>'Limba RomÃ¢nÄƒ','ru'=>'Ğ ÑƒÑÑĞºĞ¸Ğ¹','sk'=>'SlovenÄina','sl'=>'Slovenski','sr'=>'Ğ¡Ñ€Ğ¿ÑĞºĞ¸','sv'=>'Svenska','ta'=>'à®¤â€Œà®®à®¿à®´à¯','th'=>'à¸ à¸²à¸©à¸²à¹„à¸—à¸¢','tr'=>'TÃ¼rkÃ§e','uk'=>'Ğ£ĞºÑ€Ğ°Ñ—Ğ½ÑÑŒĞºĞ°','vi'=>'Tiáº¿ng Viá»‡t','zh'=>'ç®€ä½“ä¸­æ–‡','zh-tw'=>'ç¹é«”ä¸­æ–‡',);function
get_lang(){global$ba;return$ba;}function
lang($t,$ae=null){if(is_string($t)){$Ee=array_search($t,get_translations("en"));if($Ee!==false)$t=$Ee;}global$ba,$lg;$kg=($lg[$t]?$lg[$t]:$t);if(is_array($kg)){$Ee=($ae==1?0:($ba=='cs'||$ba=='sk'?($ae&&$ae<5?1:2):($ba=='fr'?(!$ae?0:1):($ba=='pl'?($ae%10>1&&$ae%10<5&&$ae/10%10!=1?1:2):($ba=='sl'?($ae%100==1?0:($ae%100==2?1:($ae%100==3||$ae%100==4?2:3))):($ba=='lt'?($ae%10==1&&$ae%100!=11?0:($ae%10>1&&$ae/10%10!=1?1:2)):($ba=='lv'?($ae%10==1&&$ae%100!=11?0:($ae?1:2)):($ba=='bs'||$ba=='ru'||$ba=='sr'||$ba=='uk'?($ae%10==1&&$ae%100!=11?0:($ae%10>1&&$ae%10<5&&$ae/10%10!=1?1:2)):1))))))));$kg=$kg[$Ee];}$wa=func_get_args();array_shift($wa);$Dc=str_replace("%d","%s",$kg);if($Dc!=$kg)$wa[0]=format_number($ae);return
vsprintf($Dc,$wa);}function
switch_lang(){global$ba,$vd;echo"<form action='' method='post'>\n<div id='lang'>",lang(20).": ".html_select("lang",$vd,$ba,"this.form.submit();")," <input type='submit' value='".lang(21)."' class='hidden'>\n","<input type='hidden' name='token' value='".get_token()."'>\n";echo"</div>\n</form>\n";}if(isset($_POST["lang"])&&verify_token()){cookie("adminer_lang",$_POST["lang"]);$_SESSION["lang"]=$_POST["lang"];$_SESSION["translations"]=array();redirect(remove_from_uri());}$ba="en";if(isset($vd[$_COOKIE["adminer_lang"]])){cookie("adminer_lang",$_COOKIE["adminer_lang"]);$ba=$_COOKIE["adminer_lang"];}elseif(isset($vd[$_SESSION["lang"]]))$ba=$_SESSION["lang"];else{$qa=array();preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~',str_replace("_","-",strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"])),$Id,PREG_SET_ORDER);foreach($Id
as$_)$qa[$_[1]]=(isset($_[3])?$_[3]:1);arsort($qa);foreach($qa
as$x=>$Ne){if(isset($vd[$x])){$ba=$x;break;}$x=preg_replace('~-.*~','',$x);if(!isset($qa[$x])&&isset($vd[$x])){$ba=$x;break;}}}$lg=$_SESSION["translations"];if($_SESSION["translations_version"]!=3122013118){$lg=array();$_SESSION["translations_version"]=3122013118;}function
get_translations($ud){switch($ud){case"en":$g="A9D“yÔ@s:ÀGà¡(¸ffƒ‚Š¦ã	ˆÙ:ÄS°Şa2\"1¦..L'ƒI´êm‘#Çs,†KƒšOP#IÌ@%9¥i4Èo2ÏÆó €Ë,9%ÀPÀb2£a¸àr\n2›NCÈ(Şr4™Í1CdHæe9,‡\nH(:Ebç9AÈi:‰&ëyËwç{à(³'h,@p´¨¦zMÊ52N‘ƒDöåz2Ê\ny3(+W”‘¤&3y¸ék:À¦¸\rv³c!µái¦ê~_k3‚ˆ†X¾ŒL0›ŒçSrİ­‰šégsu8åŠ9Jš(©†Ş £çitØAÀág¦œ<Ç3½œÉ((EüĞ#¯Ÿj\rè€è47CÃFÂ\r-ª| (j*œ¨Œh¦:-æ»%ãá¼m~¹%­h„µŒ#’Ê'££ê9\r`P2ãlSKó\0³ºã’)BƒçŒxŞµ\rÑêà6º#+l#Ò\"ì2á\0°¡‰Ä<´`HK+K¨òº©`PH…¡ g2†­pËŒc@è#¼€µÏƒ–·‚ÆÛ¶³R/=Æ¡l“B36µÃ¨Ä5´\0‚:/3ldÛBâœ• Ëju0¤Ì‹ÌCRR%*RÒB2Ói2|É6º·¶ÉC¶	@t&‰¡Ğ¦)BØó_\"í6…£\$ƒKOêkB¼¹IëPŸ§Ë:œŠ\"È€ZV»‹%pK”	‰ì\"\r£ÈD°\0Ì3\r‹[S5L å!è+*\rèÔ7(Û:Œc’9ŒÃ¨Ù&HnX¹DÉÏN;«Z~­ÃF7Åõ8_ÈFà¸<›…a—ë«ˆJNí3ŠÃ«FÆ‰’ìƒàç‚`É@¨É\rÃZ|3ZOë#&X¸am¤2.\0x‘Ì„CE 8aĞ^úè\\hï\nÎ3…òP^£¢“àÜ„AöĞÑ9à^0‡ÍVoAã€Ò€Œ˜Z;5¼ù»“­iBT¨é¯–o o;ÚjiÚ†¥ªjÃ¦±­kšöÁwlC–É³[pCk¶(ğ’±\"ô˜é¹n–€A@czBŒõãÖ>2<“XÍY¾ğö½ì7^ş©°Õ¦Ô>àVv3Şğ;¤Ø?ŒºZ\0å\$#ÌÑ®8ömœdXK»è@k”ƒŒ1@1ï• Ò0ŒkĞÛ³êîâ[Ïà>	¨@@PAèú˜@@\n\n\0)\$D‘e8\rA(fÔâ<ã¤gŒ¹™3oùà¡¤RŠa1&n<Áè»M›í6Ï½ø³¤æO	ñ#gÉ2—ÌOppeÆ]Ÿ`@œƒJmuå¥«*H@ƒa?«¼ÁÂpÒHBS\nAÏ;pÜä±²†ä³“	ÉI+%¤¼2ĞÚ†‹Š„F-ÿS˜	ñO`DÕÇ¿óôyË[ìpXÆ„’ A1\$'­QÅ¤iˆq7%D’(vˆÑœä7;¡ŒyO‘œgKåP—şÂ˜T=‘È\"jÀ\"<£/+`¸Ç’~âÚ×iD”é‡&àmOCyÆP”ò\rNé#Ä€‘IĞÎ˜Q	„‘¢F‚¤:'\0±¤SC40«È”“FL‘>UÇ æ\"˜I7‹\nœA•QE9æú×œ1QàhŞJ™JsOÎ7´”løcêoª³}?—]„\r\nÀW%\"k[Bssk²\r!™~˜N	tŒxÌH*…@ŒAÂÓ6…üé…2b’Œóœd¶¸õLbL]U³±ˆÍS\r	šÏv…½dÅ²òµIM£€)¦6l@\n”ĞAµ!sv`B©çªé0µÑ'iFKı|Æš‹.öc1(ÌYa…!\n¢´* (+†€ŞN	\\©VœzoL¬åOdÔ2<q¨xƒ¦\nŸdÖ¢k†Õ½¼£QT©Í|‘EÁ~”õËŸğO	tÙ²Ğglğc´†Ñà";break;case"ar":$g="ÙC¶P‚Â²†l*„\r”,&\nÙA¶í„ø(J.™„0Se\\¶\r…ŒbÙ@¶0´,\nQ,l)ÅÀ¦Âµ°¬†Aòéj_1CĞM…«e€¢S™\ng@ŸOgë¨ô’XÙDMë)˜°0Œ†cA¨Øn8Çe*y#au4¡ ´Ir*:†­ÊêÆÂÎ®‰C#·%<U[VD ˜˜œí§ª¥XT\nh¥ƒ¶“Â‡1Ãb1Yœ•±M7™–MçQ Âv2ˆ\rÆñÀäi;M†S9”æ :m§!„é±:\r;ó¡„Å»§«e\r…Æ^kÓ\\BéU»ePe2Õ©Of±ÌB3vÅêƒ¥º‚ŠzóI¸Ï†ß•·	uÉtl+‚ú/‹ˆ*Ã[f;Á\0Ê9Cxä™ˆ3œ0mˆÈ7·ÍŞ:#ná	D„09ğÈ§®+áb­)LâüÉ0jrl©«£¼	ÚÉ1¨“8…)‘bx—*º²œ+%zY¨+d B&…' •ïâäÒ¤Š©\\í=Éó¡•I¡VÌ´Ê¬ÍB!\0#¨\n‰¯Ó\\Z†¦ÑycJ,Â¾FfÄjÁ\"	ä?¡©:³=¡ËòpÊ»ëŒ„W+%G#È‰ÒŒ{¿ ”ÌTÌ–ª²nÊ\"H°È‚\n?2-ğÙA j„p¦•jlU­HóÜE*èŠvC&Œ”^Ã£åBh›K/rÄÅïdÀYŒåIU©:>WÌ1Â\\ˆÙTªğ»!ˆ<µt«%²òüI`“&Ê†T©ñÌ^¿@ÈLo}@kŠ—U­·âƒ|KFÁEu	@t&‰¡Ğ¦)CPÔ£h^-Œ8èÂ.¦‰^[\\3r?cÈ`Pˆå¹ÍÚ–ßÂPpİ–¶*`A˜æÃ(ğãÃ˜Ò7ç©ìî	\nC Ø5M`Â96#xÌ3\r¨Ë#.LØWÔTºµH\\,›B ŞÚ\r£Ü<„®z:Œc|9ŒÃ¨Ø\rƒxÎúac€9mƒÎ0¾¡\nÕckê:¸á@æ²1¾½GÓOÄÄUŒË¶©˜¨×A-øÍ˜¹óì#'7AûğÇ gÃ\$ƒ[¨ÁèD4ƒ à9‡Ax^;øpÃÕjĞœ\$3…ã(ÜÃy˜éŸùá}è¸Ï¨Îã}|´ˆp§”êlŠ¹…¥7r|A ’²CpQºÿ+IS”©™‰°Ãª'E!ÉU³ àZ‚+vØ4;‡tïóÀxO;¼gëPry9æ³·œÏš\0/E0Ú\rØmyÁÑî=æ^!QÉ\rê¬àÃ\0ÂÍˆiD¨=´ºÀÜ\nx¹.¤@Ğ’˜„ØÈ¸(	øğ>VB\\ğh6!„1½6€¹ºnáˆØ‡èÃ”*Ua„3?ôBÜ[›uníå½ Ø²rNR#a†\0ÇaXi!°9¤d~šÙ*„|’®Ä`ªWKÈ8€à¢B1ä4TÈ\"«!IjK+dM„6€ë\"«Ú8ĞÛƒto*«Dm\$ßœ´<ˆ#Ûyò¤§²b€Ba\n<åOIiA*’&Ì!Ï øroİ°sDÍÉÃ Ó“Cppq9¢„UPc\rÀ4†wx\"äq6!Œ0ºV®M	9\r@€!…0¤¥ò¦˜%ÎÉ^“C*…)/â[|•EÊ¹¹qĞ‰ñC~†IÍ•±døÏó1G€ƒ2ŠQÏé×Oè¹V‘â’^„©õ2òfHĞy5`€2•VlÑ\rĞĞåö C©¾D™†×QİœÏA¡¼¡˜ã+‘1½hD6!&\$\nøÂ€O\naP…‘m@L\\€£­&*ÓFÉñ¤›ˆ˜ÕNŸô@ƒº7WFÀ²*­mC´3+%!y(XJ\n¹–Ùr˜A\0P	@ÔÒ¹ÈƒNyxàÛ)º˜Q	€€3Jp@n]°F\nBÆS7\r	Ñ#†§tô ó`„ÖJ7&ÂÀŸ©(„B(±r10É?52¤J\r¯(„’ÙÏ’&µIºá·VÆ ¤'ék“E»\$¥î¦å@ŠK&a: Ø\nê ia­› ×l£İ9”pÂ†ÌÛ!Ñ3ÖX6ºTA8\\(U\nƒ†dëéiö·¨ÉQùâ!~õøªó&HîYl[÷”ş€PM¼·ÔËŠâ|kI@(råd¥{nŸ!=\\7V‹p@\\R\0ˆ…¥¼=9\" 	ş×t\0LÂ`o±aµ	!¤,±ËÇ{DĞ¢’™†ÂR²”£èğ‘ó@–2é¹ê©ø <Â˜e7qVT—t+°ê¥ÅD“-›€´UğØo²½©#Pñ4ÁùÆŠelÉŠmºd";break;case"bg":$g="ĞP´\r›EÑ@4°!Awh Z(&‚Ô~\n‹†faÌĞNÅ`Ñ‚şDˆ…4ĞÕü\"Ğ]4\r;Ae2”­a°µ€¢„œ.aÂèúrpº’@×“ˆ|.W.X4òå«FPµ”Ìâ“Ø\$ªhRàsÉÜÊ}@¨Ğ—pÙĞ”æB¢4”sE²Î¢7fŠ&EŠ, Ói•X\nFC1 Ôl7còØMEo)_G×ÒèÎ_<‡GÒRõ¥zo:’Ê¢uF‚Æ°C×ôëEa³l*:í“E\r¸¨,Z\"(¸¨NtV´Ã	Q…­v›mÄ÷Y¥_a·®Ş—ZŠË9:xn^¹Ù×S¦İI¿CÃYŸVõµşFÿÀ°¸¥çnB>ı*/â\"†—	ò¬8‰ƒ|×‘ïûö×0\"Êì–Pt9îQ L*MZ½°Ñ*©%åÒ?2ís6@B¨Ü5Ãxî7(ä9\rã’ˆ\"# Â1#˜ÊƒxÊ9„ˆè£€áÉc„‚9ñÈÈ¸¨ÎÉvÛ\$H“KQ\$B\\¶\rAzê&.ËPÍP2p©¥D”¹{t-ËŠæ´«êãNš<+Úî¿*¬ÖA¹îâ^ËÂˆª>SÃy`’‰”îˆ&©›ühR©»²ä&¨[fhal™#äšÀì©j©Î6Èû…(í„V“íU_9µÎB(¬uÅ,„Ì4™ I\$*¼ZBÍJ£Vµm¼Bè¶2Ø¯«j‰£\"×-(˜ÛÏÂ­£î\"?jˆZwxj”Ká\0’+¢²õ¢MºE\r+¤€5W»äßUÓQÔâÁ2PÉº×.ÊbËC6 Š£Ò6#äõ¸hK¿\\3rfšß(O/ªêqj\\‰d0¥¥ošª«ËÌ»)KWìÀ]qÜ°êÛíµ’³Qi.c ÔJ%ğ®ØÔNT•&°€” P¶®³Ûº·æÈÒÙ††+•LY›Ş²aouDƒHç’ÜG1¨İ¼oRFû½Œ£Àè2Ã˜Ò7ñ+Š£/ûf6ƒ“—‰§Ô4ÖŸÏ¦‚„^ñ×³Ö»ÅÜ;e;;I>ÖböÃ0†©oS=œº)“gs¢ìÀN;Ë¦0]F.«İêƒ2æÎ/3×“ÅÊ±[h:·¡í]b˜°)İƒ0®ö‰Û¤ı×Š×÷Ñ\$ı¥õ>'yòxõÿ’˜yh|ç{KFã®1Céó'5²ØOù©w%8¢@ĞQzHÍô:¸ ÜÁ\0A´4†äl—CŒqA‘\0xA\0hA”3ĞD tÌğ^á€.0N\n£`\\C8/q\0½\"·ğèâÃp/@ú£Ø*Áà/ ùÇô¥ÍA*m˜© vö’Ò\\!¤İù!×Ü®Ú.*©IBx¥É13X‰ö-’&XÿÉÊ6L,è=!\$„Ğ¢BÈ]¼2†YCˆu\\+‡q1!à|é‘I\"@é–\$Ä´ğ’\rÂ®YoóÓˆO„ye@'ö„À^È¡›6ä.:¬'RÀHAÍTì]K–EğRH‚»:†¸öÉæ˜^Œª’e\\¬ÀPĞÃc‡î0v>\0bHaÁ@°äC*Ş!™Ã‡\$˜ÃGa˜:Í\0ØÃ<™¡¤:€A;Rw›\0€1Â88¡øa\rÌîC¾›Œ±V5éÍQ0ÒB@ÓIïMŒÚW‹GD©Ïr¾<!@\$\n\0‡S‰¬TFØ‚Ü\nKÌp4õP’¢ˆÜd™Qw†ğ@iÌ|2†y³KÒ‚HnÉ\$7¤¹õ9Ã¼ÙQEaÇ3J¨¨b,\nõ2—VLP+q%-D@dléÜ iJp‚	Õ<*ğnÕ(¥4ª–ğw\r¤1Îè(áDÑHu€1†jr4`ŸQ‘K”i3\$6*M#³jx§4¦’(¿Tb“N2©•ä9ÄVsB[NÆUİ›ÕŠ*µhå)ëÑ¹Bkl¡‹b(\$æÄ¨ù±)dºˆôº`Í9ôPh¶ÏÂ>\$sİ/NiÙ&€KÍ‘ñMä1óÆUk‹\0·‚2»óÀ§Š¥•>F]Ê†kÏ³ùfM¨WùXu±uì›‡dJ¥ór84¬÷¯oÛ:iÂ©JÉJ—®M¸6&½–<†ö`ÙùQ‹—:Á\\r¸iS‘`8Ä¼ö¥‚¼©ïÃqº!KZ\$jµ, €)…˜YË¡k&†²é`©E®dŸ{‰x¥Êv\r@î;›Mª—'HaHú#‹«i3•µ¾øbŒ^V¸ä&Lö¹®w)¬ùÙ÷±“]vD6á½Ú„ì²“ñÌ`Æ3¿…ºµòPM¬êØİf¦g³+Cf¸\rlæ¦˜,ZV`ÍÍ¬g.);•\r€¬¾œ’b´Ïx²s*ÙÏ‹¼VäãL“ôrã*Ç±)SÖ)72èÛËÍ%/ÜÈ \n¡P#Ğqa^8Q¬\\¢3S¯‘ò45(¯-°Œä·¾wÏ-2Òcmk0j¡ {Ä‘ÜP+Ú˜a—Ñ	›M“ƒyx0s(bğêÅÖ¢ßD°NÅøÌ\0aé/g¡—k“Š‚Ó«/gÅx‡ì§ÚxAæANHÛ+­tfÕiÁßì>~V`Tûõ·´ÍŸã}ıNˆYSp¦(jUAkS´xºÀˆS(`±7‚§fMÒÜÕÉÌZ4N:ÜwU¨Ø|Mó³Fö\rDe!ğkAËñ«dkÕÒ53£(¯S¹š(İ3{½úôÙÖèû+#†Ã¥©Ú’¯}¼H";break;case"bn":$g="àS! \n¨¢\0¿@°xJš¦_ÀÎ:6\0šƒÀƒğP”\\33`¨®\0¾€!à(l	MS,¢ˆ¸†S,\$ğÕÄ]‹)•°d5s @qD<6(R©\$Šiìæ’¦VIà\nxÊ™+\rBÁbˆôÎ\0¦®©!²e4¡M*˜Ï+Vøp@%9…Õ;eºá2S'ë«	½š`€Ob±«M^‹bSÜ%UP²H§´)ëŠx2S‚)äÊzÊ†§Ÿ©Õõ4µÏ\0¿©èh3ªôQ©éh*ú\$m€m'í¤Fs\r®U”Ê:œ-O4ÃÀ0YìBWN¹äêX›.._s´C¤õ:ª\n¼çİ`¼Ü2¢åÀåB,_Ğ(²o:ˆ\r±”@7\rá\0à9\r#°Ò6£8Ê9„¤: Â:?Ã Ğ4Áƒ Â1AÛ¸S<ÎSœ –èFÂªÅ:È‡<ˆBá*ñ+—'QR\n†‘î©÷µ*\n`·<*zŒ>\r{Î€ŠbŞ>D[8(Tc š˜6ŠÌR ”ˆ¡\0÷Ä/C NJ¬SÉÂ›ø4Ã:¦ÔÅj[\"µ©‰ZÆõ \náÍÊ¯&KMûˆ\n£p×\0ãp@2CŞ9/b\$'\rŒ#›ü2\rğ[ş7‰ 8QôèáJc½2CÍ«Òè”ÑÌÌÁ-±Ä¤ï*®šà‡¢l:ğ†·R:°ß.l\$¥3¬L¢Jìºò‰M&I.¡M9>®ã¼é¶jé'Ä-k½&O¬càâ µe_Äå|^OÏ£æâ ê›:¸VÏ`ªäª§2[kš~ëÒê!'Ç¨À…*kõ[ó«u§ÍŠæªŞE=av;Å\n¦ÀéLğª*å*µ‰KÈn1Eœ»U’Óä#.,hèÉ^YænªüéCíLB\\CÌ@\0PHÁ i¤†-c\r“Š›Ğ¦Önƒİi(8ôš¦IëtÉ­¹ñiN@,«kØï\\\\ñ¾n4j ËKt‰'Dºº8Zî²IZ§YÎqtåh¡?lHùDGo8ØÎP™l8àP.rvp†®\rNú˜…µáL®¹ò›£^vu p*9¾rºÜÖHYs¥7?;\"\$·t«s;ÓØQMf®]VÜ/X\$Bhš\nb˜:Ãh\\-^ÈÔ.ªw÷\0İ»æß)bq‘`P‰CpBïQôXİö¿Õßã]Œ£Ä(7cHŞÿJş-É3'ĞØ‘ö?\0€0‡#üÃ0f\r‰°2ª’ªÅ\n\nzPnáŒ\0ÁÌ\n\n½\0†ĞÂƒÈ ¯ğ:†0Æ‚Ã˜f¡°ÀŞÓ`sˆ49BÂÃ\nl	Ë†ÔØP (`¦,rbK™¥j‘=Û]û¨d©:™@¨~Ô2ÏÄ:¿ÔÚdˆÁ¹FC°ÆÿßèdQ€€õƒ0=A :@àÁĞ/áŞBàÃ ¢Qáœ†PÜÔÃóúG‚ }\$Pšlàğ†}Vr¹]ç†»'„’O€¦!¤MgwQ)ØRĞ‡qYò0¸©Uº4NçˆÊÕ*…’TŠ˜937òLUÒ;ˆñ£ä~\nBy\r\"#dŠR2GH×õ#Ÿëÿàˆ¼à’C‚\r²8:IÉ<ûÁëBÁ½™ éâCYş\r*‰FBhØ£b.‰s%²\0Öš»UKU~,Ét¬e¢ä•†í)EàĞƒc’oüt\rş\n21‡)ÖÌÃf˜\nzCe\r!´8QTy Ú.HƒëeNÀÒC`sU'9«.7B•±óW.ùğ—æÏQB€H\nñŠf´q‹Q\0UÕZ°¥pÁAxwG|ø1&’ØüYa…ĞÊ7ÿ(ÔšA¨ T‚C+3TÈ: Ä0¦Ôí@†ÁŞ¼ª“Nèğbz1WXT¢úŒŸH2;5GâŠBÓè7‘0ƒš¥Tôu†0Ñ<CHg€‚ÓcüÃe‚¥L°«ñN\"\nØ aL)btÎƒ‚XµdSÊª¾ÕòƒËâX—xål}´2¬ÔÃV¢ür›U©H‡ê«q+et¯¡õ²ŸÉÙ\0¶«øãTsh+¥ÒssÒÆ.ÜKjgQ[¡†üĞ¢óB§½æÜS’‚rnSç—dÊ’B`Xd\r,Í\0)Õ,§ªA88‡T§C2\r±¢lG;6¢ƒ6RÔÚ¿ª4ªVÒ+1ëP¤€@xS\n„7Ÿ'cñás¬÷™Y¢BºlˆÕñxšÚµ¦ã€S1-6ÆĞ4ÊCÛqW34\rš`2ÎUğFJGæØ(¤!\r¤<µ–¤0¢\0f®àG`Œ*œ'fa¦t*‡ˆ1\"Q‡õH8B\0Ë‚Zeæ1JYv´¢Î0ú-T•Ÿ}t0¦ÑWE¯ÒÇ+àkƒ©‡éEŞ.˜:®–è¢®ÉÑYUgÆù08”Æ™pUÅT­0åÙáf‹óM²í_§ØhŠÁ•dO¥–€\np 6¼RCkr;j‡«œñ¤3B™ö^Â6s\r±•NÚØ„B F áùFü\$›KŞÀ0\$1®Â íu‘gõÌì“¡UkRf6š›]ØÈ¸unú¹'¿ş\0wx˜l¦‡ƒ•~®xf¼Ú«}¬íš\\[jQ;×ˆS7:Éâµ¨èÈW\0 ›¸÷+g¡‹ï^PÂÜ.WK× ä—Ïf»Å¿G5½÷°œ“iKUUJ9l×Ìëàg½	ôÊõË´Qr(+¿Â°]Ñ	¿4†Õ¥Ô˜\nírM0ì½¦Š»½I÷„‰0¡oÑQ÷åEÄí'á™—YBı×x£â¹…;?AL2 Š5^yÒvUi;¥ÕÎ\ràÎ“ãf„=-ÉÜ„S{Éü†ã\0Ô0_¦a^¡®ø¾·äMòOKNŞ'œÿ!àeJë¾) ";break;case"bs":$g="D0ˆ\r†‘Ìèe‚šLçS‘¸Ò?	EÃ34S6MÆ¨AÂt7ÁÍpˆtp@u9œ¦Ãx¸N0šÆV\"d7Æódpİ™ÀØˆÓLüAH¡a)Ì….€RL¦¸	ºp7Áæ£L¸X\nFC1 Ôl7AG‘„ôn7‚ç(UÂlîf“œ:†k‚\r5ƒ±¤B2„C	ŠVa—OFÓLûU6™Nì>\$@r2ÎÙ\0QdŞu31ÀAl4áM†S9”ç‹7ÉÎˆAĞÑ|Åãvrâ™††uÑš¢üdo\"b ‚OàÚ¸\$2h‘2ÆÌ¼¾?'¡'ÊG3pCœ8dš!û|\\)¸Î\nÉ®ŒU•‰4šï7¸6\\Ü5®¸Ü£ä¹ªû0hèŞÛ5©\n\n:\nÀä:5ğ`æ;®c\"\\&§ƒHÚ\roãƒ„:4\rã#[1¨)°J¥¦i«^¬¤\nâ\\**h3¹Jˆë ƒ²è3,:ì†®\"k@b—Ã#Œ£{2:Ir°ªĞ„‹bæ?k¢ú4¯íÌDí‰‰ÊŠªB„ºÑB¢Ú5(Í€ÔÕÊÂpŞÑ ±ŒàÅÃb:4 AC\rLeBĞóü¬J°¡pHÓAŠ]93KhÏ+CJXã\"98®nºc+­¨pÇ+#XÆÊÊÌ“°Â(ØGo£	ã\"_%ƒ´âº%ƒÓ(\rï¢î®\"1t,:Æi]€¬XJZ®¬£,`]GÇc•°„[V	CmB°ò£ã-ÇEZöÍuE	5ßp¥ Pæ0ØÂ@	¢ht)Š`PÉ\r£h\\-8ˆò.²#ÕvºGjBF‹ã„„)±`å'ãg6ëQ8Ü9#~^—	‹â\r’ãJÓ„AÃ2«8*f9X•Tù:íÈÚ)>^:Œcl9ŒÃ¨Ø\rã:Š9…ŒXå¨Œ5Šè@tS(7¨8P9…)pª”Œ¯¢Ïm~Õ?í¸Í•%\n(Î#&×ì#e˜=x€\r\0Ì„C@è:˜t…ã¿<`8ä.c8^ì…éÂ~ÁfAxDuHÿã|—\nÃ\r¤‚¶ÕÄR„fÊš3°ÏN¥Ùo®	Ü?@°Èç\rÃ¹`à4´ğAÇµ<—)Ës×9Ïı¢À½ åÓu.ZìæhD¦‡ÂHÚ86lÈÜ:v¶W-kpy#:`•&UŸº.kÅÖºI¨i0Ld9@Öj³¼fq½€Âİbê™­˜ã^[ü4,ô3vF»Z«Wk-l–5èEƒA‹\r!™@Ş©Ù0EÜ9’ãb‰ÁH)À'SBŠßñXU*èr@P(èµ#2Jƒˆ2#D¸!³\"­ÿ6ÈÚB´,\r¹À.`»’ÀîhIpN¦*”N‰âòN°íŸœJ`ûÀ@fúEÚó€rEÁÜß†8re;–QföÃğÂJ\$z‚øô@†ÂFDˆµ`'%Áƒ\$y	üÜÂÚTù içĞì»øÙƒO\r„9E¤H· 	éÙ\r0ä¬Ó Dg ô¨vAO,òX¢èæïr.7Ç\0ĞêmÀf@èÂº(u/C,A°èàË •A?\$(ğ¦Ì]X€¶¢‚<A`9\\EJ.ÑÉ6Q¤!%KàA¥XnÄ(†AöbUŠ;Ô*fÖ#VvjšB„±€3ÕB\0S\n!0Q¶NaHF\n‘h\"äEà5nğ94sˆ ˆ	&\r!èù1âQÍZ3©FN'ªEêC+\$Ò\"^UutÃµRƒÉP†=B4d%`€KµÖBè¬W•iPD“;¡}YUŠıip6°Ö@ÃZ/TóÑt1jYá;2àeLB%½„Íœ*…@ŒAÃ\$qRÄ÷åõeôÔ¡¹y¢ç«!ÍE¢”•=r=U%hI£_±ê\0@ò@j[¨ŒÆàØO“'Çl7Ïb< êi4\\ÃXšªa‹Òf‚dÌ=A‹qU	ñ¨OôQ%šW@PU(pI>\"0Ô´E\r1‰ÂñDbCmXV)Y}Ñdö‚Y3æ%­ÀèµoØdµ±?š%rÅ‘.!•Öc”d‰Øz¼8EeªìA(`t€F¢Ş˜öUÙAHĞ© kv1f";break;case"ca":$g="E9j˜€æe3NCğP”\\33AD“iÀŞs9šLFÃ(€Âd5MÇC	È@e6Æ“¡àÊr‰†´Òdš`gƒI¶hp—›L§9¡’Q*–K¤Ì5LŒ œÈS,¦W-—ˆ\rÆù<òe4&\"ÀPÀb2£a¸àr\n1e€£yÈÒg4›Œ&ÀQPÒp:Ó£¦Á>ë%4‚‰ÕÃA¤@hšÌ'êl0Õ’ÃLİ9X¬f;  Ée47ˆ†bY7qæ´v¶ 8]Æ˜á‡•®Nƒ¤té‚É#fY‰‡çQè<'E'ÍÉ\$`®ŒÓyĞuèıVğËÛ)í/&pQO…v¡Xby³|øU:o%‡¬éTÜ5«c¸Ü“C’êæŒ.PÂƒ„ Şß«c¢á\"Ã”\$8Ac˜îºŒ‰ˆ¦Ç0-Ã0:…\0êüÚh‘(¬~2+>4ìú 9ªŠ²’¬I¤`4«ë\nb!£ï:†Ò\r£B9»K¼Ç®¬è„¼±\0P°’è2¾£(è»3¢+²ºÉk\n9°ë°!Æ²üó,è’7\r#Òš32†Œ˜e›Û=3ëp Œ#sÎ:4’P2¨NØJ2òâ4}#IÈãÌ­A j„@Íi{\$&ƒ‹6 ã°Ş”ƒ`Ş1Bxä£/I‘†V¦Ô@‚1ÎÓìşX¥s6@£-bKæe:Vp £ª*âÚiE;F²`Š77lè¦´ï=Ã	RÃêĞÙc(ÇfÙó¨\\Ül„sN÷E!uY1\rwVu¡U“:\$	Ğš&‡B˜¦ƒ ^6¡x¶0ã»aİÖâõÈ²`‰ .\\n.©:õ“*9BM–Æ’3n¦\"dR¯Éƒd¾6\r’Jã0ÍĞĞò^İÁÃ“¸¡İCu\rw³¢ Ş®'Ãpó3ã­=ŒÌ¸AY/üK/êãÎ0¯.œK&ÃtN2…˜Ræé‘­PWãC¨&\"¥ì5 £6RÀ½a\0‚2m©|K¦£*2L&ƒCB3¡Ğ:ƒ€æáxïÏ…Èÿ˜.£8^ó…ğrôüÆ¡xDuPKÖã}š¦ˆ:1@–mšº8\r80é±®¸û½hNã[CkÈ&Án*M#İoßø#,:r'ÊòüÏ7Îóã¿CÄ/)x]ÒôãwO¼ùŸÜ*!ò(8#”héÚvÙ:„qÃzP0†²:Krjª!—°@ªˆéC?\$\$Ç0ÅA0ˆ„§»§äÁñ+½c\0îo	Hb#°YÁ@§´Gƒ3ÒBmlŒ5Õ`Û&% Ê†‚:Q\n¨4*àü—¶‘£1~.ğÒóLdLš\rEÄ%#5º€H\nM\n’BŒAAAQ(5 dèrÒv]Çä7s€n\rÑ¼!¾.T€Vƒz/jÈ;½¤‡Ï:vˆÍ¨;4SÛì>4'L‚»”0à:8òDÀ!t2õ”€w1¡`ÎåÔ‰Æ‡Æ 0˜˜_C|@a)… !\$17À©'ŒÊ—	&(ğ´6™s‡—!4C*¾r¶’dY:ğ6Å)HEQÀ NaŒĞ¿¢hTIˆI\"!äØÆE „SĞn€G  @IR™®ÑÃÓÎj’8ñİæjoÉÄ_‹<)…BŸP>#Ğ3°c?,Â“Ú§\\æBÊTÔQŠ<W³	²-5Ô•–°]ìØg“tÉ 3„¬ˆùR%Ü0¢\nA„`©Ô*'±té¡ Í:“Ğr6¤ÀöÌ¸| A„Qoê`xFZ*BU)üÀÊŠiÏ/\$•LÔµH—©9€!¤•™%ôIê©#^u†€Ö:Ê‚J‚«Ä‚c~H\0CKá°†4RéUx£*Éé•Û[“©%ªÈ˜„häML\n…M¨P¨h8eK¨ÍÆÚšwˆ©u«uÆr„€—Îbô˜(Ú*à¥]§IsfĞ»¶LAÖ#\$­|šc0óëpyb\r0óÄ@BLÃIhÎtPŠšı]\rÊÄ0Œ1N™®e \$ÖÄ\"Lg:°h™úSaäYÄ3¡2óYÓØÂ¹'%ƒJ€ée¥Mé¤ËaiheRªBØà˜×ùÅ‰­Y+Š\"êr´(XÎ„5LQh|ï¡¦VRĞÒû‡LíÃÉˆÎĞĞW t";break;case"cs":$g="O8Œ'c!Ô~\n‹†faÌN2œ\ræC2i6á¦Q¸Âh90Ô'Hi¼êb7œ…À¢i„ği6È†æ´A;Í†Y¢„@v2›\r&³yÎHs“JGQª8%9¥e:L¦:e2ËèÇZt¬@\nFC1 Ôl7APèÉ4TÚØªùÍ¾j\n*±WÆ“±„éA9šØj‘Ğòp<‚˜«ÙÛt0˜¦ÃYæVU€ÀÍ'@QZ3zÍâ±Šp‚-ÊÊâpßlPÌDÜÒle2fÍ÷Ù!Ğêtd2YC®_?{Îxù±†no5À˜ˆİİú~ ÜfÌ&3Mã—\$ç»â¡±Š¡»•MfÌlŠ6\n)›L'«ğ(•ó<šó§“8ˆIëXcCø0¥b\"üÈ­¨àÜˆ¢h’–§@Ê9£)X 9(©¨Úç­\0Ô¿©­ÀÜ¦Aˆ7mØÊ5„\n‚¦ªNÂ´ß+¬Q02 ô1Œ QˆF&°ÀÂAMô>ç:c\n!\r)èäÛ>	©ŠRB8Ê7±àä4È\"+ràKÃ@Ş( P‘£ P ‹\r#CØPn`ç Šƒ’úö0ƒ„á9\$O:x»‰ÍÛÜ‰8ã\\Œ\0Ä0Ä`MGR5%FÑñæ#pŞAàPHÁ iR†/ÜäÜ>£XÉ§Kãà2¢ÃÆ	‰ƒB rö8o¨Š¾HÀ'Õãšj6/ÓLŞL·khÎYöXßXöM˜ÎCÈØ\"sbD7F4hËb(À\\Û£`óp[WßIÜö-İuİ¨ÕÃ\\hÕét#šV¿˜„|Ô\$Bhš\nb˜2Ãh\\-X¨ä.×ö\nHŠ2\0P´0ÑKÔH¨*éCœ‘\$8=<òµ ÛF#Kj˜Ë\0Œ#k”Ì¢RŒ×Ã2…æÓĞË2ÙèĞÚ¥j„ó„m<4#HÖ:kÀ›ÏóÛ\0õ«çì*5\0·qCI²‹~â:nŸjV¾ªèkÖ«®Ğ%\rVì;±8<;mW.£·0×^ä4ê®¨çì›Ö¸‹éZúkÀìœ&ÏÃñ;g•é:öı˜ #xÄÚNHĞìç´í&¯¦¬®Äç\"Qš„É¶Áê^Â9É\0Ê3¡Ğ:–\0t…ã¿¤VŞ%#8^1axÈ7£Ã Óğá}?\"ã˜àÚDc(xŒ!ò:ğ˜eêr5fÃœëğ'ì8ä –ca}	ÅftHÉºYBµ¶‡†–Ú(ÈUf\"jäĞ²F¤\0 €@ñ¨rxï%å¼ĞæóŞ‹Óz©Eë½—¶÷JÉ\rÏì7>R ‚Hmí.†äp_ß{ñj(ğ‰”Â ØLŠï‡eøŒ¢ŒLƒ+ù†%.@Ü\\‹Xw‰ú’BpN”©%jñ (àê«â¡@Uäxç‚†.ŸQ´<åÁÀ72éİägá¨šÖÚåà!'T1¡àÓ…Ñ\rA¤•˜³[-¤Y¿öşy\n)¾`½HóØxdBGV> P@@PDôI6^ïAP(i8 Ô¡…0F¾€Êå#õ¤¤:4>ƒİA»Œ\nxÕ#'ã´eöB“hß\"¢ŠnC‰>!ğÚ\\ËÑ‹‚ô:6Â‰N¹ô\"‘Ñ\n¦Â8—CÓGAZ%‡HúÙƒY<)… ŒÈV‚„¢@ÌJCi“P\"eÃ6’V»\\º/C‡N}\"^k	›¼‹äî{‘*)‰Ñ5 h;˜GLCèÉ77…›,2p¤H½+b‹Ê¹HÅ\nP;ç¬@›	FùÂ”bC.Z»·ÒP¿ËA2²Ü>(P÷\0Â¡äAt¨\$HÇrdÁê’Òt*DÔñ¾EO€3ÎNfæ·ÅIY‰+\nÅÁĞ@ÂˆL\$¤œ«Mñ_8Q!\$ŠĞß5A\0F\n’¨ç\$p\råglDq;´b–†‰Ğo/J)G-ãœÏz\\sÌ(ZFsƒ¦9µØ:†„¥Á´\n\$0²Kb³	ùÇ'“Îˆ²„l¢³ŠµB…œ1%Ø·—}Æ/†ÌÚ¯5rîi–¹äep+§—õ×-¤zÃ°†lg¬¡İKî)­:e°×f'Ğ*@DéiS6Œì\"5¡0-GEÓ®`…›ßËŞP¨h8¡ëxYi‰nnUãg+âèaXu…ğ\\¹ºÍ‹\r3¬9w0°r³÷ÜËÈÀ§¡\"¤^î@ŠJ°±Â2m]_ĞÜhS¹[“fĞÎ‡£ ¶©™Æ„%‘Ëù¡…0nªğŞa‘\"D„ME\"œ’@²Xt5A„é¤V7m¤•Zc¡;2Òjrw>¡q¨¢ÖQIÙv (!”êOßª7¼„(×b«ÃZ—4Õ=Ù¡ÃZ›	ìâŠ\0ÈË‡XAâË€¨s§B°yUls5\ndqÙ\"@ (*jƒ(‘Æ(˜5\nl%¾ĞN­…²\"uNÅd";break;case"da":$g="E9‡QÌÒk5™NCğP”\\33AAD³©¸ÜeAá\"©ÀØo0™#cI°\\\n&˜MpciÔÚ :IM’¤Js:0×#‘”ØsŒB„S™\nNF’™MÂ,¬Ó8…P£FY8€0Œ†cA¨Øn8‚†óh(Şr4™Í&ã	°B9Lğ£¡äá\nM×:YĞÂbŸ!Rr‘”Éi¼^Œ‡6˜éy½Ò„,l#\n\"A\r¦Ş\n=:LLæŒ5\nblN‚i¸É=R¢óş•'#™l»™y¼Î 3YÎ˜ÌvO\rˆ´^Á[Áú3®âjÍØÚ‡/tm¼ğXò™Àå¾·ÜLà¢©¸Ön7ép®ùÊNDÕ_Ì4¼Êsz5g8éÃ„˜æ;¬ã\"N¸.A\0ì¥\r‹Jp¦)c\n\"’0Mr| Mšˆ£©*ZIi8¦:'¬ˆ'%ÎÀäÌ5C{šß¦#\"Şµ±±Xœ2ƒ´j5ºË\$p´L+¹¹/\"-ƒ°Ü‰é\n	r×\nS6‹ÍZ>µIbpòÕ·Hº2¾2!,É3&£˜5 R.5A l„ @ P¦<c@ì³k#HŸ»ğ&\r#hÒÇ‰àÉ¹B³6<b(ZÍ¤ PŒ9N\"¥ŸB³41£3¸¥FSR™N5\n\\:ÓLÈİ)ºVV“ê	@t&‰¡Ğ¦)C ^—‹fKgZ(»RÒíøÈø³\nzşÁ(oÂÏ[hÂˆæ 7Ê<&£r7İI=¨EcdH#z0¶xÌ3RŠ¤ü…Aq\\¢ß±¨7ÅÒ¸ò]C¨Æ1¾ã˜Ì:µÚÖ9…‰€å…Œ#=r¥­jÉG\rÃªjaMÜçBPS<²Õè¨43‰[o¨2ö#&H…c#Øƒ\$Hx0„Bz3¡ĞĞ˜t…ã¾¬\$9ûÜ³Œáz”Œ—cT4İxDl+bb½‡xÂDXÉ,)ˆ\n6'LV„\\7A£<)£+âN”Şh×&Œ°,qº£”óÁ¤ézn:j:««ë+[®kÃv½t)W_L(ğ’6£ÍÒ”š[nßÂÆ‘f÷+ğà -P@3§M‚DÕ®ã”¯Ùî#ŸT‚¿¯øæ5­°TjŒ{ÁKÇ´é>fŒ#cvºe2£O€ìL—ièaø'Š·ÙÌ:\r	ƒH‚Œ.À@Éé\"K!¤¶¢ _ˆv\r\$ˆŸ†Xd™k¼\"­œ£BiA\0P	@°XÀ ¹Nñ1‘p+ø!®Â.ø‹Z0EÇx4À£\\Ó!şGŒŸƒôjCaæ“…PÎCbC#	lç¦@ŞGƒÈs\rĞÄË½ó`SÍI@,@ç¿¢0ZÃƒ&@	\$ÈÃ@ioåG3V`\"óÿ,åDhÍXC\naH#ÒÆBJ[|71Lè*Çzvs‡%D°—”²õC1>‰\$Ù†öôàoŠ¿¸†ËÉ+Ø@³òÏÜ†`‡ê}ÍXf;ä½µ¨¼RÃ>’¬ü ç\"™°P	áL*#âä\$±\n“•Z„ÃŠm5¡’\"µËñLˆ%\nNARvO`k [®)v@ÎUãK¼‚=B–GHù!(%,œ-ğ¦B`-Bˆ*\0Œ‚/#.ÁE<c%,šB`&ÜPÚEÓ{(àš«ÚD&@p›F‹PğÊ¹¨“ÂJdW&Ò³ Pr!*Ñ[*ò.@C…(\r4©Ê\0 †‰`+\rh45 œîĞ¦ŒÁ¥Şš“VkMy€Hq\nW¨j*WT*`qƒ(g<É6ÒDÈe1–r\n6;G)Kk– %J‚Cº8IÂYœ#5Š ©‚0_ŒÛIcCâzƒ1m€D‰ “æÆ»Ä9…Ø¤ˆT¥=xÖBš’lH±³ª&“˜¦ğ)Â*©KbÏC³àsD:¡ Ÿ‚z‘ªG	ŒÉ™RZ-±x\nÅ´3˜ğ–GÒXE%u”¼Ö×hŸ¤äØi¼dV\r©n\nSÉ×Êı]Ë°e";break;case"de":$g="S4›Œ‚”@s4˜ÍSü%ÌĞpQ ß\n6L†Sp€ìo‘'C)¤@f2š\r†s)Î0a–…À¢i„ği6˜M‚ddêb’\$RCIœäÃ[0ÓğcIÌè œÈS:–y7§a”ót\$Ğt™ˆCˆÈf4†ãÈ(Øe†‰ç*,t\n!G§CÔ26f€ÖT¡äáä¦è1PÂb2›-ó+Á”ÂrÈd†àQfa¯&8œ\\ªn9°Ô—Ã,Î\n 4cã‚^”@R2Â¤‚Á’´sÆì²PcÑÔ@a5³ªn\n9®Ã×¡™ÂŸFÓ`B¼–Hrd2ùœØ+«%ëœ£½¨»U\n§lñz\r#ÏÒ9s¦ã¤£ÔûÂëBê9íRTÄ\n£s 5Œ#sø†2R·J¢´¡\$hàÅnÌ&9)Í\nø§¶¨@(#œ7°i˜„Í(-*:¼\n«4Ã6j‹Â½5Œ¤t«©££§¥ÃB@™‹OB76££Ê-0[8¡£lDÉ¬Òğ€µC'«ãº9\r`P2ãlÊº?B+|:F¨Ü½¯³Yñ€è	ƒxÎ€SÜ^Á î²õLc(ë\n4ãšF=!è„<¤€HKKS	h5 SB°\\•8bó®»8È\rŠĞÄ¢®CÈÆ3‹ÊŒ8£pÏ¹#J@4áú¢¶hû8\"…©¨Ò6Bµ†¼ÈÌ3@£pĞÕWÏĞ‚1I(KjÎSa™g'lzYpŒnH]M w8Ãgn8Åu¡WÁOÌ£Ôş\$	Ğš&‡B˜¦,h\\-XhÔ.Øê:0ÀğII+XŒµ‚;9Èë_\rñÃã¨\$6ß Â(äî³Hc´˜ª®C\n*)˜™\"±eªóChC¶7Úõ‹×!ƒ²ãoÍÃb6ÎN68È È`Ì7¥c`Şà\r7¢²9Õ¨X\\Fr’\r\0õšÙµéhA\\¢j½ Ãr.4'ˆ\nr6]új<­-éàå©êºº\r­ :î¿°µ»\$i³[NK¶Ş»‚¹NìØA»![Èİ½¦zC\"2eü	]«Ê¤@2·ƒ\$[zµâÈ6 0¢c<)í‹ ™àÂØZÁèD¯ƒ€æáxïå…È×hÆC1€Î£~¢@‘ØCp^Ï:ÙöxØ5Í³pÜ‡xÂg‹æ^9õÔ{Áu28¢P77•ÍÁ1‹ÛçİÏb+ÔšŸäT2}Q	{Â|ıÛ¾x”3<'ˆñCÊy9Ú½äôŞ¨el„¶TAğI\r¡À·¾dŒÚÃsé}l˜ƒ2†bjeIDlŞ%’x½L8r'*à§œP@NUq3A§}‹ÅzÉ9¡<@\$\0ZÉl%5¯S‘šzˆ8\r`‚°IÜ\r*ÙÍ 6ğÔš£¨= € À”é]¡Oig\0006;¸éˆÛ®sLP9’Ãè‰¤v«™•æ\\·Hé)ÄéX•¹c\rê;Q0:\"eülâ¤VeL°ï²óf\n\nˆ)må8#b÷ÒkÆ`€ºE|±2\r,p·¨2·(ó••…tİ8\"|P\"R¾4,édGö’FÁhI\rÍN!=‚A\0‚*õPeÏ5’à–:®méhÏ+ãd|\nµ›Ô6Q\$n ÑŒ†²„‰!3aL)`@zãDAe¤`ÎØÛ)A†ÁĞêFU³Š8§˜õØ¸ã,G&ÄàLf(P#0nIT²\$,Ò¤4&A¢èÙå	 Èø†-±l“É˜W#Œy“›úB,sex§¬¨èìàè ]dp»“dş9+E)¶SÒZA¢Ã-&a@'…0¨V+> q£ò”ØÍÃ¤NN«\0QÊIKÌğ4h?\\*¡ê†’dÓ¥‘S\"	d€Àpê€’2Kg„{d\$|¤]eª„(„ÊÀ‡I4AB¡P(îFZZ[7¨D‘ôµ•vœaÁ?1×U	™Ü°än¥’WÚ‘¶!ŞÙbX·Å¹bJH¾#ëx­š‰Æ„3¯µÊLi6¤ìÈ-V\0PCZ¡°„µb»eÂZ/'G#vİ_‰ s£)‡\"à@B F àÚ2AÌY3\\¶è¾[+‘jíi[]÷îáš£Y­	8µ—G V+I\$Éà1ÊÁÀ’‚T¾	Q01B=õEŠ!1€(Ü›®\0Qâ3•;'Š«\rM›7J…²lVËQ½>^· –“8s\"ãš´ &£õVI!n_¹%5© ÚwÉ`b+¡ÍJä9qÒğÊÆ£Ü!C+%Y&ïMu–0\\/?&rf–:«»o#¸LÈ™0„™tı-#\$‰E!™£NRÄhC3¥dYà·€";break;case"el":$g="ÎJ³•ìô=ÎZˆ &rÍœ¿g¡Yè{=;	EÃ30€æ\ng\$YËH‹9zÎX³—Åˆ‚UƒJèfz2'g¢akx´¹c7CÂ!‘(º@¤‡Ë¥jØk9s˜¯åËVz8ŠUYzÖMI—Ó!ÕåÄU> P•ñT-N'”®DS™\nŒÎ¤T¦H}½k½-(KØTJ¬¬´×—4j0Àb2£a¸às ]`æ ª¬Şt„šÎ0Ğú;=U‡Ó¡Hx›9]Pƒ­ä\nyÎ¶gÔZîìÍQwJê+Ëé„R?AË\$&R³œÓUÛ=¬So\näâµªØµİ)ƒ—w/ÓL¼”@º2¹m~[XŠÕ¢/>¿³ä´D´ÈT~“!J³tô³%ŠîHµúÊW=\n¢\$ä¶IgApj\"¥Ğ+T¨ªûÄ¡)B¦áÎ\"¨ã&NJÖŸIúB­ì/C/Jå!n{¢‡Ñ¶F+ªúˆkz`ƒ®)t^ÔÆ)„gB.üC\"‰ù×H†qvg‘ÊƒœÎ5ˆ£í(B¨Ü5Ãxî7(ä9\rã’Œ\"# Â1#˜ÊƒxÊ9„Hè£€á8Ğc„ò9óˆÈ»”ÜôËdsVÖ§LB•¾mLB¿¶B”ó½©ü~şªë:`«+ÅÒbÄ;5Jæ9®ëÊĞ¾/Ê\nÔ1Ä@»“KT‚“—ñs[¬´âêëZÿ¥eº¿Æ²L¸Ö–)(’¥,CW–ÒW4íŠgHª¡g4²PåÄ‘3ZãÔ-|ZgH\"^ö¶“C“N¼Ş47¹FÓ+ì©\$â¸“Ór‚]ƒ‘¸Ja†Äéœ¦=ªòèJ©œ°Œ\0Ä<ƒ(’dÙDş7eË8›(9H…á gœ†1sÜgÍrcLÌBR^ª-2ô¸‘‘ Z)Ú@›\"‘\rÎ€¤îäPÅ]èQ—mLx¡hÚ0#e¤Æ7}¤<:“ÚIZ–÷mhª\nÿKYJ2ìÛ@Ø´U•	Y¾–ávW¿ğ;O	‹ÕüDr“(ÉÄ»*¤IœT‡Fq7Ïs®ù(ZE¸^——x¶¡+İh»x*ÛŞ_?2¼ÁZzàƒHç;“ÚèN3hİàxT‹áŒ£ÆR7cHßè.üú½¦hØ:I\$Û!q—°òÕ©ÂlÜ ¸ªO…'níÅ)½Ëš˜ŞÛÊ!ôâØ\\É¯*Ú<@âCº{\$ø¯•¢®¹Kéj'¦tŠ?ux…ù¾;!õ±t Ea.w¡ˆ«jqğ¬;\n‰á·Ò´ùœSü=\$®6êX`)=…j®¡uruàczå•®A\" ú³íPdóó3U	å„~²	[' â± ”8ş`‚@®Ô•¾F¾h J+(ÁP4Î 3Å¯D7p@C m\r!¹7AÆôŞˆdMÀ€@eÀô€è€s@¼‡yƒqi¸'ÎÃ(néõã‡G¥&>“‰Ö9†pxÃ>.â^	·2„Iqí)¹ˆ2Ñ–Áè%*VVÅˆxzˆ<J†qPˆ\0‰‰qz`&ª–b\\ÀW[\\v>Gé ¤\$†‘*FHàï\$\$”tNRZLI§šóŞ‹ÓàˆºâQB?è„ûIO*U@·Te0²Ÿ÷p¬ÉqJd¸¸*ƒşaC‡…‘q‡u8¤Ú\$Fôa3İBçŠD0¼¦7B]>¹ò^«ZÒ+ºÇKPFDöCz`€;¶—“ØpMÑ¤9ĞÊÉCfe!ÉB0ÆŸÃ˜f®6ğÏé i U4öïéğ r=é<Cb´\$”’µ©\nŠbäE/î²úÎ©‰ª¨)æàÑÀãcI±\\‹°ÅU@gËâr²\n (\0P]L<UX§àYNâš%î\$7§)Œ¥ª¡¼\0äC³i¡ŸÙÕ ò\rê°TĞïOÎPJòîQD¤LŒIBä×ÌÔ\rKCBnOv¦?5QÁPª×\$7\0ê¢TZL”;†€Òê¤rò“'»–Ãk¥İ+ªâ%Q©D3«äÕ0¦‚0.bg†%¹ƒ>HQ4j‹ì—D²O1p¥5\rhg*×>¡…T%CR³zÖlVçd‘Q€eyê]böùå\"OÒ¬ºKIpüËYë}Ë¢@Ú	ÌêL¯¹2?UÄ¨ÀBloå¸Æ‡ú7ÎêM131Dõ>3òı/Ål%¬Á[ü<j[a„NÚ\"ÛTDxS\n˜tN@¢u‘‰‰ïp³4ªÆ `Ñ®Ä§ª&†€\nã ë5v+…NkÅ,6+™€¨r£*‰!‘øhé÷Æ4w4×²áÛ	zÄ\$¿”¦Bdû*\$`©aqDXÕ—Xİ­p?š‘’“2ü—¬«-Ì}l2\$zyŸƒ Æ!+­#{¬Š´d)_[•æè³‹à‚ø„l<Cu®Ä„§häšò‚Yl¤*'™úcƒz\\Ù.ÁÚ×B“‚U¶ÙBÛ©CFY¸µÒVco»'¢\"~Ü\r€¬1†Ë®áå%t˜±o@³MÍæøO*4Ğ´VÍizHÄ«¨rwaªĞ;Í\\£u]4O>¯Be­¢O ª0-2[SÈ¦SÚk¥Ë9}¯¥_jÀ°äğââØÅ¹¤’FIK†HbPÑÙôy†:,º4°6+NHÔ†p¦‚õ%ñœÜ³ŠGâá{×éj‰ÊiÈ9C9~Á{\$§8~m!8Ö¿’§0iÃ8½¤…Ö~{xRí>>yö=›±ÇÎd¼WqLht9µFp—iG†ìS·5-İ¤a²AÖ´3–€¥9¸”,–y–ÍôŠ6ìô¢¶¦ßJ–¤TÄTƒË8,{Ï.V<Ã]¸¾UÈ¡Ü^ûœóäBçêÁKxoÂÎJråª:]mwçŸ¤t™ñ»h&¾»ù6•|áÑábõ„ÏÑ’÷R=F-°dqğH·Sğœ·1\"pié…";break;case"es":$g="Â_‘NgF„@s2™Î§#xü%ÌĞpQ8Ş 2œÄyÌÒb6D“lpät0œ£Á¤Æh4âàQY(6˜Xk¹¶\nx’EÌ’)tÂe	Nd)¤\nˆr—Ìbæè¹–2Í\0¡€Äd3\rFÃqÀän4›¡U@Q¼äi3ÚL&ÀQPÓPÌÖ“I’;·JÄS™ÖRi7Åjµs¡”Ü ”H'9¡4Şd4ŞÌrQÎr„ç\"ÑŒf8A ¸Àá™@QdŞu'iR7o;d&xÎB.u88Ü„Â5‘Íøc—ä\nåÊyÂÈ€Æo7-<ÈÆbPn¿t99¦'”ÁîSN;\n)ìí&y©²Irç’sùÈ(ª9³‚¨Ü5ªƒ»2H`äšÂ12iüŞªƒ¢à\$Ğ°àÉcºÜ2&‚ƒ36kpXÁ¡Ü0„\n@62m#7#ÎÃz¥)±JŠ©:‘b¬4«	 †0¨qZ*a—ClB0Ê—Å¨Ğ· P„ü1\0P¤2Œ€Êş£ äa•²¨Šï-Ïó\nÃ±\"±1B)Üª&\rëˆÜñ:OK®ìS‰c*‰Ã¨Ê£ËmLÄÄ„£ @1,hDÑtj24šØ¡xHÓAˆ7<HÆ4˜eœî¿<	*‰îkÎ	»Ş ŒuK;²ÍS8\"§-Ğ\"¬ë\nì±\"È5¶ æšÍË9HµêXÇYËğ]GÑVˆÂİ#V Ó\"#© Ã)Ï P\$Bhš\nb˜2xÚ6…âØÃ{Œ\"è+H3ì=OS{¾±\"\$¤!”05z@‘al«Fq¬hšV(&\r“Z×¥­3Ï°Ü¬¾Cr¿9â>¥HB=[®£zz0Î­’ÂÖ¨Èæ3©`Ù:¼Ñ<ÄêŒ#=¶Ç­8U6»lhP9…) ¦ŒÔ•0@½Åwü‰Oa†T¨¢fº¶P430,#æXÚ†N9DóÚ<¡¥AäX440z\r è8aĞ^üH]\"nP@\\·á{Õ7á}Ê»KPxŒ!ö­¬Vî´ˆ:³nN“kq*TŒŒk|!ºÑƒi¶´dÊ²ljU\rpì>ÒKAÓc¾ïüÂğüHïÅŒœlÈr\\Æ(ÇbÜÊ”	)*C%;<ÿC…#RPé)Ñ[0@œo,5'9;³£LŒ¥	SdĞi%#4Ìœ¹&P4@ÆvÀ æè–?¢6‚`rIJ(0†g|…ÙëÁh\r	¢ø&úÎ*ª)(ë<sÜ·Ãa¬4fÈê½´hÖS¸N>k%\"èŒä	#A@\$ĞË_#@ ¥’A1˜dp´0ô„v<mï¸8ƒtBRá€\$äi *KCcCépšó˜b /\"áÛ!(ÈÉ-']¤òQàk\"Œ¨²)†ğHÌ{ë<¡¸8T4‡ñÍ‚DÀ—¾òààTY\"‘N˜Â2€¨ß‰aL)iˆ)öZÀ€+( Ø‘b>Y«|•42òpËùC%d6´ØSCÄx3	¶pvO'ä’’#6IKøp~	‚@@ˆ‰R\$&D¨0‡WÈqÀ\n	\$L<²	‡ƒz!€âÆS@Tkd06·ªZPD)1ñĞÉ£ŒFÚK(\n<)…DZƒÁ9#Ë€öpPÁp Ka:‡£6`‰Á:'Œ0–ÍãÜH‘‚-xÑø˜ÌÓ¬vÙ\nOªÙ­N\\lÙ8\r\r\"Õ\\\0S\n!1­Åğ@³\0F\n‘‡’9 IÉÓĞƒ²§–ˆJ@Pä¬û¢µ­T1}æ\\Ìª%ÀM-R!Œ,ó ˆÙÖƒã=Ä^Çê¾¶	ZÑ­dj¶ÀõÀkb\r€®:*(™e%’Á¡»òRñ)hdĞ#Sé{< ³M\n¡P#ĞpFq×3¨š)QX£ÕG¬ë^ÏUT_É\$I/ĞÈª‘¢ğGØI\$*ÕËšBr©–3˜<®÷`cŒÅªÁQ£e–jáš@'hûH{f.\$v;ªŠPúiÃ)s\r,\0•Lø\0¸@Rt¦·!‘\"QxCzD>`((Tì•RC(5@Â±ÚußaQ\n*ÏÚzáT:ËjöÌÆ¥Ğ†ĞÑYÏ¡â\$Ÿ›Dg„3dªóóMnXTa	V°Úu–™àélÖ¬";break;case"et":$g="K0œÄóa”È 5šMÆC)°~\n‹†faÌF0šM†‘\ry9›&!¤Û\n2ˆIIÙ†µ“cf±p(ša5œæ3#t¤ÍœÎ§S‘Ö%9¦±ˆÔpË‚šN‡S\$ÔX\nFC1 Ôl7AGHñ Ò\n7œ&xTŒØ\n€P†Q†È¼&@QPÂb†ÓàôñF§U›PÌ†QLÒs2œîxÜ~@Öa…Á¥X£©ÚI5,›Î¢A„í)7åV£´hÊgÈˆš£©Ãt”,Ğ+™Š5)Ì´ù,gÙÃ¹ˆ.¼¦é—hgI>KÂÈòyt1Hr3Éç½}i¸Ïp£Tòd³,6á:äÊ¦ã^¤înNG+LÔˆ»/è\nR2\rí‹R:\"­ªV9A‚9ëK(&C«ğË®NêË\$CHÊ…½.È@¤)j”:ŒNèÊœ±íÃô4ŒI¨©²KØ'£hÄµ((3ĞÚ¹£(ìå;£Z‘-x!-£ä\nÉxä5„Bz:B2˜Rã(Ş6½£¢ÔÆ\nH2pÙÉë‹âº3	2Ï\n?ˆ &\rëb*ÊŒ P”æ¹/0!¨dæÇÈ£Hä5O!*ª@MQƒ¢Î<² SR°\\”Øb	ã¢t3Ã@Ë¥ŒjÓ-@P 4ĞÌdfØÊ3ĞÏB(Z•ºÏ`Ø‚ƒ¥\\2¦HMZ›Ê4|à¤*F†0èE5¡ÔFÄ\rÈò<¾	@t&‰¡Ğ¦)J¨ÚcÍÔ<‹²‚Fä³\$Á”#|”©äüËú KN\0ü\rÀÜ\rø:j&E±µƒ'´-œ”ã0Ì§®ôÓÉó¤ì—ƒbê¾íPÚÌ!,¡c\"9ŒÃ¨ØÂÎ¨Pæ6C–R0ŒèËğ…ZîŠøŒ¡@æ¦²Bº™«Ä”¥ãrzÉ(Ñ“Jú C6£!C8@ ŞI@åœxJt†_aãº4C(Ì„C@è:˜t…ã¾ô\$šxä-#8_…ğ%ûIa!xDpË¶ºã}xF¿HÏ*™Ä6BÙ¢ØØeC«²'\\¨Êš¦ì“ô•AòË<2SI¶íûçºîûÎ÷¾ì\\ÁÁÜáHD¤ÂHÚ8 ³\0Ü:r–07CzÙº)ÂR©%OÖNúü§,7/+L’ ~«»ĞE,>¬”Œ#üèÖf`(rkAÉ0pÂÂûeŒ¹Ê³fÓKcü*A Ù*b*S\0 m´†=pÒLƒ™5¥@§­:‡Ã!é1¬m\"V¿ĞÙ¯#†ÍS—b¨€H\nŒÂ„Bd’©Hi\0(!°’zşšé²5AÀÖã`AĞZ¢< p@Lšhwvêå†²ÒÛCZ¢3KÆ¿vÛÈİh9—E3ğnŸnÅØ9Wd¹fpP“†vä¤\rÌa…e\0Ş^™9S)… Œç©øWŠH¹º@ìZCk¥tî°œ¦NO	iÍdD‘ü\$†Gˆ)s~ĞâH ’‰\nâø„ (\$‘@òh% ñXÈ¸+hqtÑ\0003É2ØôCği¦™	¥‰5\n<)…@[9)dñıË‘¸>°es•€ü2LBåŒW!kÌƒ’âa8eƒ¤_!À4\0Zd% t4âAŸƒjÓ_İ/Mx)…˜1®´î„`©×ŒSzj®) ‰Š—È¬,oç¡ª6GE«R;-TWM:(ûQjeNY„µ¦WË— ÁÔËÎ¸ı‰±/Z’ª¬e^Ö²Ši'4æ Å”tN™ÕF’-1ÀVÉ›¨Hä4¥Ğ£¥ @\n¡P#Ğp¿)%<ÄÕé ²J¤š	j1hÈ¿Ò8gˆİ¨¦•R2,^ğiÁäv®‰’Â\nixÈÃ¤UcJ¨´²mT“RĞÂk©Äê±‚ÂÃ{ğ\r¥¥ çfkç	•S¹PyÍi1<aPæ¡âg\rÊ›ÕYEñGÖ£Š`_Ò>	m5„«’sY‹=eBEP“¢X”ë®dÔ¬\"ü`xR/aÔÄØ‚KÃI	";break;case"fa":$g="ÙB¶ğÂ™²†6Pí…›aTÛF6í„ø(J.™„0SeØSÄ›aQ\n’ª\$6ÔMa+XÄ!(A²„„¡¢Ètí^.§2•[\"S¶•-…\\J§ƒÒ)Cfh§›!(iª2o	D6›\n¾sRXÄ¨\0Sm`Û˜¬›k6ÚÑ¶µm­›kvÚá¶¹6Ò	¼C!ZáQ˜x=’V¹R¦iY²b¬,uš£ÚUñÔDîÓXˆ­01;J³\r[ÈæXë–Ï ‘Ä°+H\"Ÿ‚Ät6\r5u°´§Í¡,Â\"¿¹ßgæêb^®ÓB°=~ÊÁ¿Ğ@*ºXwªë`»½ù¶RØ\\Ä°Å3	ØÒn3àhë\n¶dÊ*3JâBW»B¨Ü5Ãxî7(ä9\rã’€\"# Â1#˜ÊƒxÊ9„hè£€á\nÄã„:9ğ¨È­ˆ\"\nRd•–HI|†3\$30…·Î‚¨•NBT'-ê\nŸ(Cš¶««(I\nÚ3­úU:«Ih‡*²\$ø·\ré¢%sØª 0VÎ¬ˆƒã¤ÊS´…:Eœîò::ZÊª*\nÈ©m(˜±s±ñ;Ï‚LÇ-\"FÎÒEŒ²© Ä+Q'p-æéò,2=íB„µ\$N°)=C°.ÃÊˆZu¸jË@Œá¡e‹\$Ë”èê´É2c\$Ñ ö1°£Á-Xø<D\"v•Ld…\$°rZ;Ër9ÉI4³œŠR:š-2Û?;Êë	lÇ0É|›,7\n@wkBTnJ¼BÊ¬š¨'¢TUMB‚ĞØ;Ÿ/§ì<ìCH P\$Bhš\nb˜-9(ò.…£hÚŒƒ%µ3Û©2K2»B Ò9Ãcd>¡„¬\"7g9ÜIŸgƒ(ğ:£pæ4úThİÓä:\rÛz’”J²n® ò´v•\$+²#Š§—3*àlÍu!8Hœ…A3\$\n<”¼íü{g¤Db…UAlA%•ÒÖ\$°,k°É³lå±…ÀNÖ²ßmBÏ¸9Û‘º5;²¼ïyš=¿ğ5§L;Ä«®¥ZJÛ>ˆ•I.b÷a]P¨40\\H3gÃ®–üÈ6¾ğXzn–2BA\0x0„@ä2ŒÁèD4ƒ à9‡Ax^;üpÃáø°´*3…úH_è¦˜7á}öC/¸Îã|­ÈRıôÕ2G® RŞšÙ*îx°¶&wŒr†,Ç8¸Ã¥ˆw1i\0#fÅ	!K`¸’¶cÏ3Ïz/Mê½w²öŞëß|/âä\$Ÿ;é~\r¤4§ŞüJ>^Ë]!’VTÈƒøJÜ …’R+Y9f™’µ2â9r‚ËÙ:ò\"Ø:;\$(ô¨¿â©ZÁ&j9„XH˜«·Cá„1¾æš¸i\r°\$>“¼A´2ª@Âš@rEŒ1¢0æƒ¬|\r¼3ŸxğC he³‰ò›Ì\rÏ¸0†Ä¤·Òç\"NL‚’ :9!Hğ©øÆ‘É¡T\\é„®‚\0 ‚>‹¤î0.‚Kğ((`¥Ö–k*ÌkoPtŞ\$&*Úl6¯ÚM†ğ@i>Ìè3ÈY¾‹#7D¡½ÊY&ä)Õ\$2º’D€…cn0„z¡bP#“Ó©è4]#h“”\$8TZ‹ÑˆrTÜ4Ç& g{õĞ°Æ]ğe()… 7C[I•“ñ3Ïä´C¡!Í®†‹’dÅİSx4H¦Ïd’™	Y%e!ËÒ±\n™¿Kğ8È0¨IQ¼(Š†\\œcİPI#Aä7‡T@U\"&#m%RI™ÔôÃˆuDhœ3!@Úğ_\$6‘Rq9&‡¤İDˆºrRXÔû4Q¬Eµór,‰m/KnÀETJ‘P!u^'%É\0İaâ#æà’U'X{Qò9)e¤“ÍhÄWú¦²„*œ›ÄÚ×¦š,(Ë%B¼N˜Q	–0›)ú§-È²+Î\\#Iƒ=Sı©¸G²à.h°¤Ë	\$‚15ÔŠr§\0sgğ@ÌrÔ¦ÔíÚPæ9»¯ëi4Ø¡@…a0Xr+.óU-bğ¨2	\nc¤½,2ú]›ì@oÅ=¾'VTdøyœÊ‡„°UÖÙ²`ò r\r€®»Q`Ö¡#[]—Ş5°æØ€U\nƒ…JqİUó'†Æé[;©S¯æ+)×LÑ`2:GĞ;¤\$ö\r\$\$¦d¨É8Ã(QATújHêB—F*’²T@à‚bÈØ ã 8ÈµŠğ†)GòÕcß‚2æGtíp„Y¢Ñb4E§Zä;”¢\rùtÇÅl9ˆºÙÜ#x¹´©¦ƒbI ­;C`Q6ƒ¼[g×b£`HñR&E³˜Â´ª§†™¥¶ĞJÛV.Æ«,Ì #™§ª;°QV{u¢MÕæ¯`ÉKe,—Œia ";break;case"fi":$g="O6N†³x€ìa9L#ğP”\\33`¢¡¤Êd7œÎ†ó€ÊiƒÍ&Hé°Ã\$:GNaØÊl4›eğp(¦u:œ&è”²`t:DH´b4o‚Aùà”æBšÅbñ˜Üv?Kš…€¡€Äd3\rFÃqÀät<š\rL5 *Xk:œ§+dìÊní‡š²Ö¤Z'IĞEJN¦Ã©¨Ã5&i³	„L4œí–Ì<‚u.¿ÍJs¼\\š= 7Àif“Y”ë@•]NØS¦mIC¶mvø¬f>)>»›²ÅN»„ Çr08é·\$kÊM¹™NüÙãGy3Ò’Ù×²°~·`İÊŞ\n(ÖX—˜^o{¨¡ÔÜt2Â£sÍ™ÈĞ2ª(²6Ê>ê³:Œ©êL9Œ.|½‹ã¾5\réJv)ÁjL0Nê5n£|©(ÈÚ–5/ÈÂ9ÁŒ‚æè\r0 İ\nBpê™Q  Ù/c›”-c,!'m²tó¯´^‚B8Ê7¦C¢tË£#\n7§O”\"¾”‹øÜ˜)²YÁ¯pÒ91Ã¨È:BBX:Á¡\0à<cË¾5ÌóJ‚ó®ì°ª:Ä*!£\"†0Ã¨ĞÉMË\rcË®Î#àPH…Á gL†3hÂ2L£Y<%¨™6‰}@)CD™\rÌ ÉP\nÉc\n9Ô˜Z8*“˜¶?òâş#KşË5JËØ8¢V\0Öa–Õâ44¶c-®ï–kğ !uh”ƒE§j×¶Í¶ÛÛ·*-	¨Ü¾M¢@t&‰¡Ğ¦)C€à:p¶;`ƒ°ºV©ıp%³×œ·j#NúCµ	N\"ù¶¥µ¨Cpë@Cô-’¦¢d %ñ Ù)H¥ŒÃ2`ó…ª\$B‚X—fëÌò0ÍJŒÙLâ6©˜ĞÊ8-Šd¾>Í~5»«`İ<M\"‚éÎ©ÒÑŠ”f\"¤#íRqY½³:crp¢'‹ƒ N1¥'šd\nj&¤êj­‚\$Ì¶ÚŞ†×ÆìÈó±NÖÌ¤í0N×m%;u\r¸îp¾í«o Pª6#:äõÆÉ>¦ )«ß+|›íâe è#&â¹+fÌ;\$]¸xÊ3¡Ğ ˜t…ã¿¤\$ıØäK8^»…èÃ„¢)xD?@Én+Wƒ×\nÙ²xÂ&¢N¨û ¨8Üÿ¾ü/&âÓX rç\\2—s ŠÏÀr¨1¦SNVIw6Ä„˜¢´Z x¯ä¼°èó^{ÑzoT»=w²öÃsÛà7\"ÂŠp>\nˆT×—âüÙ(-J!½+Mk`ˆ\n9§Pì[­OÙ=‘²‚9XQÆÄï\nE&)\nŠ¯'h˜9™&Äz‹í9°6Òîì‘Diunˆ¸¶¾zIëL\r'\\±\"øn‹ú{nQ&:@\$ÔæI51\0¡ãÚ‚i…q%\r•‡V @PCFU‘G¶°ÆAN0=»Bø¼a³E…°š…—–CÊ³väÉÈj¼\$phBêğ92ÅŒ…ÈüGvĞAò‚c‰¨VLçü™™–féšóZåL: òCqßx¢>§U¨·Ó¡İAIá\"Â:ŠH9Œ‘Í;cï¦ş€§\\»À†ÂF¤ö£„`¿]ÆêB%\0Âkcò³€¼—r€E‰ä—Å»“Ú]CŠ¥ĞÛ©#\n¼ 	h¬ƒ±¢ğéN&¡(Ôn»V	º^nÜİQ\$å3ÏºÔwê¢&ÍCb7’—\"ÊVLa'è\0Â -a´H¶QIğ(AÁ;ì4²s(èé£äq’¶pÜƒHg'\$Šs”B¦QæôÁx2“œ²;IÉwL(„ÆrQJ¡L*\0tİZó9%VúäˆYa<%d´—“^JP¬A*ğê/’¬‰A²fÊ‹ĞrwfPC;†ä¢Yòòß3„\$\r¾³Y¥µlÀ		v¡+5KV£TW!¥ Ø\nÎÍkÕh9RàÜÜÊ [Q)W—Ü–æyX4ÁT*O qŒ‘Fg¼Ï t+e×Ü[ôİ™+Kf\rù‹N>i”­©‘5æX–pË=\n!6²eœã&eRÒ6÷øèT4NÑß9ÍXÊÜ¥n§å[7ÊÌÈGXen2ÊªƒF¢@Q³±Ó¶Ó”¢‚éâ6j-C]Ó8ÂL)¯/.¦`	…A“T2SO š¨¡ïR\"½&0+ÆgËÖöi9i¬nĞHA®dG2BSAÎLå‡2\nJC”An0aâ<gòcÎzH;½Jhyá0r{Op•¢Àî–#â†&ê2¨nı\0";break;case"fr":$g="ÃE§1iØŞu9ˆfS‘ĞÂi7\n¢‘\0ü%ÌÂ˜(’m8Îg3IˆØeæ™¾IÄcIŒĞi†DÃ‚i6L¦Ä°Ã22@æsY¼2:JeS™\ntL”M&Óƒ‚  ˆPs±†LeCˆÈf4†ãÈ(ìi¤‚¥Æ“<B\n*N£©Ò€i9˜`GS(‚u1MÒˆutM7™\r3HdxÜsaªNYÜ~DÜ 9hNgSd8é:+Aá&á9„ìe=Ld±šN™0@m2,R†€@jƒ×a|¬¥šO:\"›´wÓŸ/Ù9«Õ¼İ†7fÖÌ\nğx¹6ş‡G]8XæĞówÃ´2»[ó¾0Ì0¡ljx7ïP*°ÃcÎˆ£“Fã\"(ÜôŒ©Úz17‰B’”¼ÃsB¥2hàê8\$(ktŞ&*PÚ7¸j”^‘Ã¢°Ê:¨	;rÂ°ãš`6ì”D¥£ÂÏ/2ª*êÊ˜®+Ê+º´BĞ0˜es&‰ÃxÚ14hèˆÅ%˜Ñ´`P„¿\r3()5C(Â:B;C14+pdKÛ6Ağ‹41€S0¨ÄmÜpÇ0³[ÎÍ¦¬Tšş±ã¥\$Ã+T³Ìİ!Š&óÃ³êÛB640è‹Œ\0Ş1 C Ö5j ãH7=á j„ˆÎc*l†Ylkh–E¨da—,\0ä®'ic…ˆ5¥.\nu]”÷Clè†èÚã(Øè¦:NH(\r&P…¡.‚Â¿È0òÎ×:ÄŒéB{>´*ğİ4!uoX¹	Ã‚¡/2£„8VTiÒ‡}Ã\$	Ğš&‡B˜¦\rCP^6¡x¶0æƒºÇ@Êd†¥‘,O35PCÛ«ª¥d:„Ó¢2]¦©òPË&IÊ»#­kØ¡QU¬B\\Ş¯Œšt)¡½\"40Ó&¢½â¢Æ8FÛt“K¡;nÄ:çáb½‰_íËšX<í¤™Ÿˆ\"*ĞîC~éîÛƒ?U)²¾ïìOU9Ü+o;¥<V›Æ=:ÂtÇµ*\r8„-ÃZ3ièB 3„È6¢fı\r\$ŠJº'£CF3¡Ğå˜t…ã¿¬=ÿ‚ğ¥Ã8_©…ùîCrá}ñRĞ`xŒ!öÏÒò¨á8ÄûöÕ·\r®ÎôÖ¦§£ƒtN(œth”rBi/Éú\n“ÄòËy¯<:=¦õ^»ÙxMî'¼øJK\$‡™ò•@|GÃ‚¬*¸Ü>·ÚLIèmO­‰´`ÂM\r:#&FŒ7P`Ã’¢æÁ¿ƒrÒša¾#Áª¥“’´šRŸHAÈ¤–ÚaQ;I?+Ø„‡0N0Úù£!H•q°“l²‘‰	†B©ˆ¢D6ÏÛ¬drÇa©5CNXK§:ËpÈ\$b¤Ôax@\$T‹	pt\0 ªChWÌĞs\$!¸’t=×+–i!Ô<©q¹w…EôÕ8@NWÔt›…ìĞ\n”°¦TÚ”jxÓ·§7+‰ĞIU!æ™&şnÈ[¥rå\n¨ÓyŸù©c!ÅIã\nkÇ.¤î‰ĞT\rá­©‚\0†ÂF>…•	“Ä‘áA0ñ3²fKƒi¬!æ¬ÇŠE!µº¥²@SÎé)40%†‚	Ñ¤Øg…®\0Òş”¦ŒææTµ66B¢y(4s20-\"’á	wĞmá4ØØÉš¡'Mi¶\nN‚#>•Ä\$(ğ¦	ós*CÒx“ ©”…ü†ÂzOçTÈš™´z\rÍFE6#fŒâf=CDÑÅEÈ¤ P6Dâ›t\nC{Ù&ú\"–VÉ€S\n!1•ĞŒ\$1ójf­m“VKIy]£ô…Ä°äÚ	;‹â¦*èÆ\$9ù%Œ6Å*µZÿìx©‘Le™¢iee‹±¯ş9‹6}%lÊ'LËB»0ÁìÓ	³ªQ†°÷1hÏ;<öšÙ›hÇ	ĞC,A°†4%3É«+±úrUSŠWj•³3–\$¬;t¦S‘#K³v153Ê%,İ\n¡P#ĞqjÕŠè¦ØZu¡\"Q;`7©/«+wd/y\rgòä–’9*‘Èââ[Ñ’èTxö¢­ò\\€*ğ9“‚Ä R]RĞİ%°„\rE%Jn‚,,CÎ+¸|éQš¦IÌeÁKpx˜B–ºˆßL_‰h0âÅ\\¼ØšxÒQ{&Ú‚jÍiŠaF€^–Êmµô_‹†Æ.5/Œ@s)f“ÁÃà‰…\$Îá%š³f½)FTß29¤omÂƒW\"	z7¯È 1ÅÉ7'QB7èŠ™£åÑšŒ‡ó2·è òƒ+ÌyÏAé=G¬ŞÃÚƒ€¹î½ğÜàHw%Á’‡0}‹ù+\rÎâ ËH\\û€";break;case"gl":$g="E9jÌÊg:œãğP”\\33AADãy¸@ÃTˆó™¤Äl2ˆ\r&ØÙÈèa9\râ1¤Æh2šaBàQ<A'6˜XkY¶x‘ÊÌ’l¾c\nNFÓIĞÒd•Æ1\0”æBšM¨³	”¬İh,Ğ@\nFC1 Ôl7AF#‚º\n7œ4uÔT4ÆÎu3,´İOFæÉYÔæu”Mñ3)ºn4fğ3¼Ã4\"™)²€Q\$İ½²™fê,r2ãÍ’z„Ò):lcW£±¦A@Äœ%£	Œé6OR‹5PçL ¢< É¤êœºò˜4u™XtRsuC©ís\$&=+Ã„{7=N±‡Ë“!^NZBg²éŠ£›H*ÃZ¾;¢ÊR9&‚ Â“®ê İ+ã¢\n:	,,ác˜î¼Œ‰  ¼¥ƒí1ÉêÌ3N»±7-8Òa–m:ª9«)b\\®)Ã4±\r+\"h!Œ*¦'5£j”PrN°„BòéˆOc\"ÉŠC*†(ß%ƒ‘†Vºm\nš¼PĞÉB+0Œ(êú6M¨¨Êã4‚‚”œÓº”s´ğó\"‘:ÂICpèÉ„£ @1-ÈFÑô‹b# R¾7A j„@B1´ˆª¨ƒGÉ«´Ê¿“˜ùˆ#ÇÆ P¦2¤³\$¾µB*rßI£( ±ôS& ŒƒÄWE`PŠ77­%(2ØcbÃj\r2(ŞRtu°0·Ñ}¹oG\0PÂ3Ê`P\$Bhš\nb˜2xÚ6…âØÃŒ\"íu^Nõº*æ:ö„› Œ(úB«%IMa‡Fø+2¨ê+t¿®u¢ÙµMºnİP3êS•ØäŞª\rTô—¹ˆ2;”X©Ê;t\$TS+h0”í“Æ¡fs¤êB¯ĞÌª«G)ƒpëE\"%Ç›ªå±*¦K e¯E:0A¤%zU)¦éòf_)E!5™W¶J‹•*š\nŒÌ\nÁŒÑDä3„fš¥hY*:¡¥!ã4460z\r è8aĞ^üÈ]\"ğpbò3…ì¨^¨/ªr*„A÷I¿Áà^0‡ÒŠ:Ğ#®Üïfz”ŒÑ4HâŒrÔ[£ñ<s’Î’êİ½•»…mU'h7¡pAÅJ<oÈò|¯/ÌüØÉÎ…ÜÿB7t#Äc}¬	)%Œ=w`•	ñSEª«„~Ñ+Á1…\$¥ŸfvYV9ƒn Á”0ÄÒ‰'%&d1ãF‹›Á0mÇ_‚\0îo–Ô€ô¥¥¦ÜÉÜv†`ê¶Œ`g=x¦†‚oJPÀ¡¨¥ºK\"F%…õ1–âDÏò+3%M8ÄGÖÜLP	@‚†ô4‘bh(*À¤æ¦HÙ;#Ä!‘Tû±7%aÀŞâ	ÓV0hU·ÃÒÒC‡†U[®C\nrkl ½ê3å~ŞPl‹‡°;3’Õ`ÉJ=f\r·œ'‚Îa¹ë\rÁÁ§‘¤â‡‘\ríü†ÎäTy!iT\"–ğÃ[JaL)fs#E[àiÈÑZHJ£d%P5µ’W	l/Jæ€<<DußÀnI)-ü“ò‚ÏUA\$8)ì¦˜„p¼wÄ¤0‡UnQ¹4WmŒ°UªQ‘yÎ)%9[²ƒyI	+pG±?³¹ì¼K‚&h8Mbú“f,Q	áL*Fl·_èg?sâo¥—¤ræLg’rÎrB‹I’w)ÁÙáÈbZBÜõF³¤\"2‡ƒ¬%(­bº˜Q	Œö‰bnIÉ;%røÍ`©\\Ú\$ÅÕ£O‡ğjbh§%¦½CºÙ_šÊ&47š\"‹U§Ê‡[\r`šcP˜ÛmX¬k(«E¯VT\\'¤KypVúÖÏf®rA6¦Ø\nÃÉqT1ñIa)èüñÔÄrVÊ9+ˆaÄ:’JT\r^%ËzC\0ª0-5GĞØf‰W:õÖÒ›è›jKÉ´N&Ø¨‘“É	W¬`;s t€U\\³J ÕR÷ƒ>Ğ\nK6[šp–ª@4|ÎCÔö*—B•kşjèi(§¨²^]rºä¤Ÿ\nƒF’bD½GØó\ntÍi³(7(ØÂóhJÔòª.Ò#«N¸p2q`vî#„3°xŠæ©øá5J©ØE	[flè™å¢áA×-ˆÊ@";break;case"he":$g="×J5Ò\rtè‚×U@ Éºa®•k¥Çà¡(¸ffÁPº‰®œƒª Ğ<=¯RÁ”\rtÛ]S€FÒRdœ~kÉT-tË^q ¦`Òz\0§2nI&”A¨-yZV\r%ÏS ¡`(`1ÆƒQ°Üp9ª'“˜ÜâKµ&cs¸„Î…>—B/úÔn¦ŸƒC¡”x‚ª7µDTéeQ®¡¿Zğ›„›\rää	©rÕ/ás³ˆMNq¢˜G¦²Ü\n`”ƒ%¡ñ¹~®¨Ú^.h„q/Îjvòl]çl¨ŞG7í~\r+ä2—Åá/l¼©&1É|'~\n*›fãyÜÜ 2œFó¸D0&#	ÌÊ 2Ì§1èŒ£€àö?ãƒê9ï`È÷\$ğjJ—¶âôß¡h;®I¦èâˆ'nÒ´¥#IÊ k¥1²‚-¨‹†ˆ6L,S¸kêô®.c’—£Ä¢6†'©\\h-+Ë.» è‚p‡F±Ò:“-N*^‚¯pš\\¹­iÚq% (K®†1(C-A®B`S/	ì7/îÔjL Ğ¼¦Œª5ˆÚ€ˆZsØjºîÑS±¤ä2·Å+\$Æ&l6í#È‚AA®»ªš¢€D­¡Ò6ª¯\$‚6’¡“\$>¼LŒ¬=D¥é.ŠN(â šÒ(B\rL TİÇU±Q*¥¨ó\$	Ğš&‡B˜¦cÍœ<‹¡hÚ6…£ ÉBRÉRôˆ:@ˆ4o˜Øû©aØô\r×Èş\\÷(Ê<ƒ(Ü9#}ç3ë[lÃC ØÆG±²`HPé2 O·+S/,±ÈIN§¬+o§©ªî•§x‹Ô%¶êw¥imzJ…Š“‚1Øú\rZÃ…oRˆ-Åu²92\$	ë¯%Lé¬#HKÚŒ# Ú4ÏNM É}Cƒ@4C(Ì„C@è:˜t…ã¾Ähº>’ö½ƒ8_yïÍÒ:^£p^É‚.“¡à^0‡Ğb(6IÃ'™M2Z‰’ úd5Kšj¡*:+ÂDå éÜƒ;I›a¨êz®¯¬ëzî¿°ì{.ô…ÛN×¹]÷ç¸îj^ë†\$¬œÎ”{Öù•¦ËÂWÉ¹ÎÓ“rm”\";Ë^-@D~:9H-uß’¥°Š¥ø@¨4>ãÇ¸^Á\0î4ƒ`@1>ãƒÒ3=ƒhË8Œ#5â9@Æıc0ëó\rƒxÎÒi @3î¸_p mT2/&àC`sA…üƒ;q®(ÍÉJXQ‚\0 € ,›Âöi/}¤x\nÁ\0pA¤;>@Êß|1@‡ñpĞŞàƒıï½&¢Oê`K†YÇ2 ‰ÊÛÛ='Şµ æŸ¸ €-ààP*A!É8‡pĞChá­>sïa§Ù2'zC!Ç]É»òL·DëˆW¢\\À’c´(\\q*1%¼ğŒ%êáÉ›ã†r!ˆ<…ÂfMUÙ\$E,È¥€ñ\$ìƒfÒl¼¼pZZ3§~„q€œ¨I•Ù 'q9‰¢¥&5Ì›ÆE,Ti?. ×bËjA´0 Â˜T“\$p’ã'(!£ySY#;1ŞDÙ“Ó)šÉP[)rf˜\rÃDÄD©KZP ´#HBIˆ–‡-á¤Rô”¹yaF2#ÔØc‰Á×aï=×x¬Ìk¡‰­ÔY:Ğig©2ç\nšç;)-_“®J^ør|À®vrz™™%®4á%Ó‚bÂpÆuD^ZÍD¬˜ŠÌF\0ÌAÂ°‘3”ƒ1¨ğlÔ©kaFt×EµŠ!‡f§“Y\"áLQŒ“ˆÔ­¤ºlcëBAÅ¬—›²9N%»Ö/(ñŞ’^¨œØ­çââ<dãòÜ¤,lÇ¸TdCˆ…«FØI™,I¨‘-Wl0ˆ&CB—¨õmœª~¨ÖCrKNĞœb^ËZ8ğóÉVˆVªÏã/kRUšK¦^—1\"";break;case"hu":$g="B4†ó˜€Äe7Œ£ğP”\\33\r¬5	ÌŞd8NF0Q8Êm¦C|€Ìe6kiL Ò 0ˆÑCT¤\\\n ÄŒ'ƒLMBl4Áfj¬MRr2X)\no9¡ÍD©±†©:OF“\\Ü@\nFC1 Ôl7AL5å æ\nL”“H((4Ng£tR¬³—Ê•§­¼œi7à²¥	ˆØa›”ÏQ£Y–öt²Ç¦èåÄb¢FS9ªQa«N†ŠK\" ¸™(ÆãÌÜ²o:ˆ/'c-LŞ 8'cI³I–ïÎ§!†³!4Pd&q–nM„J•6şÁ»µ«ÁoyLß~do6Nœè¡ÌÂ\nîù¼\"é«Íçså3Ü3B¢V9*ÎÚ:<¥°\$/Kâü\n£pÖ7\rã¸ÜØCŞ9&â#œê/MêHäBŠPæåÚ”8/C˜ï\rŒ‰¼½¯©ûì˜ĞR¥ £XÒ¬M3.ğŠzdš\r\n¬«jèÉ%mä(#h\"\"‰@ù##\\Ì±£„·‰ñ†YNp#Œ©*’á=ì“ÈËËë¸Ø¼Æ“1f	IB÷3³)B®8< PŠ6À¬¨ô=’)+dĞÔªêÈØ†Œˆ2h:!-21Stí?MPBß\nA l¥XBZâ9ĞµB9\rDŸ\rŒIŠ7.lä5Ãj±BÌ	¦)bŞ8ÌÀ–á¯Ğk·ˆ¡hÚ0¸«²P0Œ”[ŒãÈ!½ÈØŸ6•ŠØ6[°5<ØZÖÄ’”\rwXÈŞÕák¸­€Ùz——eñ}·ûz^×À6 ŒÄÏ3‡C€à\r²°¶<ãÈº\r¡pÉ\0Œ#“Ö6\$²º‚ê8ÑàA\r¶vPŞ©™Xå•£Â²7cHßœ&âb‚õIK>Û·9z7ŒÃ2€…2,˜äŞ3ö|B@Â ŞßÚí @:ç¨Æ1²Ã˜Ì:É9 ÎÄabB9)€ÏlBìB—L¬@ê¬…˜RÈ«•˜Ajo\nn*/0’…–0¬@Î-“mCwœ®y˜x˜\n@Ì„C@è:˜t…ã¿L[›ªCc8^„é&\\:gCp^İ“ÅxÂ:úàÖ0¨B“%£TÄ:mM3ŒïQTbúCPäÈ>Ô€àE±xåLæ£€Ò¤F!.İs\\ç=Ğt]'L;õwVu½mšæùÎwÛ©ğ’CÆx§yŞ»öTñMY9\$èÊ‚~pÓY;)6¼'ˆñŠÊ¡¬7–ÂíQÙåÈ«’´où(l¤ 7“¬€Ma0nÑ‚\0îqRKÓ#!È3!·Š¦Cf{h¯¶ÆÙC{gBğÜÕz{( oì†Â™70æ%£ò4ˆ…‹fˆÒ6ÕQÍ`t5ÊQ*Ä“œÜø \n (7ø¼O)ó1‡2>MÂ;!PÍÅ@³‚pÎ)ÇS(¥‘S¤‰I€ldÜ¹q†\"ZyW6ŠX„š@Òs„.08‚“æ‹Bæ¬Ş˜ƒŠŞê0†ÇD1†‚\$C;?:)ä¼™2lÓ¡p†ÂF&éCRJ…˜.-{)“êõæX YH0¢”ŠN	Ñ<'Å\0‚¼Pôk“üm)Q‘IP@’‰(n†Ø3*Ò<&á\$ˆ‡“p\"]7È˜„)“VtŠ@q¦X¥d4Hkª#Q9†6IÒEÁ™Ô’E á1\n<)…I<s \\„¬5™S¼âŒ[‡Ü£ƒ´ó\0v+„©ÏØLQ/ÅXÕÙ¾Ñ%ê9l‘nT\0Å.\0S\n!0™Hšs\0F\n‘Ô0¬\0T¡´<GæF’57%\nP[(âXÂ‰ÍjI48 «CTÂ™r?	üÏS¢n»ëÑW8Gx¤¤Uõ`J9ˆ+.}|Ø+ZìŠ°²\0: @WEƒHcƒÔ˜Ó ÙBà[ !™¶£ònª´e)é· ª0-µÉPÿ_ÔÉfdöFÀÙ_—Õº«öô¿\\ßp­â*¸¯`DI	>ËDËÕÒ^LLaK'À‹†›HŒU,¥É|)(!BÃJ€<aÈÊ™tƒQ­?”Í:öÆ¶nÎX†pŠÎ³&…ìÚƒ„LY’Jì´È¢¹Lô7ÔÖR(A3Ûd\0zj—nç¡Z'±†%ƒ™ã ¦ÄÙ¢\$İÏa=÷\rÜ[‹Ù§†eÉX—ô(”0x· )ÿÜB~{UŠ³>w`Š]¡BÕèn@9Ç«´4Ë^ ÄU–úG“¶@";break;case"id":$g="A7\"É„Öi7ÁBQpÌÌ 9‚Š†˜¬A8N‚i”Üg:ÇÌæ@€Äe9Ì'1p(„e9˜NRiD¨ç0Çâæ“Iê*70#d@%9¥²ùL¬@tŠA¨P)l´`1ÆƒQ°Üp9Íç3||+6AD¨ñ¦npäãJ£¡ÀÎ†9²ZSÔ,Å;q¤á@»Ejp3Êİ-,›Î¢A„ìeâÈÒv4›¦y…?6u8@™ƒ¡¢İO¾h¯æ“ldÜ\nÂmg1}İÜj:Æã¦ãÎgÜm6ÛÊ	Ï‡İÉóÆ¾êSËqÁDƒ	Àë!I%wR<†\r9MÆ¼ÑŞƒ(9ÎRÒ\$jù+Ì\rú\\ÔlæÔ’6Œc˜îù‰k¸9;¡æó¹£\nŠ’¦#£&2c›V79Ê:X—&ªsş\$«Êş:3Ë2\0003¥H’r¹BN`@; Ğ²\\„1Ë[½8Ê7£±BÔ\"ŒƒHèùB‚ã·	ÌŠ	©Xê5Ê’,¸CjrB(İ!\$Éê…Œ‰4Œº)€ÍA b„œàBs\"£‰Êï6â¨äà±\nöˆ¢h!\$´#HĞÜ£Ê6O«<µ£ ëH	ƒj4Á¸—N6“\"!FÑé äÊ¹Ãbvƒ³ÃjZö»b@t&‰¡Ğ¦)BØó]\"èZ6¡hÈ2QJJÕ.¢\"ÜØ³\n@@ùõ™Yéœ2Ûœ²Ãï¨Ì½@PÙL‹&™3xÌ3-#pÊ¿¥½Â%Ñãªd‰\rìÜ´â	ş1Œi€æ3Rá\0Ø7Œè@æ)ãò¡\$h@A‰³(Ú„8#(P9…*ZQT4!\0×z¦Ih¨Ê½i¸Íh;î8@ Œ˜½Ü9aƒ¸Š%\0xpÌ„C@è:˜t…ã¾”(y’P>C8^ïÒè¨,¡xDjÈÓã}xC¬¨Ä·a•L!<¿è²‹„¥²Œ5œÀ4h…82Á9ÖyŸh‰£iPï¦f(FŸ¨êcv§l£Öß)ğ’Ú´Né°lV¤‚4\ró,<äxœ”_hğèúJi\nFæ¦K)1&ñ¨Ò3dÃC00ŒzÂ‚;´5RNÎ%\\³¾(Vşsà0.	U`øO#\$­k0˜£¡\0ÇGPÓ	Câ,3mvJƒ¼Ë¿#Ù\n@ œ'R-,ê'AB©ë»–ˆk-ÜïYs£3¦|Ğš7€Ct&æ¼ş” ØÁÃ»|%¡šWÌT‰ˆhw\$ ÌòÈËbeëB3¼€É[vI”;šàÆIX¸ghDĞ§»§´Núï_Œ „0¦‚3ù1Pd>«Wé¾àãÕ.§ú•(Æ‰³¬pêP˜ Oå9-!“iß„KH¤ôŸ“˜Š‚Ğit\r!¬ !âZHxy2Dí2ÀĞæG®&ê88‡R`FÃ1ñ\r¬½Ä³8jGÓğÔ×‘“H}° \n<)…BJ\n(l2dœ˜Ÿ8Œ£Q{²Y½™4±'	‘;QÁ¬¨òÄƒ0i\$1”ƒ!Ã»5¡”\$ÍÂ˜Q	‘2‚@@Â0T}é9‰›Té¢d‚\"Å§¥Ô¾g•3 UIÊçÃ5İ‘Ò›DîS¦ ÒKRòBYÓˆ•²ŠsqĞ\rÄµŠ­Á%Ã‘pG‰ş\r'TPXc-!Œ‹Y|”~4ÄqĞ»v‘‰hF˜±9\rCF\$B F â{3dŠGç¢e1¦x›ÎÅRNÎQò%¡0’5TGXºÆ6õ(PĞÌ@QÃQ¤„%;@QÿKçhò—HÚgSÑETu\r”Èáq¦4’†ãB]‘œà(&ùzO‘ù>Õr¯Qów\n*ûF­³\\¸BšõŸÍTª*F[Â®õ¾\0ªX¡ŒCâ„	!ËÀ„êcá{7•¦™¨ô]M\r\$=5P¢ÚÀ";break;case"it":$g="S4˜Î§#xü%ÌÂ˜(†a9@L&Ó)¸èo¦Á˜Òl2ˆ\rÆóp‚\"u9˜Í1qp(˜aŒšb†ã™¦I!6˜NsYÌf7ÈXj\0”æB–’c‘éŠH 2ÍNgC,¶Z0Œ†cA¨Øn8‚ÇS|\\oˆ™Í&ã€T4œ\r3èñºWs2[M‚s­R,e£C	Š7 –“MæCLxÆaf†XŒ¤Ó¨œÎ¶É1¤Îa–à¤¦ƒ\rÎæpˆ¨6¡Ã( 0™íV‹aÊBq:Ôp‚&ØlĞŠvÓ¶C†lâÔ9!ÒÖuãq&YÏ(iË3{aÒ	Âéa6S`QÙ2µä	–³?@U9ä§(&ÚÌ‘å¯¦üŒròŞ§I\nF’³C€à´7c‚t9ë@È–¾	ƒ6˜#MúBİ\"©ªH¹¨ÊJ– ª\n’¨-F@–ŠnóØ40pêŠ\" Pˆ0·i\nĞÈOLb)ª #Œ£z)>Lb.9=ëô|(Aphä2B\núŠ¹Ìxô›\rÌ\0˜7­I+\\9'2ÊşÀ¬ƒ²0Œ©šÌŒ\0Ä<ª€LÙ7N\nˆšI¡xHÏÁŠÊ1ë:Æ77\0Ÿ'½)sÑ2ºnáM’Øò…©Ê?2{e¬Â,Ï¹ÌˆÜÕ2˜ËL´¨â×T0tå6ÕtÕ]S1¢ª(Òvş	@t&‰¡Ğ¦)C È£h^-6ˆò.B³°è<ãĞõ\nFŒ¸ˆì0¨úV˜(Á1p¼íİÊ7ÀÈCrÃ	¤°4¥¯Z¦À;²@¦2¯Ãñ,×ñC(;2+,· 2ç%[­P@µŒÃ’ú:,‰ªb\r’âÖ!;lÏâè‹P7¸¯²Ö¢Í£k–\"¦¹7’¦Ó\rØ'Šß¸Æ47c˜³P2äc;‘ä®¢K9åCrûz=ì´j3Õ İ¿`ê1ŒlÈŞ–Š Ü5hêĞí&£pÎ#&’ÊcÂjA\0x˜\r\r°Ì„C@è:˜t…ã¿W»Xä-8^Š…ã\"In¤xDqËc³xÂ`IÜ°¥5êú0ãƒ¦‹\"C–-¡iY&¶—&Rw'M­BÖ•AJi†T¾ıc¹n›¶ñ½o›÷Áü&Ôµ²œ@åÅ%|Xğ¿CCw\$£ÂHÚ8\$R 2ó<Ú‹°¹ˆ A!±hÄ¾“\"»ƒ€Ö²“©]‰3y§Ó2GºÏµĞ¸Ê¢õ&…K}¡D-\0:®22»ÁÛc)tSÎãYO)«Ü’ÆmˆĞnJåµ¦Uî¼ÙNKÆØë:ƒ0NĞ™>BÈ…ê?€ ƒV@È!]\0PQI1h»\"‚½B\rÌê’b‚	¶5D€µCÔÛğLdà„8@Eaç…PV¢[	Â#3db!ÀBlHŒ;±Aa½Ú0ó&DZ¢,5¥”Û#ÿ¡!}æ<”¨ÃY)… à°iqÀ¸#Å^®XÁ0\"!Œ4“u!™ys1ïmz\0 kÃ0aLÏù³#ì‡T¤c4ŒÑX0ë&Lìœ“ÅL˜â&JÉipÆ´²J):[„‚IvP.Æ`Ëš¨”Á<)…I(¤‘dÄen®ca+H³ß—0Û7°ÒrZø#Ç´9FânøÉhP˜§,ˆ:’BvÃ<í\rÄh Ğ¦Ba¼¬©„`©C*m&EÈ9@äÆfá°3½Ô¨™Ï;IF¼ó&š.l´£tV`Ş¹N©×%‡ôÎ™£»FâR\"hÌ ¨QjL¬ŠU-´¼‹ÓÓLÕU69Ä´#Ywƒ`+gœ1†¶¬v‰,-D×†Óc]KCÓô‘¦l <ªæ8˜P¨h8%©Ì´“\nŠ³3¡=Vú®˜ €°É÷›ØãÉ;N2(ÆVE’¿ŸkóHğà)c/U¬)iµ¸v¾ùë‹VbÈ˜óì¢J™ªFØ–ù6ìCHÃSqRÚb\$šâL™€*œâr©Š¡§TğşVÃ<k‘iEŠR½%Š6C˜Ê—„È»™·r1ñÂ×ä,[Ì,q±fzác\nÀ";break;case"ja":$g="åW'İ\nc—ƒ/ É˜2-Ş¼O‚„¢á™˜@çS¤N4UÆ‚PÇÔ‘Å\\}%QGqÈB\r[^G0e<	ƒ&ãé0S™8€r©&±Øü…#AÉPKY}t œÈQº\$‚›Iƒ+ÜªÔÃ•8¨ƒB0¤é<†Ìh5\rÇSRº9P¨:¢ša[L 	§:ùRåO\"êˆkú\r-\$ƒAP((ú*qe¸Ğ+ªİPéM¡§¨ÅıéJ\nä²YDZÇ9‚‹&ó¨€Ğa;Dãx€àr4&Ã)œÊs7§SÂtİ\rAĞÂbâNEúv¶˜í÷{ö2™Î¶LùÓ^õrt/×®TRƒÙßr.·”J)ÒL”AP@Q<í—¥ùÎJ\0Pª7\rmàî7(ä9\rã“´\"9î¸Â9·C Şã·cxèn`áÄã„>9ğÈÈí Ä\"M#ì‘ƒÇ1Pœ¥ájs(^¤Ç\$ƒo*G Å\$\" 9ªˆò¬£²	séIU»êòÀƒ²äÊzKêÙ.r‘ºzJ–rzK”§12Î#„‚®ËeR¨›iYD#…zşA+LJ6AùT\$4:8U1R>°d:?&EúûE–Ç) Fª„Š>\\Ñ,iª%ä`«–ié`\\=G95LhåcYË„jt”)ÎM•Ñä”NÄA ‰ú«‘ÙEJ¶µy^Z¡ bÀ§¥!8s–…¶]—g1GÑòA˜ĞëÉ[]\"òE’¶Xt%ÁÌE@ô£U¯%¹\\råÑÈ]/J	SU1n]œ…Ù0KJ2‘„\$î6…¤AÒ·¢”Id9~Í\r~bˆœäy}3G“ó=§³Øu8ÁÒ0cÎŒ<‹¡pÚ6…Ã ÈªS×š?Q£®âJá3\nÚ»t¨ëC–²2€Ü9#~ÏP5Z9jƒ äÙ6\0Â97CxÌ3\rƒHÜ2ÆŠ[g×Èı€”Kõê*\ríèÚ0ÃÈ@:ìã¨Æ1¸ã˜Ì:\0Ø7Œûğæ9#—\$0Œãüua-¢6ïÃ« aNÙ_¥ÿjŠ¼ äÚØë´\rÃ8@ Œ†ş9tƒÕ´°@-¶ğ3¡Ğ:ƒ€æáxïñ…Ã“¿BÁt23…ã(ÜÄZèé´ıá}ø¹ûğÎã|àEÙ*#âÜ1fÎDàŸ?âA8)áALÛ…VJĞ°¬qhy	~)@@¥!•ĞMCçA±\"àæŒ’À4·„fôŞ¨hzïeí½×¾ø_w|¯å¾ äûsíl¯¹´6 ^Šˆ>	!´8@Úûƒ£üÍf' Ş´NP qá¬İ”Z…œ{\rÁÒ\0@!\$ÄøDŸEX¯YŒƒz\0§znƒc~m¨s†çCºYà‡(´Cf„ˆ¡Ë9ˆNæÜëŸt(R?#’\rĞs1<8]Ha\rÌí#ä€’\"FI	xƒÃ\\Y1<\n (3”~RE	‡ˆ‚¢CÉœ¬PB¶÷s1DbKFJ\r+É`lBjoñéı“zoÎ	Ã8¡•h¢°äAÔD¨Q9ğï7Ñù£˜V¤Ñ¤És†V‘ÚL7‡Xr¨sEÎaÖ!C¥CppvFù£ä´C¹Óa¢-ÎöÁ’æè1††àØ¸s´ƒ\n †ÂF˜ÍIFÈfÇ(†¬µ’Aˆä”Rš5/\"¸ÂaÊ#Å|»•b¨Ÿ„Çû&C™:aĞ-rˆfEˆO™¡Ø	0åD A+ÂÅKàí1Jµ8’,[¨d\r+DŞ\"t@¢ÁÓ9\rà8‡S‰Ã2\r¯=)ş…ŸD^q\"ãŒv‚€O\naP5b¨L‰A&¢›ˆ Dri©ÖE‹ò>Sà‚UDXAÄ©`‚GbEµ‘Ğ*iƒª4şÆ\$ú]kªÌ¦FÌÚÑT(sûænÔF‡\0¦B` Óh'ª‚ PnÕ¡ÖDÄXë+…rEXÜ¡¥ş±V:ÉBHrŸÓşHÙ‰d©—]c,ˆÖ&Å æÊÎğÁ‚\"TV%å»BHsCM/½ëFóŞ›×~/p\nmÈ6ºòCkkHQê‡iE[¦´ZŠá¤39(¼v‚5Ä\r¯\rÑ'VB F á®<êÄñNÓ®¤“AA'LmJ,Wä@‘8c‘2m€0&M	±—–'…ÎÕş&iX 4C¤K\n#¸g94‰KÒb>¢®ŞQ3æ„…‘óz²\rÛ@¤¼@‹ñĞ/‰e5«2flĞA…ùù?dqRApOIøç¦p½\nŒô\$0Œ˜Ô¯öÀÄğæW+¸\\r­TŞJ³ãR >•Ç:1NÙXÖ¹—Bb´*hAã…ècÊI¨ •X'qD`Ç(€€";break;case"ka":$g="áA§ 	n\0“€%`	ˆj‚„¢á™˜@s@ô1ˆ#Š		€(¡0¸‚\0—ÉT0¤¶Vƒš åÈ4´Ğ]AÆäÒÈıC%ƒPĞjXÎPƒ¤Éä\n9´†=A§`³h€Js!Oã”éÌÂ­AG¤	‰,I#¦Í 	itA¨gâ\0PÀb2£a¸às@U\\)ó›]'V@ôh]“v¤««t©Üæñk¦Ì£™©ÅÖç ^\$õ‰:¢%Ä ô“»V¿'HXzí*c\n¢É¨\n›m!Ã@©YîÒÛUÜn¤é½„gDĞ^d©.Nr»Ñ¤µKG=1‘öã”Ä/ºŞNyR}'\0øÀ>}iºBJ„\$Î«Úï©éÎ§¨è¸¥AiÙVğ@Í;„ü<Ûdş¿ïBòş@pBJâ)Jr¢ ?(½¾ä˜ÖÀ‘KäÔ1Qrû(#bå.ËÂÙ\n7­Œ\0Ì mÓT«£ävÎ#ó6Ò-È:8V¼\r¤	#“ÌRìµ·P[¦Ó)ì›zå,©*r’ál¢—¶Ä´1K2í¿Êût¡\$íªÎò)¹(ç§K‹z¼G*ktà1tÄ(Š;	\n\0“°Ì4I\nyLÊË”…JQ¨Ø²JjœÈ\rêU>©ñMAÀ	;ÙS®Í£-.3.2«Ğ¨ê*Ò²½0İ¼\ns€E*r<§TéÊ£Hõj«?Q‚•&JpûºåÌõĞJ2\$²ŸSÓ¤ó]6àPH…Á gt†*?Ú0œMxAÚ=1Ï;\$å\rXU\ri+¼PªÜ,½<Í§0à I¤¡(`\\’¨Kµ‘i\$îa„JÍeZJJ=eÍU¼\$ò-xÂÓ@÷×”§ˆã€ùÔY~hÖ&ïš½n dÆì!n”9b1Éxu éZb¡Õu(÷‹zs™«‹¸…ğF˜”³#Ñ).¯sá9kR¹_²lÛf¼“ÎŠ¬İ¤ÍÕŒÔ\rƒ å­'OT¢Xj\"O±æÉM2¢g÷»[4&œÄ)¾€]ê—ı[ºâªWÊ),KQÇœ¶¾¤VæQU¯Í›\rW˜|âóób“áÛ]¶’¹\"Í#K(æÃ¸j‰ÂCw©dŞÒr”N7YD\0P1ü4=±ˆ# Ú4Ã(å3)ş#ªôƒèØô£c…›÷iøMïˆ¼)9cB!\0Ğ9£0zƒ@tÀ9ƒ ^Ã¼	Á…í=Ç¼ƒxrà¼2†à^xn!Ğ4Á^ò<d…e§âvı¡#æ\0ğ†|ã\rëwCÆl»Â’üY‰¡yJA>;ò<îNƒímî]T&8®O£\0M,uÃB”¤ÍJQ±#ÆåwHY¡%u¥U× –«Ó3<­å@şÓüĞ@H\r T{ot9A% °eÒ\n‡8;_„,Ñ-Â’<—‘{ò…¹Ò?\$¸õ›\$BU\r\r,yy&&é™­HÁ\nOyÈm\$\$sÈr•i%ér/*‹Şj\\†ÇÚÂ§<°J¬(–¦ªU5â<¡\$j¥4º—ˆŠÊ«(yšR§Æ<áÊ{‰ŠGŠ¹j\$éJn*¡¹¯D”¥MÃ|'b©17\$Ò­TªÎi@æ´BÎÌæÚdK‰Á>ò —òï@ìøğRn•äOŒ‡š_2©˜CbÔĞTñaÌ4ã€Î2’\$çŞ8çÌê’â8¨ªh\$w:&\"ôuM´€EµPëÄÅ\0JÈ#OY©!!¤M.ÔXÕI\$K>Y‚›äæ/K5ç%©,\\BHF{¢tyı>~*D!…0¤Ÿ\\HU¢²èœòNÑ\0\\dzZ‰YË7\"=ˆlíÂ¯8©V3B”‰M\rNª*İ&jz§/š TU\\Ÿ™<Jgç	U!M5}ÉtÆœ˜¬:¨¥Ø³Jf¼fùf=”Y³©AG=l4#È-Ä³vtö lt|päÉ)Ôi+å†«ñzmœ§98q?\n<)…Iz¼ØÌÉ#“MIˆ7+[Z’´Š¥Ø¬{!mâ«x…aRÍòOei„Pb2Ô£Û;kmÎU¹U¢ŞW[™Djàa‘5ÔIÔÙìCÊ¸im§iL¼eITôÕ&Æ‚ P|\r‚‰KszRf½™O.<Jò Õâ±‰©Wº-ï9ºD<V¥P‘æAO7Š³±%®dÌœÃí2á,GG'i+í “ÚõZ|7õé8´<òğ®!ÆÆİ¹\$ G™‡ÆJÀ&†Şƒ`+R„Ğ8¼Á—åZh¥ö­ZÖ¼ïŠ]•„•q—g­A–õ-\n¡R¨ƒu:°>	*ªT»v/Ñ±:èó›°›*½v òoàùƒ&ï\r'ğc3‚ŠWD[ÔBºôk9Œ^z*ªZ¼˜á‘§)°³Ü`iz%|n)ÔF«2øÈ‰~Õ!'êµFïDºb!w,U2i#×fh]Â‰]pœM¾©il +kØ>õ”¸ôJ¨®7Kâ%¢zû£XÜœÊR¢RæœÓÈœ©ıšÕşi¡Jÿ9fúù©k”nŒã=¡ÈcwvÚ§VH\0";break;case"ko":$g="ìE©©dHÚ•L@¥’ØŠZºÑh‡Rå?	EÃ30Ø´D¨Äc±:¼“!#Ét+­Bœu¤Ódª‚<ˆLJĞĞøŒN\$¤H¤’iBvrìZÌˆ2Xê\\,S™\n…%“É–‘å\nÑØVAá*zc±*ŠD‘ú°0Œ†cA¨Øn8‚k”#±-^O\"\$ÈÀS±6u¬×\0¢©ÌÊr')ÎD…¬-k„¥juiŸ@h.ÔráØ§HáPKÚúEÏ;ó¸…ªÙ…NÖİ¹ŠÖo:•l¥¨Õ…iÚŠ\\AæÎ¥²2œØìô½@€¯©zİ„ò–ÄêYòÖwÔ26\r¥Ó¤{õßg¿áOğ{\$„yl”u,\0¢™„ì4Ã;TV…8Â’Í2şÕ‡a4T±ƒpÖ7\rã¸Ü1ãŞ9(\" Â:#ÂÇ ŞÊ„ èc¨à8CqXác¼624dÉ*ìªcš<R)¡0uRJ^#Ä¬HEºÂ€«¨‹ru•åÂ<Àºm¹ÖV4Äñ ÙŒ)U«äƒ(?\$#p¯óqÖB NCç)È10JJ`±OSãèu’„¡ÚBdTÍ-éM9/‡[ôu–DAÚL1ir[´Äëv	ÔZÁ¥v…å4ø¥çU8“1h9Zu•EKâS‘‰‰I?###âX7å£LÎ€T(ˆZvXk>–NÁD¯EQP˜”±*u”c¬è¥ìÖ Œ)P¤:½-ùx½lÑ-’QÖO0*aZ°¥•®[)‰±w±7‘i^£#ò™wlªà>7‰ÖA°M«C)ÒëêÀM…„Ü…GYlBHúB-9Hò.…£hÚŒƒ\"ôâ8ÔA×#£×=ÒNÉ¤\\Ÿ(Êb Ò9Ä#`Ë„Ü07hº:©¤²xÊ<ƒ(Ü9#~® Ö…J]uƒ äÂÊGi(BjÍ<Ö¶Î©ØB&”åVÕäªúM`P¨7á\0Ú0ÃÈ@:êã¨Æ1²£˜Ì:\0Ø7Œğ\0æ2#—0Œã\0sxNı\0º¨P9…:æèÓnÌ1”ç%‹ÀZ xªzêJb ÑÀ\rqğÍ¥ºÄ# Û\0001ü Ç­k#ƒ@4C(Ì„C@è:˜t…ã¿¼>‰Cc8_«ñ6˜:k#p^ßT?\0áà^0‡ÊŞÓ¨Kr­ÕÈ£W\"@„‰wdÛJñ \$)V)µ:rHBN!J)„ÔFÕL‚3hÕ¡€ğKÑG1ç=¤õ³Ø{OqïwÀøƒqÏ•ó¾æ¦ÕZ»í}åPÚ0mjÁÑû?†‘ƒ h\rêø:7ÖşÚ8iFF=¿ÃÜĞ„…²dÆÄªK\$¯	UT®	£^båÛ4pÂßcZÜ4†Çš9”Nì9D%|C4EÄA·ã\\{‘BñÒ\$™ĞÑÚ\$BD0ÒC`sG(ìîhìÍ¸P	@ƒ#£²\n\n )6)Ğv”‡ñ[+æ²âÎ—N¨CkPÆ8?C\"ßC€r\r'ı£pÊ¯‘€rˆù¡¢ŞŠäÃóı	ä†*…Øë1Ó«õ#Ş‹œGÏ89£7ç¼IŠ!¸8:A àrWÁÜ4ÆøgzÀ‚<HæÃ½³VkÍ™¶S\nAƒeĞ N(%±®\nHÁR!^d¡ŸA4¤ş…;(À€üˆÖ\"ğ•&e ¥0ìLiY8fé!“xìeÄ	*€ ”‚šf|DRCÈ6¥(PBI!¼:¢PÒ¯‘R,jÑ2z£ç¢C©•Ea™\r×\\êBáÇ¢H“3QœÆ(!@'…0¨|Y¡¹PâÂ’ŸZÅaº\"öêàqk’ˆ)¥<¨ÓñØ)é¹BÄX\$BrÓÛ}¤.²“Ô*ˆÏê9\"¢\0€)…˜AŠj)*\n~;D3°‚\"\\V²ZKé‚MµŒå¸—Ñ.˜Û…\$?HÓ	‹Z;	Â[€ñ¬‘	Uf­]bõ@ˆœ1ghhî3]u‡äXĞ%®Ï#(ùY](ÀjÍmÍ”U„°²iqÔcº—ZñWĞÛlu’{¶’…Şpv“f_·è–C3‚ŠE#GV]ê+Ÿ®l*…@ŒAÃKxá‘úÊ,	™7NİŠè&LíÎ6æìÌ›ë’Î—QÊ&åéb&ÜN*‚èD qÔ-àMÆÓ„ßn„•ÉÆ„±-ÁHÃMÑè5\nÜ@Òa’R‹g¶b³1(­Äq&)ƒ®¸¬+È©0¥`ç³03s4\"²½‡5&‘ÿ'ö:Å<´¤Âj+E®\$ÎX²®‚Íwá|2¹[zè]ShT/j¾‹Ğ‚3LKE+ÊKoòRW˜Ş™Ãã¢«û5*D1i-M(•Ìá¯Z†\\¶ûkh=";break;case"lt":$g="T4šÎFHü%ÌÂ˜(œe8NÇ“Y¼@ÄWšÌ¦Ã¡¤@f‚\râàQ4Âk9šM¦aÔçÅŒ‡“!¦^-	Nd)!Ba—›Œ¦S9êlt:›ÍF €0Œ†cA¨Øn8‚©Ui0‚ç#IœÒn–PEc	Èèo·š˜«1v\"i‡1ğ1°Ên:FÍ79!HÊd0™é1ĞS]®q„ëÕò1PáE“yÔ@h‰Dè±ÂÈv4ßŒæY}¼@u8b07SDÚêa1_¤„šáÌÂu3Ü/ÅûÂNWV\"dç°ø˜”©ˆ…q8Ü‡*.¯Ìd£Æ³IÓ®\n)õMÆpQRÉ€¼å†+	;~dáŠ¦ã^î7(ä9,i ˆ0Â€Ñ?\rcF¸!€à±\"9cºÆ2\$°êü<›P¿ºîJ¹\r‹Ò:70k¢t§ézˆ£9êJ–’\nƒ*Q¡¢˜Ö‚+ËñÁ.K–6 ‘ú\"Ã(Ô2Á+:lö¬ã\\†ˆã(Ş6Ê\"–0Ì@Ö·¬‰rÖ¶­ëŠÔ)É„b—Ãzj†Š\"R5¯[((xì—BÓ°Ó<=iRÕ)i{.0«‹PJ2£Ê 4}\"‚è%+HRC¢æ-`ÒA b„P»#*¸Š±@æ:S4±kÀ˜•Rhh¬2 #šV†ˆ#£ß1¯(ØBÔaC!ÊH °ÃÌKS¨Òé¯œZç¸mí¿'4„Á”2P\\»W=K\\õz	uİ«›0Ü«ê	W³LCéZ‰@t&‰¡Ğ¦)BØó…\"èZ6¡hÈ2Zv4ªèŠL¹Ii³p¿')zÇ\0­\rËDP2Ü”ùzH)ºìÂ#•«8Ï-­Ş3ÃbÎ2æp›;b³¼ò3±‚ Ş‹%cpò×åã¨Æ1µƒ˜Ì:‹èŞ³eábê9jn¢ÎäÀ°Ú³¬P9…) ”b•i|¥=qSD7)(b2£xç4â^3dirÎ3„Éµ¨C–Ä1æ)HÉåğ4:C0z\r è8aĞ^ıH\\0ñúä,c8^¿…ïÂĞæ!xDvĞGã}¢ÎüALèJU—ÒC:ô”Ù–Öñ´WCFßIK>ó¼3\rÀ#Ààå0ög4Ïó¼ÿCÑô½?R;õ}o#Ø]—i–eÙ€İİ'Ağ’C~caÑà<&Bàt\r	ÈºµNõP¨p@MD¿‡Gˆ ËšÍ\\á¬<¬2ê­ğbn‡@Œ(F˜P!¢!Ü \0îjZèb4PH98€ä—€aÆå«6®ÖZÛ]\$M€Bøm\r¾K€€1'.|	cƒ/%í|@TCHoŠeğ¡äFi0¡ƒI%-Á ‚(Šè²‚‚tÜ@PCf%\n8¸ CI¨5F!B^m\"%„ˆ;¾R”)P±á¼gÊ[/áæ)@Ğ€«v!„E¬6ˆÚƒmY¨a\r% Í¨c\r ²º\"h Q¢fü9´I`I³‹(\0€!…0¤ i- Â‰›ÔoËØèCgKä‹6Æ å£òÜuÉ V9FEr²P¡‰i//Á¤2'À`Ê5\rI¡A“È‰³Ñu“‘*VO‚I&vHND…e¬È6†Øéêk¨f@µÆ¿'1,P\0c\$RÖ’ò\"jÉ Ps à\0 Â˜T’h¿˜@@Ã©+œÇò{R9\$§rÛ\rd`Óè³I©5¥†ÌŠ†àÌY[¡j\rã7Åî ê%Eæn~K4\0l	¬¦ªD²Òp¢ù©4F¡|`©f:%HL·šBÈcF@DÇ3hşW±€…4Ç¬évDHÑG®u¶»6P¬ÃZ´G”f×¢^¥”Zp`%>W•À¾lH¡^v2Â¯{¤,‰šk6º\$Cke(|bYAã»&¡™©R{V A.B°ÊOP¨h8dRrIb};ähÅ6wÙ±#®»€f ÍË#h%†R0ÔRÚøAèã\0FŞy%NA¦Ö\0ªT/‹Ğj%DX:Z`äÓ\0y+‰Dã®Hqc/F!µ¦bAÒ %p6œ×®‡Ã|Ê¾ÊdÔHöøXÓ”ØA07Õ't¤‚,8Ryµ²K“jSBö¥9´o‰yÒMq­Ÿ_n=‘SX¼®)ğ¦FÃ,,0à(%’,c)(¬‹Aÿä2ÔUré9F’—K¼`QH—–¸N\nŞ±_iñ‘'@»p";break;case"lv":$g="V0šDC¨€Êsˆ‘°Òe1šMĞ³¡Ì~\n‹†faÌN2šOFC)ÚsCÍ³#&t &È)Ôõ2œÓ“¸F™˜DÓ	®m…› 2‰!&r”8	A\0”æBŸP\r&ÉA¸Êe£NgItø@\nFC1 Ôl7AGC©­Š¡ÎF–\"%I!çC}‘j‚\r'H(ˆaº¡g©p€Üa;†Öi>)L—Å¸è\n\$ÉpxXş`A{7³ìA¶»®ÆWÍFE(Å…]Íù¬æ{f\n)˜Lûè§#•Ì@Ì¦ìÑÔåŒ‰ôuú-&›ËÎE9N¨Ë„˜vMfi¿¿Ğ»˜røì¢NÆ\n€\ræC+óµ‰\0ô¿* @5˜…áŠU¿‰óÈ²c+,2²Â®3a\0à0CzŸ	#Òˆ‰\rãS¥ˆ(ÜáÃc‚”»Àª6ª£š²™¥±¬¯ÀÒ9\rjò<)½cJÈ^1°xêÛ<n¢”4¨ÀP…/c(*…XÖ®F!D2ãkÎ½·`SBş\rl\" ÿ5l0Ô\nä=+5, ƒrÓ!éBˆ71¢PÂé©‰âŒŠ£ AHÃ˜ÑTcGÒ(	HZ>—A j@BjÀ•’o‹æ5£Öë!a\0ìÁÓBZ90•SúÁ\r´k2E\\,ÔI1'T1H8\"Ãk<'=ÒÁ&¢B‚U(Ilh§¬…[Ohvä²Šª´PËf¢¡pp\\VòH ×@Óu]–õÇwÜ×’|ÍŒãÈ	@t&‰¡Ğ¦)C È\r£h\\-ŒøˆÎ.Ø–5‘>„âè‹86BJ°@½ Ì¸ÅF¹å”Œ£Àè2È@ß˜§ÎHä¢¬lhØ:TÄ¬tXÊ=mâ–²yªr¯hôC;ZÏ:B»/’N¡¥Ëìc% £œ‹rCyZ2³á\0š—è”N…cÊ¡¢Vâuj9|¡Ujêv´ì¶ºî¾”l!Ç²ìäÓ@<ğÒ]·^èİqZ{£©ïı¬¯Ûæ¸ïğÔ9Á%MÍ´m\\NÙÆQ\\w!‡gÅZPÊšUí)Hô3¡cSÅ£«¢FÖ¬.Ñ ád¡)¯“	ÉÇ'>0ì€ÖIvÇ×êi€x¡\rÊ3¡Ğ:ƒ€æáxïõ…×÷ 9ËĞÎæxÉ™²Nf„Aôh‘+\\€¼0ƒæ”B\rÙ½ %”²°ÄHC#ÿoÜ´PÖÆá»:e	»òO‚i¼eáÈ¶æeq\$Ie~‚à@öÁİ{ï…ñ¾WÎú_Xw}¯<‰—âŸ›õe¬½˜¿ Üÿ\n°>	!µTÄšB&<ğ”4\0hÑ«ÆIîxşB·hANed=›–2\n˜Œ!£€á¤Ä*…Ëìè@†%¸yCš¨æmÖğä°P±šv.z†˜öP;OnĞŞ!§&İÚ©Ù%t—O‚q¸(¸0£4µ	³f (€ eoCŒ0Å\$h‹Qx¡kjö'\0PUL(3&ä2›³lOšŒ½‘íYâúŸ%¨p/K%s2dJƒ3ras¡ÂBÑ\0MÅ“ÀÈëŞ¤&d92†Š]Y'\\4¼c×8!Y/ ±ÙoM“×5!T,%)… ŒpEò\0f€z¬’`‹Ğm ¬YYğÜA^ñ\"^g89¸ˆöŸ™Ài’É>Vü¥A9\rğ<b‹è/Áqpn”˜b| šá^Â®:ÂnC„eK-öT<ØxWƒ“Æ3j(€¬RrÚÕ¸lAg­ÁğÎqÂ€O\naR+F’#—=:¦‰,”I°Ô˜\\Ÿpn‰<S*PÃ	”52¯&CéÉ¼§nmÌÃ4†VˆÀ”jOˆ7&¨–i²M\0S\n!0˜“2jMÃ›K'‰4â(ª52•Å†0ˆC,æ2ˆ:é5ur4Ší©fêª˜Cåè¢h…‘5¼J„dg¤ÛBmŒSo·V±u[âş»®¤¢a1ê<›]©O[¦uã<˜ pÂ<\r€€¡¦ÉUÒÜ‚Ş‰•¢”#¤ô&T*`Z+¹-fÔö\"™2Í1B^ÁÛÛïfI|¿dHş#kıfA›·\n*şÂ|)J—Uba-KpI[,a½&fÈBëé¼OxÑÌr^±-ªãº6eaP·?k£Ÿh©,.¸Áœ%bù\nÆƒ«NÃøñ+\\Ä6›eòˆø9’‡¼Œñ†QØ†(kğ!¼Ê÷ğ:±W­2\0PK?DO„R‚uÿQ\n™-Ù¬\"IÒ¾?¡K,‘çœûĞœª8R6Àòo8,/{yğ>'ÈùŸCê}º¿äı\":ÍaÜ½HÁóÓGä,5’İB”–Ä\$ »’é 0";break;case"ms":$g="A7\"„æt4ÁBQpÌÌ 9‚‰§S	Ğ@n0šMb4dØ 3˜d&Áp(§=G#Âi„Ös4›N¦ÑäÂn3ˆ†“–0r5ÍÄ°Âh	Nd))WFÎçSQÔÉ%†Ìh5\rÇQ¬Şs7ÎPca¤JŸNpIñœÎuŒŠ†š\$ÕDŠIES%:šè&ëÕò Âœ®RX>¡.–M§ÄØÒ 5™nPƒi”îa¡^˜œÌã55šMÙûù“ Ùd¥9Œ¼ÍĞ Fè„Úb¼NN¸SD›{Â¡KNxœ\\@Êt2œ§3tÚ%><óñ…é´B£ÁŒ ¢=ãÖU7ÍÆó¿²r7œ¤¤H©‡\n9Œ©ĞŞ2®oš,éƒò‹ £˜æ;¿*»œ£\$sŠ£)š*:¸®;’¡)JjV©ª°¦:2KPœ7¸ïÊô0²CZá¥SÎÙFp¤›Œê\nøÆã,Xë²@PŠ‘pœã c‚ê»¯\"[ú(Ãb(Æ	ƒzré1 T³-±ÛB €P’ì&Œˆê…ŒŒ€òì!,Ú1Mğ ï2ãX!hHÏÁ¨!Ç Rw£jZ¼ŠnÚğ	\n  ¥ëp 4­®hŠÒÌ¯ä‹FŒCPË=	0à4I½ ›‘„Ø3C*>ìC	ĞÒ4U‘‚K\0(5JÔ\$	Ğš&‡B˜¦cÍ”<‹´PÚŒƒ KÓ)Óú‹“ü6@*P@üÖÀÅn)+Áo£Ã°7&Hæİ§Ñ‚2\r‘E&€ p†œã0Ì¶Ã*J(VC\nm,KMdŠKÓ³*ÃŒ+ºÌIÃÆåµ Ù„ËˆŞœ¤)XˆS.ÂÊ‰>¢¸Ñ¬4¤Í£kr:\$²ş+Fƒ²¿¦É(¨ì¦(‚˜)\r\r|´©Ä —(BÉ™`#–GŠ´˜”zÔÍZ6 c@ä2ŒÁèD4ƒ à9‡Ax^;ír‰¨;!sò3…éğ^2-(¨Ò´…á}¤ŒÊZã}x&h£Êƒ«8:di„)ÌœÄÍ0«jK)U¹Npâµj[Å`ªD­Ç…Á¸kÛÅ²lÛFÕ¶ûvÙn;ê7n·R}v÷”=¨ÃÂpÁ\0Çy\\¡TÖi#=F0Œ^&İë2p¡@N++VÉr31yğÑ\0Œ#´„½0§« ä3?-,Ú0ŒÎÀäˆ£Æ˜f¤}Ê'ÚC¡H(\rW”×ÜY/±w˜Òú‡NCÛ7ç’ˆ@P&¨ğ‚”\nU±h{Då<¾Ò¨U˜àƒˆ|â‚á87˜šbIÙ='ï•I’ôâƒIQ8¡¡ó”\\Š ¯üÜH\\y È=¾ĞĞCHfA²3§ùŞPa;l½=’|S\nA\$D¤5¼BŠá¬³Ä~a\"¼z†|£stÊ43(ÑÅÆ%dC·3êá6±õm‘ƒå,–\$‚‚ª!-äh“s-LÃÑŠµı±V «J¹ZÆH4æàşÜ”?t.9Ö=D˜q\rÉûJa@'…0¨é“gHhı\0–C˜:¤	ÎŸÔ8B\$ñ:§aV›åÊeÁ\rër1B,FÑ*Sä(„ÈrNIìÌ3,@Ï„`©‘¡½‡\nqêS>“Š3\$©œÍ:EjNÈ)\r±‚I­	Ò6&Î¦…½CÉÛˆ‰ÈÜ&ŠãÒ¢/ğT!¢€Ø\nÃmdn„3fQŒûÏ#f•¨\$E:Í,<ZÅš\$ã\\Y‘ U\nƒ‚KGŒP£¦}&h´ÌÒ˜VåÚ›xZOC“<=j]|\0¦’NÑŒ	.\0¦0s^*MJµĞÇœÖ^…Qœ4¼ŒÅY–J\"T’\nİk*Ô¼Ê!²ê®*¢]ØlÏqçl¡\0•Ô|Uõ\$ˆ³ğä©ÔÈ\n	llÆR^‚ªrf3h-A£šú@Ùa4ª¯P·˜Xz‘01Q0æ";break;case"nl":$g="W2™N‚¨€ÑŒ¦³)È~\n‹†faÌO7Mæs)°Òj5ˆFS™ĞÂn2†X!ÀØo0™¦áp(ša<M§Sl¨Şe2³tŠI&”Ìç#y¼é+Nb)Ì…5!Qäò“q¦;å9¬Ô`1ÆƒQ°Üp9 &pQ¼äi3šMĞ`(e1¦˜aÊ”e™¯F–®2•NKô‹&‘›.S@Udï\r5‚Š“û\rg•™ˆ.æ« («F7@ëµó)´Âc4/“|öe\n•s\"U,8Ng=i<às¡IâüşRvÇÃhÙó”0İÓèqzÔ[	²9cŸt¾TV†ãó#–œ©Å¾ßğ8=bFï20Ş:€Pˆ¡¸NRX±>‰(Ê:¶(2;¶íÈî¦Jâ¼:&¯ÓÂˆ@;8Ï+ÎÈ£Âˆ9«Ã˜tªjÂ´”(É+Š¾¬DbÑ!i+*“3M<:'Rİ\rC#:½#Kê#‹f‹	È¸Ğ¯íê»Œ PŠ2\r#¢ìÊ¿l\"9Î(Ú\nğ¨é®ÒP‚“¨êdïˆHğÔŠ<Häê6IBr¼:êŠW5„©HÄ<¥`M‘QŒ Ô0KÛN¡hHÓAˆ-'îòêìC\nú)®É[ë<¬›º#tÊ	ql¼¶ÃJú+:HÃèîXÔ¡=€ä…,nı2×hÙ¡£Ô²QÉM™\\ŠIiY)¨Ü:B@	¢ht)Š`PÈ2WhZ-WˆÔ.²²Ü©¹‹•d†´â›p0¡–zª‚L!ìŠßøJqlaƒ\"˜ôš‰ˆüïƒ ä×6Ş3ÈòöšŠhmIXÓüï;èA@Šó°âN“°à¯O8X\nbFí\rãƒgB\$KÒö¢Ñãjô:Àp*=Kæ_Öy›Å•fëÈİg™ò9`ÚBŒZ3S¤éj&H:ŒcH9¼® Í?NÉ¨¨4\$ãZ§l¬Y­„É¥/c–v1¬Qcèƒ\núŒÁèDÜxt…ã¿4&<\".Ã8^™…ã\"Ä¡+^İ4Òİkaà^0‡É¨«B¹Z¼¨ÛHj^É¦şj;‡B¼N8A•5©¼°BÄß%5'~²qœpÑÈr\\§-ÌsC¿9Á¯\\ÿCÑİ{õ?HDª‡ÂHÚ—6©šV†ö] @È`s¨èy7¨HªãlÑÈP6Çy’6öFˆ©#†Üİ2Ô2BHùœ”àAGv•3…€ŸÁt.†MJi€„U¶6æàÖ{WNÆ¥ÿ?¸8GC1#‰”Â˜uìE‹ù©E(¬¯‚ŠPS@\$	\"571VÀ\n\n¨)&«²’†s\nb²PU¥Ü;+¢€WË<CŞgIùFÄœš‘ˆ^	d;Cğõ(µîMB+`dËS’¬Ê‰E ä\rè¡g¨ÎĞ¡iG.)š˜]¡\0w‘Õ­§bğS\nAŸ@À@±‰+Ll-©‡\"vñAxäÔ›“’vOO@Z\n\0Ô’3êaä§!°\0£jVÉ†ĞuY;¸ŞˆÃKpNzU˜G!âge™Ã~rZqÓdË’Ã `ÛP\n\n<)…@[6I4m*,¦ÌŒË‘z†ÄÒÂILğqÌ}h)ˆçÛq¸Åpê©U›¶¬ãHYèS\0S\n!0’4l©.&	Şh8àŒ\"q©•„é›‡%TuæŒû9ÉRP’¡è)òI&>›S„ú«NRTÜÚ°4ÄiXd&ª=0›Vi'NI%iÕ1C•:TjCcA°Ï„@ĞR1©B†0c}\rŞQ#Jæ´\$Š<R	L’D *…@ŒAÂF\rÎ ú3˜0Š+AKÖ¨óVá)#ƒW¿5R×êRÕ5D~±˜le¥ÖBN©¸H	Ã*ä2¯µV¬	=Q9‡| ²‚LÒPR#® ÊV£@™#ÜûdD„[cº«4Ë%•²•\nt£Áœ	­}ı ‰P™Zs‘D\"èp¡8RaqFè8÷ÃåMQ\$¬e‘Rjì‘«4åşÒ/³©	mÄ5/Š[KÎûò¾ëğïªjgÕŠ§0Ñ\":‚•”U‡Ôï\0";break;case"no":$g="E9‡QÌÒk5™NCğP”\\33AAD³©¸ÜeAá\"a„ætŒÎ˜Òl‰¦\\Úu6ˆ’xéÒA%“ÇØkƒ‘ÈÊl9Æ!B)Ì…)#IÌ¦á–ZiÂ¨q£,¤@\nFC1 Ôl7AGCy´o9Læ“q„Ø\n!°“‘Ğòp…‰&ã=.da1OÍ©IHÊdµ^JfY´f-z¾_F&D‚L7Ì}6µ1”¸ÁÎË2Ÿ_r[@†¥¦›Œ“è./À›0féI0ÂgŸ·Ü		ŸYu ãuâ	ö\"ûÁáí\rünIÓL‹Ôx[ùñÈSÁÍ»ç–¼×p¹yÊ¦ãY¸Şw¦BV‰IÂtÀG£Cy—V÷:Ã˜ê‘­°àcºĞ2%\"³l6-Hø@1=-ˆ@0ÉÃvÊ¨\r\"ˆ9©\nR˜“\"ÏòR)K	É€Ú¼¾Ë @é¦CHÈ¸-†Là‰Ì`è;!O82¬¬bÒ0Îr¶ïBæ…-£°Ü\nDá:n2Ù)ŠS4‹Î°Øé­‘`òæ2ˆhÉ	)\0ÍcÚÿCPÂ\"ãHÁxH bï§o8Ğ;-\r0ÚÑ(£¿±C[&ö PÍŒ‚øAÃdš\"…£€ŞB3&\nƒJlŸÓŒ;3É¬[e5)µ\$ ¶C ]7Íc-l 5ÀÉ]O\r},\$Bhš\nb˜2éˆ¶×Ú…+^.Õ´òûÎâ\" À0püf€©w0¢ÜwÊ<\$r7İÍê¡`RİŒ¡jf6£Bv<¸\"ÈŞ‚.Ì3SJ«¾…Hğ™,„­*\rãxA/Ìè¬1Œoğæ3£b92]ÁcQ3·ã\nØÇ(“XÚ¶bC(P9…)Hª:Lu„˜H\rĞò„1‰H¨43ikˆ Ëà@ Œ™z.9dÃàƒ2¨x0„B|3¡Ğ›˜t…ã¾Ì2šs´áz–¿‹jgxá}¸¾ò`xŒ!òRa“[­‰\r‰Øàë¹äÌX„¶Xİ6Ø‰Z¢9T2°å^ <'\r]¾³­ëºøé°ì{.Ï´­›Xå¶í÷]ÛwÛªŠ	#hàÁÅó\n½ï°´^²2º=Ğ35®XÎ5'm£+KÌÚ—bpZ^.åÑÓh9ÒC¨É5ò%.„ÑBãæ¦é¤&Œ/—9EóXÂ3X(ëcÙDÎY[í ™>€æQx g5é†’Üˆ})ŒH;#b~P`‰~CÔ‚‡BvªŞ(P	@ÁH,‡M¸(( ¤¦öòÊY}Bô”„5àEßS;FG4ÁU^aÜ‚5e@ .ny‡fÁœ<†ÃÒ’Û9-f¨¶?34ÃRğ|åHŒš¶°Ğ;eŒÀàÄœ‚ANlpĞCeá¯¾ø\nFa¥%ÄØq‚S\nA}òSJ²Mn=ğ ÊfŒa†ğ•Â\\Lºa-Ìˆ3ğè”J`oa¯‚8‡¡šP¨|”„’\"XFÑ7 –šàD'ÁÄ:Ÿã¬™1iª\"˜ÓA€±ÃEJkHù­‹qŞ†wŠH(k‘ÒAĞ\$˜öPæ™øš¦T72cPå[Ø'°\\¿>T>CZğ\$Áœ:™8°ÔÌA>pPõ ™rÌÙ#ÄÜ‘Bı4HS\n!0’fEZÀF\nA¥§t¤q~˜}†)(Œ¡~(aÌğ’‰H'\$-FdpªNeE#>çY-’”àš!¯‚¡È„«¥yN\nå§tö¢Ø\nÃZ!@å—æb=M6TfJ“vöÍƒİGq”P¨Âú¡œöøÿM“Y“s„f‹—Z\\®é½j(eN¶¬ˆè	TqJxŒƒrnÀPEªjU§Hs*’	ù‹-<Ów‹‰s9†Ç‚Ów5ˆÃó5ÆÂ[ÕDJâœØi)fö±yÀ·Û—;ğXc´	ù'È6ŠL­+U?®Gx+àÎ£‚ZcJa–ª\"ê^«©Š•s…¬MŠı9ÎğT0	\$R½`}.á”";break;case"pl":$g="C=D£)Ìèeb¦Ä)ÜÒe7ÁBQpÌÌ 9‚Šæs‘„İ…›\r&³¨€Äyb âù”Úob¯\$Gs(¸M0šÎg“i„Øn0ˆ!ÆSa®`›b!ä29)ÒV%9¦Å	®Y 4Á¥°I°€0Œ†cA¨Øn8‚X1”b2„£i¦<\n*N#¬Äòt£ãæ³(…«7dØŠd¿M@¢!¼ÈaÉáç\"‘–Œr20Ögy¶j¬u8GpPö*@d•™r3Q¤A5mñtCH(´a8VnWK±¸ó¾àp„j1¸èy7rB\r‘çhÄLò8';–Ûa—ÜĞ İƒ‡µY<ãĞğQTç}B‰]ˆ	®4y1CÎG¯i¸Ö7\rì¨9Cxä›ƒ1#˜Ê×è*X7ˆÃP8@Ğ¨ác¼2*p+¸ìéx<©(d7£:V¹@£Ó¸2¿hA\n‚¦ª q3–­!êâğÏ Ğ\nÜ'£lhëQc)(-°Æ=A¬0Ò Rp¦‡© P2òPè9.ÀS¿ÀÏjüÀ@,\$A©HŞä\rƒxÎécK°í+«°Å70pæ5Obt3¬øÈ‰Œ‰30:!-\rN}#IÑíî1O²Z°\\•b\ncĞêÂ2c8È=!ê0Ø¡¾Âœ2ÉB`Òº€R\0è@L»0‰ŒÌ§£HØ	Ã.;Œl(¨—ANBRb²›ŞŠéA6‘2vèæ”£Ê}2Ù\r”7É\0G7=Óe&·hóqW-âê^ilƒ£¯à\$Bhš\nb˜\r¡p·@‚è(\rö)x×£Ëpˆ¬±cd¨3¨ Xôr9ä#–Nê8İ<ùzm] Î8Ù1¾H*„ä#0Ì‘E‰°§&ƒ“ï:Îì›~×ÄÉZZ:²î0Æ4!c“D1DõŒ!b0Ôêîœ1\0005p|©}®®ˆèì]šXÉ¦ªã. :Ú¦ÀYëÓÔëºş­¼lYŒÚlôA´®~Ú íéœ‡îz–í¿ï3¶·¾kÃî1p;\"Z¹¨<7:&Öîõ}Cm¼Ÿ¡ğE`ì\$ˆ'UĞD«öö#&Óo±‹Ô˜ê£|FL„â‚43£0z\r è8aĞ^ş¨]gwp<3…ã€Ø¶\n\0è4æ!xD6S®L‡xÂhH(Ô ãÈÏ8ß:ô©¤O×ˆØÜ5#A„˜¬RƒCø(!œ”©¤X‹Šö@¹â¼w’òŞkÏz/MêšG°•Ñ .{ouï†VZD€n|Å@õv÷‰q†Iö¾ò„¹˜n[2”àÈ‰\nƒ^1eğƒŠH!,(1”À%ºO_¹@ED†%ğ_¹~FØ;‚\0 6\n¡†ÆøÙ‰BYA°“ òƒ2IJ40†f\0…ƒc ¡Ì3XØÒ¼jRA ğæŸPxc3¡’`ØÍ)ˆ3½¤i%›à\n¢íg\"Âç\$ä¬—FÑz0\"R^LI™vP‹eº²` –ÂS\"<¢BäƒÔ;j2´\0RÜbš6ŒLX1D±“€ØJàäÒ%5\$‡1àÔååiŠ„´Ø¤<Z\nÌ!æ¦#Èœ‰£“Î¾F(ÈgQø ‰hn=°Ümã\$ö-hi!ã@Pƒ@ijn4†w›gÄ‰%²éÆj§4è E85‘\0@Â˜RĞP)¹³¦ıWÀaE1Ä9ØüOÜ®sÎµ‰£PÖR›‚pää“ÒÉSH8#ÔG\$è¹#¦rLMäÀ~¨yrDÖxnÂcf\$¹;—²ßR m?á¤Ü”æBÃz!’Ô…x¢O0›„»jpP-Ò¶w\"ª„%9aªÔÕ`ukyÿTBæ]H„: €æ†j\nHèc!ªÁ2wK_Q™K\rfØ)…˜áÉ€¼ ¥È;‘ÊDR¢’MWM2â0T\n\rVK(Ô©ĞË—!ì4#<‡Ë›Â1D¥ò>ŸÃÉ6¶Ê*ÜÄÁè\\3'Á¤=M‹…mÍ ¹·K²m[Hy¦ND¡öÛ`.Òğ»—@È]û²ù/»¦M`†˜Ã`+\reT›“Õ3Ê9IˆDœÃ³ªSQI&Á,Ë[(ÜUI-&O\$™¢Øbˆs1AñH*…@ŒAÁ6¼wéÛ»kÃj¿\rîà©s9y*¥º€‚\nª.¬Cl[ÚõÃh~háÜV‹ñv\"À\rÒµÎ\$ÜÓ‘Ò¸1ÔS]äú7†úÀĞMƒ,«iÎÛÈÌA\0UÿWT¿–€I¡³6³ÊşIfŠ[[Ä¾õÒºT¦_ÌÄj;èÜ×r5›Î{·-ÁN©\0Šƒ¡>çæK”#¸½ÌìÆfƒ^³!£o\"š9	63\\Ôœ\rF2ac q|Ï>çqUçÒô9²t%ef¦^\rŞVW4\n³¤®Ä£9áÀ";break;case"pt":$g="T2›DŒÊr:OFø(J.™„0Q9†£7ˆj‘ÀŞs9°Õ§c)°@e7&‚2f4˜ÍSIÈŞ.&Ó	¸Ñ6°Ô'ƒI¶2d—ÌfsXÌl@%9§jTÒl 7Eã&Z!Î8†Ìh5\rÇQØÂz4›ÁFó‘¤Îi7M““Lxæ 2fãM\"şp’ÆN§CI°Ó¤¢µ©=v:LRS	ÎpM7™\r3°I7àó\\œc*i¯@D#-Ş½œMçQ Ã\$¬FNYQ³je¿1G!† :6×pG:Ë9¹.ÇjY'‚›ÍØÃwf[2è˜jzĞ+ºríø/«¬·vt›Š{ûÁœ\"±ÃjğÓ	-ŞB¨æÓ\n£pÖ7\rã¸Ü“I°äœs4ÎŒ¬\0Şä8#¢&:ò³£˜îº‰À º3­P@:§Œ:Ê¡-I†ZÄ\n‚¦ª©\0Ô¡5íŠp!Œ,\nVÉ—CjPË2ğ'ãÂKÂ„º®B“Ò2½Ã,2¿xŠÑ9L3°ëÆ±òjèı%\róşñËLš€®“«Î‰Ï2ÜŞ;#3lå!Ã @1(HÑÔ‚Š.@A j„@B‚l1³è8»#eXƒ„`ŞÒ¯b{à”4ÂbŠ4¡ P‚õ½¢šJ2ŒkŠòÉ¡jxÆÊ³ ‚¯ä Êä¨\"¥)[%J\$öZL”%S°]IÑÈÂÆ¯÷VÃ'ÎºKb@	¢ht)Š`PÈ2ãhÚ‹c0‹³Ãb¼NûšÃJ­ƒ«ª	r[\\N2¿ÆŠ¹v3<WJó:\rÀİ7‰d:7ŒÃ3j§ä•2)ÊXô\"@öŠƒz€1»R:Œh2@3©5d»µ!c 9h7uÏ	¯\n}œ1c(P9…9‹µÈHåœI¨ ÇÄz0æ›§-ô¿ŒÑ¦:7á\0‚2g>³µ,-` ƒCh3¡Ğ:ƒ€æáxïÇ…Ònó®ƒ8^”êBòÆ<AxDsNsúã}¯gmr¸8&».F1'>C¬ƒD3ìîÅ\$[àÊõ¤Zp\rïÂğüOÆñã¿#¼/8]Êòãw.<c–7<¨ÂHÚ88Ò“ÇÒtØ¸A):-¡ŸpíxæéêP:'~tÈû’ NC2yÌancáP™0Æç˜w1¤˜Í¿\0äÜ[é a™İ‡6ˆÚšCJ\rí0@£¢t *JDá?2Vù5Á¡\$1²PØNO(à‚ÕÒö!z?D@\$F‰ŒÌ6\0 ¨’NW’A¢dxÂ@Ø’ÏÕ€çõõ‘ÓˆcN:ˆüé¡D^•w=\$áÂcHV®/Ø¡ãšN !}Åü‚D°ÂAU:/¸7ïR,ƒ§H™>rìáÔzd0£PË{íBa)… ILm0¤Ü-…Â}‘‰t\r­\$–nNßœADì3\n“PéA(e¡ÓJ÷Èü@F0ÃRh—` Eäµ(ƒÎ%KŒ„H<›³\0aQ\n„\rÊ8è3h«Êò1&Ä	»¹8@J*²FÓTÃ®éTxS\nˆé+˜xÇS° éjiÈğ@˜ƒ u!d¸êÂ|Fft|G>“TĞKrq<!¸˜uSa®HLgT&‰’M j<»\0¦Bb1‹\0p‚\0Œ!ñ=QÅ G”D¦Ú„foH(£`r‰:@e œScnùÍ	£&+Šš›ZnØ‰ó5tñFÒãdC2h\\K’§˜'T—`\ngà6°Æc•}\$!Hµ†#i?r²%¡À–„ØAj²HlZQÍ˜ÕB¨TÀ´pÜÙÍt'pÚ(²3K¤A&õRÂÔx¹.Bv…&P§æ;”#XÇ|‚£6Ù 4A˜<¯¥ˆm™<i‘1Z€ş@QF´uÉScƒÓ+V%à5Ôfik]m l”ƒ’Âp}(Õœæ™–Arl	ş\n	¦%±†.™)EL'!¤Ø£Â÷Î2Œ°•ÛØËÈrˆ¢Â`ä\$2U¥d±ÏøxˆÈ?õJrc%¬.\\—’ÿgŒáÀ‚¢Øb(Cš¯G1®MSÀ";break;case"pt-br":$g="V7˜Øj¡ĞÊmÌ§(1èÂ?	EÃ30€æ\n'0Ôfñ\rR 8Îg6´ìe6¦ã±¤ÂrG%ç©¤ìoŠ†i„ÜhXjÁ¤Û2LSI´pá6šN†šLv>%9§\$\\Ön 7F£†Z)Î\r9†Ìh5\rÇQØÂz4›ÁFó‘¤Îi7M“£L„æ 2LØ\n¤ŠA(NgZöõÊ¬°hAĞÂb”Ns’)’¥/MÇ8Y¤å±f6h8€äe¿ÙR)ÉdŞu2{:û-6n¸s¦Dàd0Á ¦œ?Éœ”ğWmhÙÜ•BMæê™¸ë/•i³ÆêH+½à2ˆ0ËìÃ~tİû¸x8(ˆ”¬ó^\$´Ãzz\n£›P*ÃXÜ7ãrT97c’r\":,ûDø©.[Š:\"Ã¨à¡‰D9ëàÈœŠà@38qs\$ø©ëÑ3H3Va–°ò°­«ªh@5(m“hì¿â.Œ—Cj‘?ĞËÂ C!0ªò\nC+ã,\r\0¯²³J©/C'-/BšVáB+É*µâ`Ş¿ÂJxäÉZŒ\rêüºÜ¿ĞJ2òƒ4=E¹`PóHÁàPH…á gL† P İŒc¬è&Œh…„bÁBxäÄ°3ªŒ© P‚a”ëİ\0kÍc8…©èÒÁ¿õ²F:¼‹Ğƒ>„ä–µr0ØqxŞ4¥Ib\\¤…ÔmiØl8Ì¾'–Í ¤´`PÂ3Ü€P\$Bhš\nb˜2xÚ6…âØÃŒ\"ívä×¯Ğè]ófë¾*Âb˜%x`A‡EØrÉuõÒ&6lò.6?\0S|à%ïˆŞ3Ãc\0002»(ZZ¤»¶£^*\rê\n|<„C&1¡IÌ:¥5Tğ9…ˆ(åœ]v¤\$ÀbtB¢ó Á@æ»#\nJèQ-®w/*ƒ\nr*8PmÅc#pÎ#&…è£ÇŒ±)€x0¸-¸Ì„C@è:˜t…ã¿;VW/ƒ8^•…êK©¼axDqÎ‹øã}–¤mŠÈ85Ü(Ã¢Ä‘|b˜hC¨Êµ*í'<™`&´H2`8DñM^Ít\r¼Vn{«¼o[æıÀpC¿	ÃO¼@åÅq˜ºWŒò!°	#hàäö§1Íbl<œ:(Cš'£[â©1óÚ}?;1øéng;°ìKˆåÀN>°Í:Ü'A ø†ÆäwXd¤Ğ>ÕÆÒğ !™Û\"xrÃ›?h)İ¦@§ÈtÏŠ\nIÄ%ß'â\\I˜#¡\"½#V¯ˆÂoF­Ğèx\\IÀ \n (\"Hg¡¨ `’¢Ì‘M0s\$%„“‚rÏ}€çğ‚œbl°ÎRˆ‡æê ô@`•PwKÄåBcÚ²¹3&\0;6Ttü6çÈÃ¿WpB’|¬7\0êˆÁ#wJ ;@ÆA~oMfÂŒÚøo}HH!…0¤£Ìm1¼œK²ÖOm6:âxŸQ<ç‘®˜—ĞPÊ*6•Ñ¡íäôTJšè3D(Ó.€]‘r0&äÂG½ÖºBI&üÄD>E‰[æ:†ÛªrÌ‹ÍÙm-¬˜G´\$ÕS­|‡UÜwdxS\nˆÜÏ…¦Æ\\)éTö2À@—C u!ÄÄë'Â€LY\"5•Jf›r¦]§qâ\rÆ,3ª(ÒlQû\"™‘¡	\"%Táh b/À€)…˜‹âÀ Z\0€#HzO”AF‡çÉi³4‘'BÊ¶{›†:nÖ²Ø1'& Šh é¹\\k`èvTC O¦ªİ°ê‡O¡'*9ZŠŸĞñ[µQŒJ%ËV)êégà6¹ÀU9\ráŠ9‘Âìª¹/npÏÕTNB5!\r¦I@Ö˜B F ál¶ãLÙªšˆ6õ2¡-så-HeZ[ÆÚ›£×-*~sÆ›<H	\$‰¤¤Ö0E|z¡;4±+ĞŞiƒ0y^á”1›pæBŠ\\4*á)è‚ÊGdÊ¤À³ÒiëŠU}¼4ÆsĞÿo/„å;Q‚ÎWVÃŸĞ PÓÂVbébô—L› '‰íSÅ\rb¬ª…²v. ‘tÜÁ0dA\rU+ğŠ!ù¨{8×„#%	ƒ1ÆÃÚ£BEğu¬·V0‹„Pæ©Ñ´lÕH";break;case"ro":$g="S:›†VBlÒ 9šLçS¡ˆƒÁBQpÌÍ¢	´@p:\$\"¸Üc‡œŒf˜ÒÈLšL§#©²>e„LÎÓ1p(/˜Ìæ¢i„ğiL†ÓIÌ@-	NdùéÆe9%´	‘È@n™hõ˜|ôX\nFC1 Ôl7AFsy°o9B&ã\rØ¨i^DIÄ„Òl4Œ'KÁ¤ÃG„#+82bçD´t0˜Œ¦Ã,ôŠd4Àò°ğQ\$Üs™™uh8Ìlç’If;ÌÌÓ=,›ãfƒî¾oŞNØs)° Æ§Ì h¦ô4:IéNû;Ù‚»ÆÏê ˜AÌføìëç2ê4-—‹¿²ó ı!†½¶£Âï9cpÎÂ99ÀP˜¤2€P‚ÒA¢¨Ü5ÃxîÉ&c’ğˆŒ[B0¶ŞçÃ*Ón8Â´8Dƒ˜î¼‰èŒºèJ\nƒ )cPÉ!ƒjÆ/£H,H^4 ê”l®(I²Ä¦;5)ì4¦Œ%cÂ1Ác+k!c´Ú:)	üÀ2kÜŠ\nH!6úˆã(Ş6Œ££z4íJñ3³,àÄ1LdÔ(H«¨ÂÖ C“X&\rã<Šœ	šŠ7¨XÈ5íâºÍ¸M`J2|É@5][WÇ`Pò¬PÈ¡pH×Áˆ!¡é\r6»¯(ñEÖ<¦Ç 30¦ÑŒµ{Â(\ré„ÛlLğÜ4¥\r ˆœ\r”˜¡PĞCª}(>ˆã@˜3@P¨¼Ú0‚–Ç,ığìÖJ+\"\n63_®…ÿà/ğØ¡ø1£h\$	Ğš&‡B˜¦‘¨Ú6…ÂØó“\"ëÅp5OÌÖ¦»iÂ¥V«Õb¨©ËÆq\$Röiì¬ÌÃe8(İ7VŒÃ3P;©ÒfÖ ‰‹é{\rîE><ºMxê1ªã˜æ3(ce3\0˜V¸0ÓKØA·`/raJ«íú«S06ÚşÂŠ\$.§a\nğê„ÀÁ\0‚¥¯iÒõÉl\"¼%ƒCè3¡Ğ:ƒ€æáxïÑ…ÊR™PArğ3…õ^2=ŒXÒöá}Ø/“„ã}ÀN*`„ 2b9ã´ÃÃ:óÏ?!lŞh3·C#ªz&ÄZ?Æc•X±y/¤jr,2ó×9ÏtIÓq½OWÖİn{PçÿÈDTğI\r¡ÀÒ(ïó;PĞ4õXtJ(k'\ríN‡%>»‹Ä\\iAPÄI“Ï?D¹N…Æ@Ü\0h'	8À@Ì964DÜ98U\0«f{Æİ°†ÆÙ[9’†0ë“€æGIÁ¼>+°4—Ö‚mRCDgŒø™E°u,MFó®0ÆAÎBI…¬Ôª~ARnËö*È^ŞqÑ(æåX‹Ct)Çe‘ÀØÙƒ¹ñ'¤i@\$t¾a”a‹gQ£<ºb‰ÖçĞôÆxRl[yN%ÍvŞd d\rÄ¾iÎÀc\r…9³&N%\n`.Ò¬0¦‚1Ğ\rğHÉ'rbØlÀ<¨\"jIÄ6K)œ””2ŠQÈò_\$ª”Ş¥âš‹WÁ…kğ¬¯\$0Şàj/…¼\$ãZEÃÉÂzê²>›\0İÎÁN>Ä:ÅrZ‡ˆó‹täÎ\"™ ÆÙ‘,;(Àç=²°CQC\n<)…I\"§ı>“\r{ÌrŞ¨íP34B%™D%\$½ëHè»I³%Ä-1#°ÊAÍAôäí&Äö“,’\rå)ãÅ·œÂˆL+iå’ÀŒí¾¢æŞVƒ4ø'!Èº“dO gJ‰‰x’Æ7Vñ²AÌ²ÕpİVjÛK«Ì&i¡“SYU%h+5pÙ3:×7P31u•}Õò´`pi%Ä®3•Y4ÍÜÕ4¬ƒ°›\0j,VV!SâzÔlsır²n«A\0v/´íx©Õ*Ò­°K’e“ô\\9Z†m¸*…@ŒAÂH\$öÕd¦š¬—ÑäÅ°KpXL‚E;F‰*eˆú£ó´h‹°M°!˜<²±ÚCPéåt£³|MJÇ\nÖ¥¢Ú>KŠ%Ûµ–1´ª£Š1…€6B\0@0…]ª°d<a¶…NÕe€^'UI©‚•\0R«EğTàQZÁZ>ë²jDì9º²§ÑXâ¨WLr×4Š¼2,6Ì¨E,ÖÔØòk³°³Në­…ìhMf±8¡B#ğyÌ`t";break;case"ru":$g="ĞI4QbŠ\r ²h-Z(KA{‚„¢á™˜@s4°˜\$hĞX4móEÑFyAg‚ÊÚ†Š\nQBKW2)RöA@Âapz\0]NKWRi›Ay-]Ê!Ğ&‚æ	­èp¤CE#©¢êµyl²Ÿ\n@N'R)û‰\0”	Nd*;AEJ’K¤–©îF°Ç\$ĞVŠ&…'AAæ0¤@\nFC1 Ôl7c+ü&\"IšIĞ·˜ü>Ä¹Œİ×\räYy¨£&Kê\"Âk\r‘­j±””©ce4#òö™¢…Àã ˜™şG4C]TŞB—‰šC6´Ù¼Áó(“Nôf7Ê™HWó:fésuQÊ»’nLÖUœ¬Ağ8Îş|í­Ò|Õ–¨!Û¶Š³næ­‚º”)#¡¸cÊhB))\n,\"n™¾êh¶‰m&êÛ„¥6îÊòîC¨J3ÂoÌšÃåÃäğ¥¨D<”¨DJ½ÂPÜl†Àq”0Û­\n.W¥j¡tğ,EŒ);èÒÕ¥ˆBÏ'Í±•\$¤Bšß—Iê¯«)üW\n¸ÎBÁµñW&Äí\\`ô=m³´‘%©0¦=q*¤­ ÅÌ™2EoúU.@Ñk²6É<Í@Jj¬¹.¥\"Ö]£¦„O°d\nÃ¶å“šÂÄÿ4—ÉNö(+ú2J\$]¡Ñxh‘õºˆÚ&„:Â±Å­dˆÆ%É&†¶‹=\\öX&ƒ¦İ:®¼\$@#\$Â`>í…×,Kt¨Ú¤ıs?¶-âóE;É=\$/›¼ÁÌoÒ˜ĞÉŠt”ÀT–=U¥šŒòtš8F¾Áxnh7øƒíØEƒÍ'A j@£7Uˆ¦JoÕ\0Gb‹Éx•ZLñk\"\$¤%?ŞÖi M©ª{Éa=Ñä}% 2¬¯•©]p¤¤<y&­J§ãF>¡µj]z×ª*ûŠªT‰Êû@y,%ZÜ¹Ñ\"ª\$eôÈÛ¿ì°mØs_~6Jy|&†Ö±m»{¸Ş»»={ÅüXo›öØ½Â\\8„7;¢ã‰ñ/jœ£óTUJÖFN\nI9ÒB%\n2–uü^ÂÚôYöbì©ŠhùÕæÄÍ*‰hØÏ\"8¹Qğkäëe~,Á+/Fóˆ¦¹ëˆçnùBf\rƒ å*91ÚÅB­’OªÅ4q±&ËÈ_ox{pÄhÌÓM£˜n‹Öİ9¦.”œZa¬ H ë#·Ò›Ú[V/-ÄÚ%e¢Êaÿ6¤c\$Ót-Ü»ø5d=SaãP‰Ï~!û¯è\$íÙ>!Dy\\¬h\0`‹€‚êDÔJ™4Oğ8ªÁƒä(¤67f|Tàêo°„ö?V\\ş!;…Oö–'\rl3†©ÙÆCˆˆÄ\\ÅüÄ•‰\\_ĞlÂ×ÀgMy\\rĞÁXD‡Œ¾Ñâ¾ ¯a>¯¶ZşØ\"P‹ˆÙÆŒP(A´4†àÊb”0e½-7„A´,ÅåŸóÂMÁàa 9PÌAhĞ80tÁxw–@¸0È¹#ÁpoAœ†PÜÃ o\rÁ„:™„Á>†\nŒ˜™2mPêÀ€¼0ƒåZ«ÉQh&y.Û\$Êj:`ÄØ¯‹©#¤é{‚+şL÷á8…”d_‹™oÁò®Y‘¦½?HIb\nñÖir†QÊYO*e\\­•òÆYËY#ƒ”¹—rö_†Pğ%ğs˜Òü)”µÊMQõsM9ªşa¤zÒEà@D¬@ÊdÚ-‡u›¨PÓá%å€Ó9µ—8\r\\âD…²N#}\0ÎóÇw£EßÁRÂ]UÄÛU%5:CÉ´}ŒSã6	Î9¨R˜nHìƒQEıª¨pÏ”ò3Ô ¶¦ˆ‚TĞTÛÓÖ}6Ik_,Løºsì•Ô±ìki\$Ô%¥°ÙÑÁ=j9¨ÃJ^i½€„jbh¯•!dCO3B=C#\n).°äÔºš’*¡*†è¦´7*ít‡¯E:œ3cÄËÓx6†qSÒHVa'õô†¸CÆ \r”N†­_¯—ÈlM™µ_«¡â¾xú»	¼xéy;¿›quêÚtKéaÃ³qK;Òf*ªM¬X¥6Oë‰aê”Îykœ©SÒ¬Â˜RÀ¶¤ˆîíc…’å©šÖÄ‚W”¡+ª ì¨8‚Á!)eæú^S¡,L1DZª·|ïú?ˆ’OØ¨¬œ®y\r=ä¨Q”EÎ{pŒQjpŒ‰Z¿\\Q®…Tà“¸\nB†ér,–ÀÃéHŠ¡ò>s°C­‚¤½\$ -4*ƒ§³ò„Q:›õ\r“2	Q‰XE50@xS\n“ìê×£Y4#„Q \"QdËı\"*€ÛŒë‹îª &7rc•?âÒ&Å¦2rjÉz¦y¢¦›CŠ»ëÅ”[Iê£cÂQ—õìIÇ+[÷•Mf¹50¢0#b*¤ñ:‚\0Œ‚»=+öÜaÚ½m¬ì¼„6ÈˆÈû\"Œ#\"_&°bS	•L%×j0Vñšã+†M[Oj·‡§Kéš;3Îmn7‘â\\Ïµq0Æ¬¬æI8Œq­ıãR-ç\n‹öÜ«ï}¸÷÷¼‹>ô/mÛ{«Ld]Z,0\$hŞ1„7¼XĞ&áåKV¯á‘]ÇB9¦dÌGS‘¸¥9‹»ƒ]Mœ‡µıN©ûuQEïÙsÇJ‘ûbQJ\n¡Sƒ…¿¶;7…€À0é>«ÓS}[Å?¤ˆÀŒ;	éååX8Ş¦fnÉ¶\\/­P_}Õ	Õm¦\r \\óğv^‡§·.4 ¶[„1[¤Ë„ñFt¡Uèë°G5'“2™&‹-”ÀRÇ{“~*òdœ0L¹?38-ê¸¨ìù\$ªBäyw\"–Å`«ßİõÁ„.öá-%ìØƒÄ~JˆRB5á86\rÈH}™1%–ıåé£§­^m‡ˆõ€»¯×ktŒØ ¶£Ó»7\\\$K.é?´.>ç[ãÎİ+\$~æFDÑlÓİŠé4Œ®Pz¯{ê‹m¨À¦Oo«Ov9Ç³äv¤Ağ\$ŠûÏÆÊInGÂ³î(k6Oj°ÅŠ\0±KTaâdNä€dä7è.\\)úPÁ’*”‰L•	T•‰\\–	déh–Ê ¢Ix—À^\0Â`æét‰£ÈşÖox¢',j¢ÓŠ‚¤É¬";break;case"sk":$g="N0›ÏFPü%ÌÂ˜(¦Ã]ç(a„@n2œ\ræC	ÈÒl7ÅÌ&ƒ‘…Š¥‰¦Á¤ÚÃP›\rÑhÑØŞl2›¦±•ˆ¾5›ÎrxdB\$r:ˆ\rFQ\0”æB”Ãâ18¹”Ë-9´¹H€0Œ†cA¨Øn8‚)èÉDÍ&sLêb\n*±WÌ5iØÂtŸ/f¶¤@t<œ ¦*ôÒa·Ó†Ö~k<ÊJ¶³	ØÓ'¤¬ú—ÈFì†bRN2ËÔ8¾×0;F\rÆšdÌ@a5ÖŒ&ÃIê`c4Òp£¤‡'•Ëæo5ö—¦oÒQ&†ó\\•ˆ7ß¨‡aC8vãš:ı•.şyÔÒˆˆşC|¼Í™	ÙÌÂChÂ´T<mò1\$­`=.Ğ@1XÂ”ˆ‹û(¶¢ÈÂ42#JB–\r(æ%\"€ä¡/ƒjyŒ£“h¥­êHô(#pÆğ·ƒZš9ª*2¨«*Ê¶2¥\"Ê“ÀcÊ„bù¿â\"`­EÈ³¾0¡¢ê˜K€¦Ş48Ê7£(èÖB(È4¹£(\rãªô¾/Ì~	2A9£Ã@Ø˜o‹ü\nƒ’ıA°ËXÓAP‰Ëx	Ï\nv:ƒ[şŒ\0Ä‚€M9OTÍENÓîcÂ&pŞ7rxHÁ iZ†0PĞŸ²	3L5Œƒ*‚Ÿ§°H´7ÍmäŞĞ	‰tà#[ÿŠÌL§_M¡lBxÈ¡7Üô_P(É4”øB¶í¿*4nÚİïÚt^©´èËm(ø\\ŞN%è¡^Ì-ò_vØØÌà	ºBàƒ\rï\n`øMúÉK\0’Sà	¢ht)Š`PÈ\r¡p¶9eƒ»ºˆ2Jïø´à&Óh§7éÂ\$&£z~ÚEcÓì¾T’™8c.~§%6< 0¬XÙ5¡Í Ş3Î\"0¨Æ)ìåoR\r\nĞEW[>P§Œ¶5£›ÂÚè\r³iAbÂJË\$Â\n,àãjê:«WşÒV¸¶Û^hæã¹¤4vÊ9ï;Ú!¿0ü\\¿%GÃ\rÜFÅñ»b{È#[†äòr»µ#XïL6Ú9½?Á¢İ¾]‰NÉ»óë§´BòD,xÉ¸%\"³æàwœŒì½¯¸“x7:ë»Ğx‹\$ƒ(Ì„C@è:˜t…ã¿ä2\$b\"c8^1a}¾LÃ i\rá¸‚ |£ƒ˜p§02ƒÀ^Añ\"'ƒ^“`ÔØš…€h¼µŸc†[Ó–x†Ğÿ7TX+Qs/È¥q*â†{T'B¤4J• àrƒÇìÆ‰Kç}/­ö¾÷âüß«ßOà9?§øÊ¹€\rĞj\"œ‚Hmá4†âµ t ”’œŞŒ yhˆ’\0¢oƒQãÅØgÛ‰SÁä¢4qÉJÑZdU£•.H\\Ü\n>Ê¹B'f_a«<\$ÌÂ×İTyûuá„1¢ĞÒyEÑ\rN”˜×œjš+G­%X©G¶ˆ×yZÜÒ’˜Ğú!pLL4I&Œ}åY9’\0 §”RGˆÑKxÈùGâpåÜ‘¤Læ¢çŒˆãôÂ&¼ŒÂÖ\r’ã‚90ˆJ\$h]\n½‘ˆ‘?ÄFšC zF0'vKÅ¡z)Š>Ón+NùuN³r-—õîçCY9)… VñØ&)À¦b&C«w\"©€¦ñÎëB³	| \"Zl‰”j#G}59mà£Sò…£Ğ/O±´-p5æwy?!àœ»’5-Há6GÄaˆ%FŞëö\$­è‡BlŒŒ‘w%d¶\nÜôSŒmn< 0` Â˜TĞÙ¡p@€IÉö¢•­š³Öœà)½9)Ô·¬‚’C1s§z‘†ªÖZIÁOªŸc%A\0S\n!0†'RÆùÉ¨Ş’4?“@oGe\$#@ {‰r!9§Š8BæTóE,8½)¥<MÈ°v(—kf¦H±?füà‡S†qfˆ¡·ç` yp­ÉÔ˜W(ƒ©Õ1sí·\$Ô;E°òni\"%!\r5†ÀV~ƒHk7fĞßS:\0#Jz8\$Mƒ!DœmÔ]4©©‘J0ä„ü<hàa‹5¾_‰Ğ­T*`Z	Mµ3Rh¯…Fq…Se,5a4e4L6-¤Íª¯öHpõ«bTÆ^â,3‰	)\n†PË“	Pñ#±¶3#M\\\rÙ E\nY\0¬Ñ…)#1aÔódU-âéÊnæ¾*ãõ#ZyèdÂJg‰9¯'|¾2ˆôÃer)•°É©LÆ#s)\"Ê)¦µZ¦‹S\\ËÜ0Ê ×Å7Dë˜î]SVóâ§ĞæµS*3XóÕXOjt²€ –HÙ ¡âÕ\0¨³§Vª»Êõ™×SÈsñ©„(QDcC.Â“Î3:•ç[™…(";break;case"sl":$g="S:D‘–ib#L&ãHü%ÌÂ˜(6›à¦Ñ¸Âl7±WÆ“¡¤@d0\rğY”]0šÆXI¨Â ™›\r&³yÌé'”ÊÌ²Ñª%9¥äJ²nnÌSé‰†^ #!˜Ğj6 ¨!„ôn7‚£F“9¦<lN£	ŠÅPšäÒS¦-{º™M’ò¬É~+U×ât˜ìrŸLròÉ¼ê 4fqÓ|äiÅ›¦s)ÌA*NˆœĞiÓ.º)yLĞr…ß¶Ûˆ`‚İ0Ê\r†£©¨@zÔÁfÆê1´»ÜïÓŒUî‡>çæ­ÆpQ\$ôbÏŞ/Ä£)êwq¹îWâ©¸×h;ôÌ§#”j—)º˜Np#!¿JÎ'ã›Tô§ãƒô9èĞÈ—Š¨æ4¡cRô®©\"2ª:n7Œ‰<8”§ƒ°@¤>éRœ*J¢l—±¯0b”B0J`è:£úıBÜ0H`& ©„#Œ£xÚ2ƒ’!0£*Œ;#è`Öô.‹°Ò¼'ô–Iš@A£JlÅ¢ƒ(*7R<ÏLÌÔh'\rñ2Œ’Xè‡Ã£b:!,û?Œ4\r5\$´0A?Q¨<´ RĞ°\\”¸bî¯Jü5¨Ã’x9èÒK6Bd ’F‚\$¤…¨Îë¾ù¯Â(Z6Œ#Jà'Œ€P´àŒ²¤ÈÏ®otÔ(\$%†¿Y¢¨ğèË[×,fˆZnªDv•©]*Öº{l·£›;Aq]\r!uÅg!ƒE¡nİ6ú@;%ãÒP5B@	¢ht)Š`T6…ÂÛèúµÅZ pøè–Æ­ƒf£´ÈÕÒMGŒXıÒ< #t7äÍ«Ê\r«ğÙ&L«/ *#0Ì*\r¬š2ÈÏ=y3¤ÏÜÖ7³µÀÜ<µ90ê1Œm(æ3£`@-¹4%&é4ß·÷FZ7¨P9…0c?3¦ã¨æ8g…\n<—ŠŒËÜÓØÖÔí„ò·>pÇ”Aã#æ‰»n2ŒÁèD4ƒ à9‡Ax^;òsƒ¯¾ar43…ğÀ^ş£É.P„A÷@”»aà^0‡ÙRmy®ie²j{\rğ•‹:­Lá  )xšı 99ÁVF¾°İ§\nÌ ¼OÆñü'ÊòûàåÍ\\ç<2äÆN7tŠ@|\$£ƒE%Ã§UÖdSĞÑ4ú(Â¢\$ˆç£C¤‡¡Ç[iHŒEI	2J\ráœ7”0U“Xh A„1º#¦ÕÓRaïè97Pä’ĞèaÏŠ4¶šòƒRj†şEåˆs),3ÿCId¼!SMb!\"ÅI\"„:\\Ã!\$«Ê \"ë\0¨H\n\0€€RGI2oÁ¼á†ò^ÙAP‚­àÔsBhÓÃAĞÓ\0ù éá,™Ê;M5¸A\"\no2Û@Í4éâ[ƒƒa h‡\$:Íxc^L´3¸Å@¡„5-¨—hìpÌÔE%D´é„0¦‚3´YáešØ<ZŠ@áãpÿ‰2&‚4£K1BŒ•Ñ?±lá¡€Ò¼‹œÅvı’\$1ªwé:Ë´şÆ	xI\"aäËpÒ‡KBCvFâ\nC©¥'á˜ú‘Æôæ0:aŒ³]1¤lÒ|™Ø‘‘z&á@'…0¨íÓF\rEâkËé€HŒA‰ä|“2fÔA#ÇUEHÌfècYæ¨áÃ8 \naD&\0Ì®ˆ‹&á*E2‡P‚7Ó®v¦äLŞÚÃO	éy†“¾gánŸiå&;z‡\n”Å©U\n¦B¼Ã±ŠªFÕ;¾ÂŒtåêèNõUw:º†*úÛ6KÒ±§¥ÃYˆİh˜ÄQsÄs—h	®–¯LeåXkµCI‰Ö/¤ĞØ\nÃY:\rg\0œbĞO¢€u9JÂN„j`%…ƒfü*…@ŒAÃoæ7s	æro°4ÈÒ%Üm@¾®kqtû[^m!¶Qås/KlIcà	·6¦c¯;jd.u³j¾êê\r94I\rÌK!Á&04F¦ ¤` ¢feèY\$ğ{¡ë5·˜åËÚ,yePmdl·^Ù1Llq=\$¤¼&úLFcù¬F—ôà³“HZ¾8'13\rÀzj&É=Ü{Z¡pµÀ\r**ß™ Ë‡.A’9æ2ÁTğ‚Y !Š ïE´]nQpIS·vˆ¢\\î‹[!¡5İ\$h±c9õœŞ—À";break;case"sr":$g="ĞJ4‚í ¸4P-Ak	@ÁÚ6Š\r¢€h/`ãğP”\\33`¦‚†h¦¡ĞE¤¢¾†Cš©\\fÑLJâ°¦‚şe_¤‰ÙDåeh¦àRÆ‚ù ·hQæ	™”jQŸÍĞñ*µ1a1˜CV³9Ôæ%9¨P	u6ccšUãPùíº/œAèBÀPÀb2£a¸às\$_ÅàTù²úI0Œ.\"uÌZîI*ÈMâ1¥ÃF·4„LrSêuq\$HÌ–ğ˜jÁ ±¬¬-sš‚ò«’(Úe¬Ç9¨ÕBc9n–B,›Î¢A„ìeâÈÒv4›¦s)Ì@téNC	Ó t4{ÇC	‹µk“WĞñZÅ}1\$øç¾”´›+ë»Ó!(³†h’JBTZ¿	CæA¾©Ãı·jBÎ\"	;ˆ¤)P`¦ç\r#pÎ’6{Î‘\rÁ¡¬jƒ\$]2ës\"…4@Pª7\rnî7(ä9\rã’„\"<¯hÂ9º Şîº#xè‘<C„ƒ'8æ;È#\"ÖN)©;\$^ ‰£2ÎÀLêÄ„¬Æ‚Z×¨\"œZ Š´hÖ¾«\"´-h\n¾¼,S²£·¤ÚÒNkrr\\-ed]NmC˜>ëdöúL<şÅ,mã€ÉNHÂ4Çå0hÈHI¦Jsx†DëÉ`ÜÓB\$ş3ÑŒÆ3ŒòÈ_?Ğ¬h)Jt\\›.)!?V§-sø’LSí\0PvDS\n#ŒĞ¶TìŒˆ#`û!€HKnµê*bX\\W%¾œ,ªI5¤‹˜¡pHŞÁŠ×cÀäœÉÕ÷+\$  …œÔ‡XÑ’‘¾Õ=ÿ\\Ö¡ ™š8‹;dÄŒc\\Ø7¬ŠHJ ¡u·:HOMJPˆ¨\n¤öTOä‰B¨ÓÜy ú.(\"Æ]äKªa’ÌëÊéBe‹ketçH¾xšçú\r	¢'HY¦é3Úišg©ş¥’-óBk¤\$úÒ‚'qh	@t&‰¡Ğ¦)C\$´6¡p¶<ğÈºÙãW.;KhX>´šA‚#Ôö»AĞH1èİÈ:Ÿ+ÉŒ£ÃÌ7cHßĞ-jTÈ·C`è9NK–0N€Ş3ÃdB2¾\nB1@\"ù<ÕW]Â Şé£Ü<„¯@:Œcº9ŒÃ¨Ø\rƒxÏac¾9yÎ0Ä!Ãœ±êó˜Rµ”iâ|ŞÅ*ìºZxâ„*9±Ã¼3r£¯Bˆ\0A”7#ç´İ¡ˆøÀÂsˆf ˆ4@è˜:à¼;ÁĞ\\`·HI3‚ğÊzJráÑÑB€D¡QåD!œğÂ‹[(¥lzDX¹KhÇùB—Òö‰êÒ[I™ª¶tº§ÊÃk	©ó#¨•’Àr[®t8—b– l\rF	ÁX/`Üğ~ÀXF¡,'„ÎzºFÁhÁ\$6‡´a8t†°İÉé\0zzİ<\0â†³ R¢>x°7D¶ÂšÑtUItŠgLh™Ó¿íŠ5v4†aù7,ÏÜ4\0Âác£Üì½0Ät‚>Ê@-ĞÂ¢ªPy¯=è½7ªõÑä´=~V’ Ã \0c‹ò4†ØËY©E¥17´¥¶µeQ2Mde7&©BıÂ¥M„ÜB‚\0 „ÜqK?h‚]*s>„ù6 †èà,°†g|éS®vNØe[©H9C¼z’jOšÏT;Ğ¢ÖQüTˆpšœSTÔ¬GÒ<ï@ğæ•^sâG‡¢G†ààùâ¸sJéfYÆ\$`iğTKy˜taÎá•Q“©T\n–aL)dÂüÚ\nü.ÈiƒÄÆÒéR!\"…Â*¾Õ¶+è²rD4*k”d@¬ä\"b0¤'‘P*CDª5s;ZñT6D.â—Ğ£¼)K3§€Iy9@€2•ºt’zH\rÒ(ôçbC©İIá™ Ø`e,Gê¤‰™D©Ü¬¬3ò\$h'pO\naRsÍátĞkêÎl®)Ö\"RMÓ;‰MsĞ]+Úÿ(læ¸\"ÉQ’Õ>œêyN£F®);n˜µXŸŞÖ(Âd”…9. £ÃÄõa\0 áŠ\0¦B` Ô ˆ‚¤ñxËt4ÇÔ¦ø¬İ\$Høç¤#ñ=\n;=¬ÆH¨ZDgY²ÀéÓÄ\"Ì¯Mª\n6øH’à„ìäë5¸f´¡3•²V0Vq,˜ šìqÚf'Â¤=JcHdñi·­s %µl+67ÅŠË¶°†êÃ`+,•ü™§–Tniºœ‰ašíWÀPF¾µÿ\$ú|øB¨TÀ´9hcQ%[·5³cD  (İvÇ™®Ö&² El	2©9œ)ÅVp±:ÍùèÛ¶¹À]\r±N“¥{¶9XMf'äTÙC0y1åÕ·.i<Âƒ(¹ÕLÓåU}=•¶”´§çŒ©ƒ5=Ó”Çº\\Ìë”“+ìWQ1mäÀ^ZµkU¡j>Ò·¯¨¼Âl=j6‚q-ûÊ§?\"Óè.×9[›U5cnº16·Zà()†Sµ,(Q\$“í/[¥\"‰i\0·71D§²õú¿Õ)ÿÆøŒ²fí\"ÆÍgYšJ×0AŸ÷Ğ}ºÜĞİòz";break;case"sv":$g="ÃB„C¨€æÃRÌ§!ø(J.™ À¢!”è 3°Ô°#I¸èeL†A²Dd0ˆ§€€Ìi6MÂàQ!†¶3œÎ’“¤ÀÙ:¥3£yÊbkB BS™\nhF˜L¥ÑÓqÌAÍ€¡€Äd3\rFÃqÀät7›ATSI:a6ˆ&ã´ İ(9'X(’n3Ï&#)²bršŒ¦Kl,Ã~7ø†@r‘Bæ„H) ÃÀJN#IÚ£n…Ë¦ğ#	Ò/+8J#ùˆHÑJNğ˜i”Ğ¦pÏã÷ü¼Æh—QNu&ºCÎ9bñ¹€WiÆäGrYct\"uÂàf@¢¤¤ÅÊêèãF»•ÒìdÍwh¹››ÖàÌ':”ên2\rMJ°'å³ø7(£\"h+.Ãc7\$/qH»„\nÂ;*iü&20¯àä¡\nb¨Â	xÜª²ìXÂ™º£ ä»0/œ:£jú\"5±£Šã·#Kà!#ªPè	È@è;!o`2­(³H1L`ÎÇ:/jë\r³êÚ7BboÁ2ë&Ë# P …±Zd‹££dÆ7#£<ˆ< ÃØ¤ƒò3ÀA=#ã˜51ãpÊ5A b„º©»Ø›ÉÃ\r!ŠnSC(ÏÂcœàÀF\n:#% äøA… ÙD³J`ÑyK. ØËN&Î¢º£XÒ1l|ü2ÖC`@Ï CÓ\"ã…b5¡tú’Y\nae³óı4Ú6‹&ƒpêš‰Ğš&‡B˜¦7ˆòÆ¡jFUµzüÅ±‚C)«x9pàD*³\nÃá1ë„òœX&\r*#Æ6EÈ¢\nÜ\rã0ÍPÍòJÌXŠR:Èb3V\r¨ÓC–b£˜Ø<Úâ®7MØG…Ql9 å²‘¸£lB’\r¨îQkeYşY—2ÚHç™f—A6Íó‹?ŒÍ^ƒ¡âZ.˜\\Í›7ÕAÌ•™Ë<ƒ\r‰Ÿ5r	Êë»R ŒšM9g»Ì°ŒÃ®ôÚRKZ‹‡‰HĞèŒÁèD45Ã€æáxïÍ…ÉüÍ(£8^™ã Ş¡'½8^İ6ş0‡xÂdZ˜ÓÓÛˆ\n85ã§è›rRªø’h\$£°ê2@³V‹w)*oŞmpAÆÙ|‡%Êœ·1Ísœò;Ğ]H2ú«ÛİZ˜	#hà˜ÆÈóØöxj¥-	&ºÓœY5d¥rø“J†#ÆøØ¦èAƒ+¶tæ¥–ŠRtH±Ä`â”š*ePRâ\re¥7WzÿÌÃ\nÆÍ\n¡fÍY»ngl°Å§TjğÙÃY0ÌØèVfŒ«Ğ'¬<R1*JP¹µ@\$\0[ĞÓ?¥¤ƒCşUAL%%´ÅR`a&…Í™2ˆg£4¦œ4˜ælRİ7\r‡ñJGÃ¡4	å¹ŒØq“Œ<%ù³G ‰‘A\"èØÃ\"¶d¯Š»Ò@ÄÉ‘gLQX¨B›DVLC#;7§Æ>ĞÎS\nA'†òLÁ\0S\\D¤É@€ê†ŠlxÄÔ›“’vÚ‘¤%¥5Õ\\EÍÃ‰h¬Ò@W¬«YÃD6âØ50˜ôÑ›¼tZK\r«BÖè•±DªÙ7Ç>ÁD› dÿ!3-VY¸hù“@ Â˜T^ÇåˆQJ+Ö	¤ui@G ÂÍLÓš¥1{“¢ÉêH,hN¢LHÙ9,›ÌZX…˜IzÊ4Ä¤#@ ÎËòSFÒ’éÉ’•E4ìôIÙn9iüåJhJBÌ‹…ÜÌ³|˜\rB §£âIMª\nİYÑ¬úš³ŞfR×¨&©-úªÏê¹™&\rÀVĞrÔ,\"E®óà|¬&Ö‰•`½n8¤P©+Å (©¦‰§ê°ôCM*/&:£Uª±WåŠ6f´9“@–á™´tJê¼Á²b®%D1á¸fô”)­}…ôè¥%6\\ÛÉ\$µ§N@¡ İ+ë‰Î®u¾g%ÒNJf²1á2ß0§=\0Tó'DÖÔ¢˜xÆ\ri©Æ\\‘Xã2xÂ±p>-7 CÄp±gQøŞ+&¤Zû—õğİPƒÆylòPºê–Ğ†Ch^ƒ€";break;case"ta":$g="àW* øiÀ¯FÁ\\Hd_†«•Ğô+ÁBQpÌÌ 9‚¢Ğt\\U„«¤êô@‚W¡à(<É\\±”@1	| @(:œ\r†ó	S.WA•èhtå]†R&Êùœñ\\µÌéÓI`ºD®JÉ\$Ôé:º®TÏ X’³`«*ªÉúrj1k€,êÕ…z@%9«Ò5|–Udƒß jä¦¸ˆ¯CˆÈf4†ãÍ~ùL›âg²Éù”Úp:E5ûe&­¯Ü¡êµ¥]W^¶jå…ª¯V°Ë\"Õeœ£Y\0ºB9º²-ÅÖ¹Jì~\r]nW¢°ˆŠÁŞìJ{ÈÖ­½³Ayõ.–;Ÿ^,›Î¢A„ìeâÈÒ;\r#`Ê3Œ£˜@:?jÈ0Àè4\r00è0ŒP¬¥&ÈšÌ¯Ã	ëÒë©Å\"îÃÃéÛvà±Q²í¬n›dˆ»„TíÄûÎ½»É&°òÎğ­«‹|²¬ëJ¤5®I¶Ä*´b¤%r[¾¾É›Æ\no°Ò7êúW\"S+é„hZ jù“*Ê£\n‘Ãb¨Ü5¿C¸Ü£ä7Jğ‰Bƒæüƒ|\nüã¢@ å8PC˜ï>´DİªŠù©MÜñ1*A\$€7«ê¬CïBÏTH¯[\0ÒhÜ9#xÜ£ ZU6¬Nü>àÌqÄ¨‰%³‚Ã%iL¢¤WN+¦İFL/·qÒ~)ô¸Õ r\0ç:h»wgGrªl·,ÊA\\«'Û)ZÈ¾›\n´tî¸KCÏ4ŞH;@ä¥+äiRÌn3Ê¹­ï3wV6ÛŸˆã(Ş6Œ¶ËT¯»¤QÙH¢óR`Õİ0ÚãÍÍ÷#…­9[‹ƒwanò””©Q£a~ØsBY/-÷«w/¼V¢#\r7¤Kò–tDa´ÔsÊ2d?LÙ™‡dÍ™|ÒŒ’ƒä%\0N¹¯_8ÁaèØú0(ıA j„èãìjÄ«öñ\\L©Ën¦Ãò5áÒè}¡Èyíøß·|[G¯±â—¦½»Êc«`5ÕË©ù5VºeJ¬O.­~BÖğØä[)6Ø%ñ»×\"¾›\\c;ÛKsÕ owÊ;›}à©İ3wÔ:k¶ßuö±‘\"1~Î”æŠúlZï´y=?SçÜ.'¡äjë\$…aŸ³à¢²mé¥s;Á¾	@t&‰¡Ğ¦ÀPd€¼6†Ğ^ÃÌ	!uŒ˜ù‘Ø^…9M”…:S[XDB(QôŸÀnƒ‡áWÂ^UˆeVjÕYg¬ŞßqoS.d6-|O˜aGà7†`ÌØe:Ì(ˆ‹B¬à	Zéäû²Ã<¿˜ûSoK¼@Ş~Ãha\rÁäUfCc@¡Ì3PØ\ngKaÌ påg)lGFÆRØuA  9‚˜‡\r\nî-îùÉ,GèR9å)9³C¤9TD¥9w•à¨}SšĞ€:«D¸d¹<ÆĞÆ­• dO €éÃ0=A :@àÁĞ/áŞ^â‹(ÓÈ.OœÂ ^¡at…€¼éƒØg€¼0ƒä/ »\$‘*øÜI‘g’M%H¤>Ù‘ªNZK¨ƒ¦\\¸ÃO›m\$€4·0Uç+Á5A ĞäŠ“Mv\0ÓÔ¬¬•Á¢XK)i-¥Äº—Ş_J(‚ŸfÅ\rÓÂµm3\0>	&1@Ü&œÕƒÀŠ ğŞ×PE,!¬ü•bÌ¤¤ó]ĞM“v‘„iH4%R,\$RTÎ}k(¹¢2øî\nrJrrX4€ÂæR¶İ\0ÆpÄ~‚y“aÉŠ5ĞÂ§ò‹Œ12ÆxÓ*â@õT(…S(0†ÀçÕK	T ¢+ ætEr£|!\\\nãVÏX\n\n (T\$‚äj2§qÈ}Mœ5ÆOA€±¶<éPÕ´¤«EŸ³úĞ\n­uF‡ èŠˆQUô¡‡{f´ÜŒ2d¯)£ÎbÏä,HX6~mÚCÜWb­U‡qÕJàæ¤#uNè>š†àá¨\0sRJR­¡\0Æ)`iòĞUúæ~a“±\nÓ…0¤ŠAÉ0ËÏ¤+Rñ‚ä Â,äêJÇ¬ÑÎéàÙÜ<Ûz/¥ö3†¶^©_Ô£vıkØDfµtw}çCÎ¸©Md†Ğùœ)¾oØ>wÈ7ƒ\"`'U-¬‘ĞûÑPÀÖ\\ˆÃ9ğ©œúD*…W’õÙ%'Í+ƒËH5÷‡_.Â3è’>O ¥®Ÿ¥ Ãu0B‡êTPfOa¶PQiI?îâwe\rA×;r¤!Ötwõ\$Nú‡ÅÄ@'…0¨R*#.SN¨„d3¯˜^”FLn@»«ù¤¤V|çP­à¢ı“\\†>a+Ù¯¼4ZKAD§\rÁšõPå4*Öc‡v¬ûØÖˆN¤¥Fªpß0ßîPJE¸1^ @ÂˆLÒ 	\\‚¥•‹Mt4šuss\$2`¦¦¬”Ÿ£`],âwiüNúšÓîÔÇY]*]Ñ¼5VëwiHñºäI‰°óÕß\\å›¼¹ãÒàmít‚€’ƒCmC¼&\$å…uVòàËH½á]½xWİBşvHuÚJQ3C}®é 5,\n÷Z¯Şü‹†bgÍ6õüåÛ•³†ƒOß§[!°ç°ÒÃX «R¸;WÜßkie/\r!š.Sb¼­,“ª*÷G@ª0-†Sæ4¸W6©d|¥#\"mÊS,\"Xs’pí½m¸”€SóßoEÆŞß0`÷¶j×|¹a7©<W\rñ¾Hí¨tï.ƒ½”üxõ8'¸˜gÌä	ÁWÊn‚-é‚j9ŞŠsT4iHº54p‡ğ¤ga7©uGoÍİÊîDÁ);îsq8GpÈş÷›ÔPƒ(l×\nÍ–±“·íÈ\nM*9;Ç\\sŒM&ˆØ¸ˆFÔªÆ¹Äñ.ç\$GĞŒ•Ô/M×ïqoM°ÂaDk¡µ>(E\0¿‰Eš&ÇÅÜ·mm†t Ä6õiêGtœgàúlrõ‹r®ÒóåTsáğNÔá/\n_/8À¦ù Ê«fKÍ0\")¼î †(iHe¡ûnPG.èú„İĞ\\ú¢~òù°FğpHÇ’ª(\"/Èt/`7È\$Â†şÒcvw#<ÊâÎí°vÂğ±gtHU,¢ûã¶";break;case"th":$g="à\\! ˆMÀ¹@À0tD\0†Â \nX:&\0§€*à\n8Ş\0­	EÃ30‚/\0ZB (^\0µAàK…2\0ª•À&«‰bâ8¸KGàn‚ŒÄà	I”?J\\£)«Šbå.˜®)ˆ\\ò—S§®\"•¼s\0CÙWJ¤¶_6\\+eV¸6r¸JÃ©5kÒá´]ë³8õÄ@%9«9ªæ4·®fv2° #!˜Ğj65˜Æ:ïi\\ (µzÊ³y¾W eÂj‡\0MVhÓèÂª\\(-Ë„å›\0¹‡ß°‹Mz¹1ÉN®	íÄóÎŸÏPø¸’â|èÖº¢âS¦št&xÜ|ík„Ğ\$õª3­wìÚ+“yÔ@4#°Ê\rÃx@8CHì4ƒ(Î2a\0é£€È0è4\r0ˆè0ŒPkÚ¶í‘p—²\0@«-±p¢DÑDTï>\nQpß;®ú,ğ«jCb¹2ÂÎ±>¨óĞ…—\$3îô\$¬^¹ÆQ\\k\"6-+È”.	Ûò\\R“°€(2zÚğ“`P§\0#pÎ¬¢ª²á9ÅJVè9+ûbæ§¤È*Ã\\\n;Á\0Ê9Cxä¬Ä@0pÈ7Â Ş:œ*8PÔ áFc½2DoŠ~¶ Êó€NÍ¢pô#\r“Rµ'éLƒ K¯C´•GèD)1qU±õlà'\rãÌé\rl½(“º“ ’Œ8ç½Ë ©DÏ}s.8Í3º±¶…<FëÆl>3’|×Ä²´lA4‘,øÍ±ÃVÍ­sw ƒµH;Æ€&iüŒÇà(}eK˜Œ­§©KYªË‹!8ïŒt©ŞB:¸HºÎğN®\\ğ…+)ú51X®-m”_o£bØ¹Ÿ·Ñ\$Üˆ+öJ\0YËÉê9WæM¦inæíì:ól€ª¦s*6»Ë±¤¿S—[ØŒ‰3Ã%Êˆ<Â\0T\n¨^{Xb¬ MŠ»•ßQ:);¨ÓÑf)ûßn>Ò!q -³sprô`J+*g¢+µ’ºøèXtÚÂÈcëm8	Û*¬áœÖ³váN\\šğ²ˆ:¤î«¼=~¸o’	jÃë¼ŞcÏuUôÃ!¾6¸¾®ıèåÜWg+¶Ñ	@t&‰¡Ğ¦)Ş3»[D@_˜ñÜÂ‹mYpZ‹¼¶?ã¾1ói 'rJìAÚA\rA\rßœÄ~Ã—êCÂ\rÁÌ4†øˆÒÛUr„lÀè€Qü?Á„9 0Şƒ0lM!”îPš\"æjmˆú¹—OUJgFä*ôCn €:À0êÃa˜:†À@xgM!Ì! åÃg)¤DÀJ×Cji¨d0RˆÒ&gÇ:£v–ßK{€EÍ\rõ«¤¦¸¹X\nˆ>¡ÌıÃ¬M@€ †H¢”EpEàa?ğT3ĞD tÌğ^ä€.1Ú\r¨uÁxe\rÀ½G¿édØ\"Òu&ÎxaÅ`)Ã©@¯šÓ=HõªE¾ñô]T„å¢>¢îÍKƒ8‹íbX¤ÈÂ|X)·Nå`&¨Ä2ÿ”ØsSª}A€à`ª 4HI\r\"\$TŒ‘Ò@;É))\$°r“jLÀ5 0/F Úhm“AÒTJ§ë>Øok¨LC\0Ö€ÃJšPpÂ<àè¸İ1h†íYVJ³p™¶iJÔar~\0îƒ!ğb@aÁAÆğå>šèaÓ=JÃxs4¡ä>ˆ	@Òt6„©•3è9³>ÃHa\r‹Lõ#ĞyQs¾	˜¬UbNªi=U×ªÅp±šÇH%m€‚\0 €  «ç°\\)='m	0ÕRïÓÉS*¥\\8\r)¦BH ¤ƒƒ+]SÈ:!:¤”¥JˆŞÄ¢9|ñßiP=eÁİ¥ãaNePt!È æ¦áÌMP(n„àáĞ:œSÁÉ®‡t8ÃE\r!D\nUPc1Æ0é’.9õ9²Äç+°†ÂFkÖlôYÖ­gîR¾ªG6Ë¾ÃŒ•LÅa‚VšmÛ gåÎª:ö0àV)lqÕ‘ß–d›JªØHt¶cœl/	Ç8ÅÉKšÃ.Õ2WXõmÛå¤VI%'ô@Ò×P*”Q¡º¡Ä#CˆuB\nP3(PÛ'<µŠ1ÄP,z›AöZˆ¤ÜpŞÉeolÆË×(ÂVÊé=¢Ë<»-ì–\nâ¾&x\"¸¬ŠèPö\n<ç´£kæ\\òz9u¼Ç?[ÊâorÍ1ç6¬eÈÉ¯*¶?xRá(+\$˜ AŠİÑ°¢\0f°àÈ Œ+L1k¡¦{©˜›‰12•Ph	C²–¨Ğk\rÖxh’[¥TFnÉú0EÚa»¸¤\ræ•\\+P—¿ÊÃ-5\0£wW|ïå\$³Ş&¤|nÑ_iö­“ô“=hC\$93ñ¬4±Y>+D!ÀğØ\nñhia¯(Ër^98äÌ­·ZV6{\r±ÅJ[ø˜B F áüG¼,šŠÄOkÇÅ0ªİr‰µÙÀÇ»QÕ“ØZ±ò_>MË¼ï¾•¹á¯`(&Ğ ÒƒÉY®má¨«‹@(›óß+ÂT`WDÃª:ki°¤èÇŠmVG5¸ˆÍÖŞŞÔÙ¢ãg²Å¦N­FØåÀ2á^_+07çÚ¡”rŠ\\òIÊb²ÊÒCFMœÜµ_-TÖC}û©)îÔÌPm#±%e8H>lE™Y»p••’»¼]+3â-Ég’Æ°WN¾O;O¹7]jŸwF‡ƒj;Îïî`”";break;case"tr":$g="E6šMÂ	Îi=ÁBQpÌÌ 9‚ˆ†ó™äÂ 3°ÖÆã!”äi6`'“yÈ\\\nb,P!Ú= 2ÀÌ‘H°€Äo<N‡XƒbnŸ§Â)Ì…'‰ÅbæÓ)ØÇ:GX‰ùœ@\nFC1 Ôl7ASv*|%4š F`(–u64‰†ta¯Rø(¨a1\râ	!®‘y=Ld ¢)¯K0gÇL!¿\n!O˜æ1y7Ì·”Ö 4°ÔòÃÉ”èkƒ²¹|æ:t·dvòÓ-GŠÒëj4Ó	´A®ÜíµÛÈ¼Ür0ì\rÆ>8Ê\n)îŒ¦I¦HrìH\"^+}Ææ\n*›fãyŞ9IiÙˆÂsŞÌÌ§1³(9£€à’²ƒƒî9é(È“¨¡\0ê=.c¢|¹(IøÈ¹¦ÃJ>é„Zà¹.ƒrš\"ğ€è˜ Šj:)@Îë»,‘c\n/Ã\n>49€Úó¥-€Ø4B\n¦ã(Ş¦‹èˆßÉò4ŒrË'Ë±b\n°Ş¹HĞÒ²³	‹¨4>Š¸,ÌPë\"É¡c\"lÈ€HK7>ÃËp¦¹\$dğ°\\“øc º\0PĞÔ”ã4Â#Èë° ­ƒ&\r(p”¬©Úì­SÀc›7\"#Hâ<˜­ÎpêÆ:Ï\0R£¯æãÔ£6Ï£uŠ@îÓ”Ü0·c-kQ\"èÍr—•à²Ò®ã°)‡B ˆhˆ¶<ÛÈºŒ#Z3ŒàP¬—¢éNñlã{¤®8İu(åÛŒ£ÄN7 Îpæ“Ò•FCd’d:š£\"|²§Ãš|ºI8¦:ÃªŸ‚éğ×…¬Ø+,Ãô¹zv9®0ÂÕGnÜÒ Ì Â8BxQc^Öb#¢4h¸æç:N5º–\\2Éî\"	ù>S7¬±²|<ä™üš¹æÉ8‚2 9~<Èâ|©áéóeD%‘:ÊÓ\rkÎŒí¥íx‹Ê3¡Ğ:ƒ€æáxïÁ…ÖºÉ(Î¦!zgwƒKœ„Aóí²+.d8Gq“|^,­@ã|“é£®Pã{söê&vHêbò:ÑF‡¢£÷4‹f‰şµw„`Í»:hZ½uêŒ¶2¡p@È\r’ª‡-ÇxqbÔ5Ifæn»¾ó½ï»ÿÁü.¸qW7q—²c|şŠAªbgèb½'L‡Pùsaî¡§b:¿Š™Ô5ÇI’†ÄvõE‹6\$Ä X)’Dí‰tCªUšu90#íPŞŸf¢…Z¡dÎ©§²±NÍXÑ›yMb‘ãTi‰	er\$|š ×É8UB¹	=³\nDÛC\$,¼…\0¬Kr%ğÒ\n\n()|\n!EôRSŠR*±­”*Ëc‚	¼©¢ŠL±›BŒ<‹¹q>ˆé!°—CÂF|’\"æ#ÄÙ\0ÛPÌ „A¤“…@Ğ©ÍAügÈÑ‚\$|–A-T“pwPáÎŞÉ±½“ö4SğIÒ,7R€†ÂF‹A¨×*§¤‰(m3F™ŞCÌIÉI+ qô˜òÈYR/)5‹´FmdÇnîH\rŒDz*!ÄmPª\"3ğ4À‚¨Û‡@++…LŸÑŞ?\r(›ÅÒYg¨\"Î¦=‹Èy/&œ(ğ¦\rá ÎÒf\$ù°„fED‹ Ó\"Œ\"¥#È¼ƒ!ÀêC;¨Øè¹´&Ö\nA*E	IÙ b¡4-´`¦BcÎ)S^…Ã¬k`ú‹%ÄAŠ1`ê…Èˆ7§DÍ\n“,Í‰'6¦LˆÒ9#M\\#\"ğĞš8–²ªØ±‹ĞëUô›™ê22.f«Å}6\rİq«•Ò³Ö\0„¢ç^ŒI|OÃ²˜iÛA7èlŞ„4’\\E1ÓVu’jB F á†ğÈ\\ËBğ6“è%[ÓUr{‚rUF¥6Éó8Wõæj™J¥­rY6Å˜~êš;i%‹Ã“N¸A£ğX#òÊ˜\0dI†,\"R¦¹,:CVÕ’Ë¥qL‘İ°ÖÊöÛTxDH0¦F@È™\$Ì¤5Å…šÎñ%;E€¦¬_‹Ë¬UJyY×ªÕ]ÖËÀÆà)®ev”ƒxp\"Ép\"1Ë_<!ú6‚’Èê2xı¾B–ùRËz`«\rjFQ·“‡nĞr";break;case"uk":$g="ĞI4‚É ¿h-`­ì&ÑKÁBQpÌÌ 9‚š	Ørñ ¾h-š¸-}[´¹Zõ¢‚•H`Rø¢„˜®dbèÒrbºh d±éZí¢Œ†Gà‹Hü¢ƒ Í\rõMs6@Se+ÈƒE6œJçTd€Jsh\$g\$æG†­fÉj> ”CˆÈf4†ãÌj¾¯SdRêBû\rh¡åSEÕ6\rV(¤°ˆC+ˆ¬®*(*|³#‚Æ£ª\$Úa+XÈæhj=­A¦JÖzX2Â¥Ihæ9}ün;*¬4Qí\ne-µÀs·%¢”š\\©Ú.¢Hµh¥à´¹*	 †È İúL¹6Ú];	}tÇc\$Ñ|m~-‚²…7ip?ˆK\0*Kš_±)˜õ&M¬7	‹vA¥k•ìh@)ª ‚NVâBf‚Rô»¤9?é’†½ÎJÜ¶P’²ÉR4OC¬K}5HtJçÁê£ƒ©ª«dÊ–Y\"˜¥%ƒÈ–¦d*à„ÁmAh—±*š¸»Álš²(Äd¤ÒËäb’7Ê D‰+?0¸OSJ\\»/;˜¤»E¼(æ‰™Æ,bÌ9­kjÄ·«ª\\»¶ÎTşÊÀfN™¨S‚4J2m|È²d\r>î¹éÓ?TGò‘Ñ&‡\$óÀÒ\né6èTp &\r4M2\rFŞ2d:4OÌÊlÒuA¡>H†…˜•—;”šHq„ğ*é\"Â\n²P˜³Š\n&2 ŠÄ—!-Ù§6åãyİÖœÀç–@U¸Ï#Iq,¨\\x8ce²CJ]#EŒØ£…³ùj6,Á7®,€ØÖÑ”5]šÂé’:R\n³nÀb(Z6Œ#HØàKĞãugG©!’©­Ë)¸É\\¾ºSµ€H´©\"N¤èT‹e,\$÷”Ë=Ike¡äx\\­:J•¦9štà¤ê7›iI(óÙ9ZŞ»iRŞ›¢iû\"Í³2Òö­µ¶¨Ô«!EU‘ I‡FKÃp¸ÉB)… ]%p¶¯r•É\0.ÆÊ%•Á3úZˆB Ò9Œ#Ø2Ña\0Ş9(İÒôıOWÔŒ£Àé×cHŞ7Q˜Ä˜ÑNQØØ:\\ËÎ›î©Ñzµã5rÿs7ÕªñKmƒvÂÚ6–¸¡qÃğhËK¬3Ã±'Á©ár	Œüjn%Z’äU²E©³%W!T¥ó²ñÊìÛ£`Kï]z3uºöÒ3G/€›'ÚH‹æ¯ A¾¡ ûjA~	õù¢ÄJYU#øEMÜ›A7ú~\nH¸€Ä†½f¾¾E›ÚKd(ƒ=ä³NÛî‚PRA‡ÈûŞ“òEmæ?t>ş—cü\$°¡å¼gºL[‰*Ê’ˆpğÊJ…J}Kî’…òt\"%¯§uŒ¸M!w;%E7ÈCHn¡É:\$ÄiJ\$A;P<ÀÂ@r¡˜‚ Ğ p`è‚ğï#ÁpañÆ9‚çVÁ{®á‘İ†èîƒp/@ø…—êÎà/ ùæ eÂÉ×9+9Ä<É4á#¬@M©½R™âU˜á¨'M\r0&ãÆ]bÁ05…=sÁçÒfP1Y+‡<^”²º}RïE2›çÈQ|Z.ÇB>Çù ä,‡‘2.FÈğï\$dœrRX9I‰4í]»¼”ˆ³ÊE{\rB…ƒs*TÊ³ª–	ÌQqŠ2AQMŠ:3¤èC–aÖ:©…%RV®	®Ôâ’Ë´§¹Ô’JH2h!Ìµ²cÍ˜²u*j­IšdTg\nn“€›WT:,¢Ğî;–YP¦I™Œ©E¢-“ñ÷5\n­ş•T¯FÊ©k5seA¢¨¨h”IG#G=(¬@P°eB¨zÁJÊ8 œĞÆ¿N›\n¸(t”GLZqN¢1 Ò‚âZÄûz2¥¾¿vFy(ºaZG²Š!’h’Ôvr†‘~Kèh\nkÜ=5h‡>ÔOÊ9¤p)TFÃV„oH±1ÍØ2Q©×K°üïF#–¦\$ˆí>÷:ûMµlƒDGZE}0‹­—¸!)… Œ}YÕ+‚Äq¹ÅKq1KÅ*“21¥Ç\0-éi\\'.©5¹Aå”È›'”¤BÒ	,ÓIR7‚Á,t1a¡¼v<«ò4„1.ÚyuNk‰ôÒ¡Šé¤MÅœµŠûõCi”3jwÉ±ŸƒàCŠ»ó%k¤AEhİ'”uJ·èî?ä4M ¤ĞĞ‚Ü,&0\r¯¼÷ıp1[J€^\0 Â˜Tb¨âË¾,x™	.aÅÓ	U†U!°kä§ßL!•+ŠL›ÄÅ[&¾Ÿëy\nX”Ëº™|zASBéMs¢Mc2ƒ˜¬Şó^„\\î>…ğ¨ñv˜Q	Úhå‚ P>©XÔê0®cM6ÏV¡ÔÅ¾b^zBÇ8NRFáQ¼P¥dQ»òƒ©“K+xÛU‹íZºD	gÖEÍ»NÚõaÀÚÅsÍ5\0İš–\"ÕÂ·l8£¬æ¦µ„›+\\-š×µ•ãÚ-a²Ùípj‘<o6¹}n%ó¿—Ú¬Wko-~{&¢9°KanĞø	şÚ-M o¼²Ö¨P¨h8'í\\œ´’.µÙJÒ¶kL#Ö Öøb–9¹â 7'¥ñ§ÖËÜäğëõgi‡9úYPœûhÒ)¬1Oú”Ó&TÑˆÿ>æÎæ!ÍèLÖ©‡‡!¡c¢\\¸ÆâKhå’•0¿‘Š8BúiL²˜Ì§9Xn¤7VØ{÷‹åŞzÒ‰aõÓ!#Õ¼½’.ËyNÖLt\$áÂÎÛ»ĞÜÆSh¥5`×ÿ_FÔy7Dv’QÖá/]|–ÁîHå92˜ñü5Kî¢æû³¥N6:µD­úÜ´d•È4ÏŸh¡‡óŠ¯kf>çgåmˆY¡–ù´d‚ƒrsR4ú¤x-\0";break;case"vi":$g="Bp®”&á†³‚š *ó(J.™„0Q,ĞÃZŒâ¤)vƒ@Tf™\nípj£pº*ÃV˜ÍÃC`á]¦ÌrY<•#\$b\$L2–€@%9¥ÅIÄô×ŒÆÎ“„œ§4Ë…€¡€Äd3\rFÃqÀät9N1 QŠE3Ú¡¤³Láu’¬DÂ,İ3Š“V¡‚ÁÄåÒn¢›åÅ9Â·\nT‹ª¸hÆ\"\r20ÖXƒ\$á_)ºÉ¯H\0A)ùØŞ|@q:g!Ï+CÆc£zÃÌ¸™6:‚¸ëÁÚ‹º®—òŠšíK;ß.òÜ®@ƒFÊÍ½LS06ÂÁ½†¡ŒùÑkMçÊˆ4½kaTÜ5Ãxî‚£ä7Ipˆ0ƒÄ0c+ô7Œ£›ê7ˆ˜ê8D28B˜ï‰p†€”è à…1©#B\\±jpLÃ+@ŞÏ=éÜW ‘‘vO„IvL±˜Â:‡J8æ¥©©B‚a”lJ!jÈ!ªpK/ÁvH¾/™@<„;RNBl \r¯xó4 (Î\nƒ|â½’1›^4¥j²V¤úúŒé²pNÅÆa9‰³ü2§ %K’b!ÇÅ”\0#µ-:ƒKSúQF‰¥’LÃİ:3,ØJ21cÈè2…˜R3àSf¨A b„€ĞEcÆ5º%û6Æ°ÈÆœ3Á†Q9,¡tW¥ÃË@Ó‰Á6’Eˆ\$(«üñ½ƒ+7J/ªdœ!Ô0#dÃCtDÊÊË²ÂpSÜåÙR‰…Ì5˜eC6#ßˆu`¦Ö”¢¸»R°ĞÔóò±q‰Ğš&‡B˜¦cÎL<‹¡hÚ6…£ ÈSôÓ5\nk’\"\r20Ä6BJ@A^CtIYøå¢Œ£Åf7cLo%P]Ì9Ç#@6-\0P²7¯å	\rã0Ì6=c*]53%Ş]”õcÜP|â¸eª'z#Š*H§ÎÌjÜ=ï®.İ¯dx¹G2#¯Ï¬nëÅ^EfuÍ0Â—`²Š;·Ã#Än3©cET5ÂÃ6€:é¬@‚2\r»(åÄzxÒ2@¡\0x¡øÌ„C@è:˜t…ã¿”=‡dA8^2ÁxÉÁšwªŞ¾„:=c8xŒ!ò\\(bôTP<oRšÉòŒX_œG2Sô»‡L¥yB•”hºª=)&\$âO*\\\$µİ;Ç|ğÄxÏ!åw˜óƒrzÉé=G¦Ò£MFà¼€|fÉ\$È¢>ÇÆùX	 LÌÑg¥ö_ƒB&GQ3£ˆš„DµV! Âß7İz†Ã„ƒ‚uAÈ6†U`C2³háÌ:†0Çƒ0u‰Á°7¦b	é4BI*V¾îsà!±¨ch”¡ä;GÉ!\$Dælq‰<‹¡n†B€H\nÑd—‚<%ÈâBJ\$È7¤¤LàÌH|\$rJ‡\0äOS<ñYÊ!ä,ÎPºq;Åb–Ş|-íİ+„\n„¥ACh‚/‚×¥ğnÕ¢F•€wbğ±Ø†w…æ\0cHèE³¦µ]h(a)… -²PL…ıQ”âI©.é°€Š°êéVJqê¢¬ñtŠHâ *J´\0PçNòøhf“•ÀÜËT‘_tÄR~ph“¤\\TDŒQš%Ø¼#!u;I.	\$H<µÃôíåLA\rÌ=‹¡f¾nªÈñº÷cZ9z„2!…‘£ALÑ²3bB‹J!,á@'…0¨mÃ«pÄæ.G™Nˆ£XäÂ1nNIÙÕ'´H€‹zÃ>ˆ)²8aŠÅÌ\n&cOı%RälcÃ#õV'ú ÑyˆÁRE÷9Nü•cP‘2pÙ§¨¦©Î	Öè}•MsÚzNH,ÓU¥ —94w=È#ñ&…ü'‘v%R°NE‚”‚2Ñ¬2Ì}¦F¬8Ğ_a;Nm:\$ØóRkòmğü]<–T‰\n¡P#Ğqhl<%\0”ı#IQÄï3…ESW°ğÌ¬‹55IxíÃ3xÍ-¨AD:ª¨I€QÙ;aE÷,†oÑC/•ìÚÆl-í·âìEŸRŠqYƒ2<&i™‹»%xX UG\r8¨´[ZKéu:®X~åŒ	ªˆ‡!cBhÓšşb5U‹EXKBéfŸù,`)É\n•µc¬›áx*26G®æ*ï“Œ¤6Åå³(™ic:‹Åé²b:€";break;case"zh":$g="æA*ês•\\šr¤îõâ|%ÌÂ:\$\nr.®„ö2Šr/d²È»[8Ğ S™8€r©!T¡\\¸s¦’I4¢b§r¬ñ•Ğ€Js!J¥“É:Ú2r«STâ¢”\n†Ìh5\rÇSRº9QÉ÷*eJ*È…»b»r§­îe’†\\‰t(jÒ»*ñ,è_\$e¨ô“•\n¥–¥äiUƒ™®«À.WÛû™:ƒt¦RdÚÒH°t/Ó1•V,r/ÓµÄce´r®VÎuÚŸx­sá±­Î¥¹[9±˜å,e@k6ÜdÄe[iD(4*@S¡^­t*…êıÏq–§Ntú•Ò”L÷•ùœ¦Z\nºIÓÜÉE{™@œ¥ys”\n®ïç#Êó•rœ\\®ƒXs%IÊX’¨a4£³)*šr–å“pªªê‰.s•…22Y%¬¤LÈ”©q>så±ÒK–ˆÁtF5\$ÙÊDË)zH·„âÒC”Q*r“eñÊ^”L+Äœ¤ÉP¸.K¢F­0@¬¤Êğ^’®›ü@œóŸ2´ç)v]Ï«.‡ŒLtJY0W­\$Lˆ\\tj–’áÎZJ)9vsŠzFœåé\\–‘ÌitG»¤a&G')TAR1Ò@'1T®ª¢H\$\\¦¥¤éJtåR0\\gIDÚ´\$%hr‘äO0³ª‚@Ö5š}Ø–10‡9X*’¸\$Bhš\nb˜-7(ò.…ÃhÚƒ SÕ5\\âÊÎg9M4.*0æ.d²WÁ—ÕøDØ)C)KµÀPØ:Ij{g9t_œ…ÑÌ“ŠPÊ²¼Ò¼ëFG5¦%‰ĞZF%büÊ5\$:bM!‘á^[¨ÖQC\$’ØHÇI•ä«2D?“ä¬ÉOE<Ëˆ‚2\r£HÜ2Y¬tĞL’*\"ç²—e`x0„@ä2ŒÁèD4ƒ à9‡Ax^;ïpÃ¬kZà\\7C8^2ÁxÈ7Ãè4ñxD2ÍX_!„AĞE–)áÒP–§I:Q!„HxŒ!ğ\\Œ„Ó¼ÙÄ9Œe¯fúÓäó\"®Œ¯ô]‘8O©[^Û·î;ë»ï;Şû¿ë:ØåÁğ¼?2§9òHD£‡ĞF’½?SƒÅÉÌY’©´,Wg1`\\…É\nr‘„´J_¼úğ\$q\$.¸W‰ÓöOù™¢s	1©J†[%Í¤ˆ¡>Õ`çbà„ˆÂr!(‡§ÙÜ¤¶€…9†dÎ	ÅR…_!-…ª¤ş&x>€H\nò!…‰\0EC™(î•İ‘£MI¹©Ã˜G\nT~,8‰}F|sŠ±^±™2IÄDBFeÌÉ1LæAô€Ğ)Ö/èH\\²Î9…\0¼kÆª‘Áz9“ÚŠàZ#q\\¯„Äf-i0PE£&\"\0C\naH#N)\"Œ+%h!Û&ÕŠ±Ípå­Âl!^0&Q›‚t‰‡0®«Í¡ò”‚(¢ÊˆP/¤J)„æÂpÍ‚ø_¡q'Í]èµÅ£&¸æ\"	Ús,Ñ¼#n}Ğº2®xS\n‹ñ9QH*‰ü¯fğ„G”\"¼Ï²ılŞYKF:D*”RÃ”H‘áv)#\n\râ¼“á\0ë…ø‡ÁP(òB(	ùyaL(„Â˜OÔÂ%Ìy%hôs*Ğ;'mÏ‹˜4f#À4†˜K\n;GèÈ²9F4ÇÒq6+á„Y2:6Òâ\n#Ä¼OIâÄrÀã2#J\ná\rˆÃ‘&’X‡Qâ|HÁÊ #Ø¿p¨ØŠãö.Pé=Ã•ş?è0\\B¨TÀ´,—Ê½3…O‹˜øŠFÈêğUB¤ï+smª°”+¼L•6ZD(³Jü Såf8g‘ª#„bGH“Ñ0æ‹úò.k­Oˆ”E\nĞ/c¹¥fs¡9ËK>G‚ït‰(’â`Ğ	h‰üŞ	9t‘«P¡…¥¯¬ZE!PH	t^BÑ[L‚Ù5Ñ©D¨±Ei»\r…KÎ¼Urì^Ğ";break;case"zh-tw":$g="ä^¨ê%Ó•\\šr¥ÑÎõâ|%ÌÂ:\$\ns¡.ešUÈ¸E9PK72©(æP¢h)Ê…@º:i	%“Êcè§Je åR)Ü«{º	Nd TâPˆ£\\ªÔÃ•8¨CˆÈf4†ãÌaS@/%Èäû•N‹@ît¢¡Ğ€BºT)ç*zàæY\$œÉÄK¡f‡s%“.…\n¢W-s­îËÅ}5,°r¨“ÔÜ‡ÄâÔ(Ì}5¨À`°“%‹•¯s+NdÚÓ°t .T/\rˆÅc1ÒÉreSLqxõHú™Î¹^9×HÌO*åãr9»|Êz>‹ êÔ5Å~í.²äBªz¤:Ié’â½¹İi©ÅS>R\$a^ù+~Ğœ¥ÑV¨œÄ£`G–‡)^C eäU¼ÂèT;ç)K¥å²>V¼-ásp‰\nBœÅABs–¤\"’9´ªrRr–îZª«´ª™.–Ji*\\GÊi.R°dùÌLGI,I®.›rY j0[GAnë—%ò\0J£‘ĞÊ¤Ê°r—™ĞL¡Ğ”(Q-G92]¥å*šX!rBÎS¡;;ŒÑÒPO„Ù\\‡Œ\0Ä<ƒ(P9…*i0ë’0!pHÓAªšHŠàreÙÌBò©Î^Ğç1IA\$x§è:\\E£Åé9Y%ÄPCÖdÜèV’IZÔ…²â_ÇAU.%ÅLK«	é	d¥ÅyråÒ]ÂVİº¤Ñ*cYÙlÒœäy|«+@	¢ht)Š`P¶<ßƒÈº\r£h\\2•å|Iğ;ŒÄ7„1K¤©?‡©X'ˆETYF\${¸@PØ:M1Pt“e\"M…ÑÒœ…átÁªS219Û–ôû\0Ûe!bs¤»bÈgIG(ÒFÅÈCÄ1ÒH*¥ñtäiĞT”Ñ©Ÿ‘X¾ynÆ¤!>t„êå\rˆ# Ú4Ã(å§ê-ñ\0AœÄ)\\£fäA\"Ş!àÂ\rÊ3¡Ğ:ƒ€æáxïË…ÃåºnÁpŞ9áxÊ7ã Ş7# ÓÓ…á|s¤ƒb_!„AĞEèd±sË†!à^0‡Áp)Œ£˜çÕÚ¤s¥ÒNñk„ko>Î¹¥¥7B±ÁeèI,\rÄq\\gÈr\\§-Ìs[ê9sİEÒ£Å7y}`D¥ÛÎ:9Eˆ•xO	arG¨èÂLƒ7Äğ„(å‚XÒ¼‡”ó ¿/\"Û\n!VÅX¹uF¢´R\"@°ëÁ‰6A>ÛË¨çiHBl9„0‘EiŸˆÅ¶Ö‡(Ÿæ0ÒB2FÑI/cè½™ÃT\"U »Kè5‹BjŒ‚€H\nF\$¢´[#µ)Oí\"`k\rÈ£UÂ•Î\"`9²ˆ\"v¦ˆ\"\"¼8# Vˆ”jiÓDOñ]î'Fg‘)½åœs\nxÓÍÉ»5ã A‹ÑÌ¤ÊYÈDJˆòõ\r–Ùl¢n:Dhì%cÁ6)… Œ o\rnŒÇ·—ªõÄÈ¼7\$ÄÆQ,+0¶/-,—“g!kFÂÕ¢†¸Qa¸œ\0¡™j†èåB£ÑL ‡0ƒ˜Ó³:a(¾ÍÅ÷7då.„1C˜Xˆ'¦\"ÇH—‰8DhHï‡HF”(ğ¦\n7bUMC9…À›(qìĞ¦\$%‹¼3Sjn1˜®L…i!XâNAPk…z¤@\0M=\0Œ;\$BÎjÑÂˆL'6tælÎ-'\r1? aR÷Ô\$2ÏxtAä<{„Éğ{ÆĞÛu¡fÄªf\\îÕz•7N %\\¦ö¯(c\\ˆA˜¢Ät‰ñ~DdP¢<!²€Øvë‰á;ã˜O“ózo'‚Y4c_Šä.Q©&°iA•4]B¨TÀ´T*WN­N\"GR6GZSa5…2[	a„ ¹Vbd©aTCJÔ@M©ò'@2§U1™X`*-á”(ÀHE™iì:‚%:ÕF›BËN¨YŠ~æ›Z<.ø¦ˆ‘\0g®\$áWuŠ„š5¾÷ÕíÔ‘„Š1zK¬Òİ¾½:’â¯BH«ÊQ*hŠÄD™§šÔ’ô_ğ";break;}$lg=array();foreach(explode("\n",lzw_decompress($g))as$X)$lg[]=(strpos($X,"\t")?explode("\t",$X):$X);return$lg;}if(!$lg){$lg=get_translations($ba);$_SESSION["translations"]=$lg;}if(extension_loaded('pdo')){class
Min_PDO{var$_result,$server_info,$affected_rows,$errno,$error,$pdo;function
__construct(){global$b;$Ee=array_search("SQL",$b->operators);if($Ee!==false)unset($b->operators[$Ee]);}function
dsn($Pb,$V,$D,$B=array()){$B[PDO::ATTR_ERRMODE]=PDO::ERRMODE_SILENT;$B[PDO::ATTR_STATEMENT_CLASS]=array('Min_PDOStatement');try{$this->pdo=new
PDO($Pb,$V,$D,$B);}catch(Exception$fc){auth_error(h($fc->getMessage()));}$this->server_info=@$this->pdo->getAttribute(PDO::ATTR_SERVER_VERSION);}function
quote($P){return$this->pdo->quote($P);}function
query($E,$tg=false){$F=$this->pdo->query($E);$this->error="";if(!$F){list(,$this->errno,$this->error)=$this->pdo->errorInfo();if(!$this->error)$this->error=lang(22);return
false;}$this->store_result($F);return$F;}function
multi_query($E){return$this->_result=$this->query($E);}function
store_result($F=null){if(!$F){$F=$this->_result;if(!$F)return
false;}if($F->columnCount()){$F->num_rows=$F->rowCount();return$F;}$this->affected_rows=$F->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($E,$o=0){$F=$this->query($E);if(!$F)return
false;$H=$F->fetch();return$H[$o];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(PDO::FETCH_ASSOC);}function
fetch_row(){return$this->fetch(PDO::FETCH_NUM);}function
fetch_field(){$H=(object)$this->getColumnMeta($this->_offset++);$H->orgtable=$H->table;$H->orgname=$H->name;$H->charsetnr=(in_array("blob",(array)$H->flags)?63:0);return$H;}}}$Mb=array();function
add_driver($Wc,$A){global$Mb;$Mb[$Wc]=$A;}function
get_driver($Wc){global$Mb;return$Mb[$Wc];}class
Min_SQL{var$_conn;function
__construct($h){$this->_conn=$h;}function
select($Q,$J,$Z,$Ic,$ne=array(),$y=1,$C=0,$Je=false){global$b,$w;$ld=(count($Ic)<count($J));$E=$b->selectQueryBuild($J,$Z,$Ic,$ne,$y,$C);if(!$E)$E="SELECT".limit(($_GET["page"]!="last"&&$y!=""&&$Ic&&$ld&&$w=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$J)."\nFROM ".table($Q),($Z?"\nWHERE ".implode(" AND ",$Z):"").($Ic&&$ld?"\nGROUP BY ".implode(", ",$Ic):"").($ne?"\nORDER BY ".implode(", ",$ne):""),($y!=""?+$y:null),($C?$y*$C:0),"\n");$Hf=microtime(true);$G=$this->_conn->query($E);if($Je)echo$b->selectQuery($E,$Hf,!$G);return$G;}function
delete($Q,$Pe,$y=0){$E="FROM ".table($Q);return
queries("DELETE".($y?limit1($Q,$E,$Pe):" $E$Pe"));}function
update($Q,$M,$Pe,$y=0,$K="\n"){$Hg=array();foreach($M
as$x=>$X)$Hg[]="$x = $X";$E=table($Q)." SET$K".implode(",$K",$Hg);return
queries("UPDATE".($y?limit1($Q,$E,$Pe,$K):" $E$Pe"));}function
insert($Q,$M){return
queries("INSERT INTO ".table($Q).($M?" (".implode(", ",array_keys($M)).")\nVALUES (".implode(", ",$M).")":" DEFAULT VALUES"));}function
insertUpdate($Q,$I,$He){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($E,$Zf){}function
convertSearch($t,$X,$o){return$t;}function
convertOperator($je){return$je;}function
value($X,$o){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$o):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($hf){return
q($hf);}function
warnings(){return'';}function
tableHelp($A){}function
hasCStyleEscapes(){return
false;}}$Mb["sqlite"]="SQLite 3";$Mb["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($q){$this->_link=new
SQLite3($q);$Jg=$this->_link->version();$this->server_info=$Jg["versionString"];}function
query($E){$F=@$this->_link->query($E);$this->error="";if(!$F){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($F->numColumns())return
new
Min_Result($F);$this->affected_rows=$this->_link->changes();return
true;}function
quote($P){return(is_utf8($P)?"'".$this->_link->escapeString($P)."'":"x'".reset(unpack('H*',$P))."'");}function
store_result(){return$this->_result;}function
result($E,$o=0){$F=$this->query($E);if(!is_object($F))return
false;$H=$F->_result->fetchArray();return$H?$H[$o]:false;}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($F){$this->_result=$F;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$e=$this->_offset++;$T=$this->_result->columnType($e);return(object)array("name"=>$this->_result->columnName($e),"type"=>$T,"charsetnr"=>($T==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($q){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($q);}function
query($E,$tg=false){$Qd=($tg?"unbufferedQuery":"query");$F=@$this->_link->$Qd($E,SQLITE_BOTH,$n);$this->error="";if(!$F){$this->error=$n;return
false;}elseif($F===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($F);}function
quote($P){return"'".sqlite_escape_string($P)."'";}function
store_result(){return$this->_result;}function
result($E,$o=0){$F=$this->query($E);if(!is_object($F))return
false;$H=$F->_result->fetch();return$H[$o];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($F){$this->_result=$F;if(method_exists($F,'numRows'))$this->num_rows=$F->numRows();}function
fetch_assoc(){$H=$this->_result->fetch(SQLITE_ASSOC);if(!$H)return
false;$G=array();foreach($H
as$x=>$X)$G[idf_unescape($x)]=$X;return$G;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$A=$this->_result->fieldName($this->_offset++);$Ae='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($Ae\\.)?$Ae\$~",$A,$_)){$Q=($_[3]!=""?$_[3]:idf_unescape($_[2]));$A=($_[5]!=""?$_[5]:idf_unescape($_[4]));}return(object)array("name"=>$A,"orgname"=>$A,"orgtable"=>$Q,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($q){$this->dsn(DRIVER.":$q","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($q){if(is_readable($q)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$q)?$q:dirname($_SERVER["SCRIPT_FILENAME"])."/$q")." AS a")){parent::__construct($q);$this->query("PRAGMA foreign_keys = 1");$this->query("PRAGMA busy_timeout = 500");return
true;}return
false;}function
multi_query($E){return$this->_result=$this->query($E);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$I,$He){$Hg=array();foreach($I
as$M)$Hg[]="(".implode(", ",$M).")";return
queries("REPLACE INTO ".table($Q)." (".implode(", ",array_keys(reset($I))).") VALUES\n".implode(",\n",$Hg));}function
tableHelp($A){if($A=="sqlite_sequence")return"fileformat2.html#seqtab";if($A=="sqlite_master")return"fileformat2.html#$A";}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b;list(,,$D)=$b->credentials();if($D!="")return
lang(23);return
new
Min_DB;}function
get_databases(){return
array();}function
limit($E,$Z,$y,$ce=0,$K=" "){return" $E$Z".($y!==null?$K."LIMIT $y".($ce?" OFFSET $ce":""):"");}function
limit1($Q,$E,$Z,$K="\n"){global$h;return(preg_match('~^INTO~',$E)||$h->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($E,$Z,1,0,$K):" $E WHERE rowid = (SELECT rowid FROM ".table($Q).$Z.$K."LIMIT 1)");}function
db_collation($l,$bb){global$h;return$h->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($k){return
array();}function
table_status($A=""){global$h;$G=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($A!=""?"AND name = ".q($A):"ORDER BY name"))as$H){$H["Rows"]=$h->result("SELECT COUNT(*) FROM ".idf_escape($H["Name"]));$G[$H["Name"]]=$H;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$H)$G[$H["name"]]["Auto_increment"]=$H["seq"];return($A!=""?$G[$A]:$G);}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){global$h;return!$h->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($Q){global$h;$G=array();$He="";foreach(get_rows("PRAGMA table_info(".table($Q).")")as$H){$A=$H["name"];$T=strtolower($H["type"]);$Cb=$H["dflt_value"];$G[$A]=array("field"=>$A,"type"=>(preg_match('~int~i',$T)?"integer":(preg_match('~char|clob|text~i',$T)?"text":(preg_match('~blob~i',$T)?"blob":(preg_match('~real|floa|doub~i',$T)?"real":"numeric")))),"full_type"=>$T,"default"=>(preg_match("~^'(.*)'$~",$Cb,$_)?str_replace("''","'",$_[1]):($Cb=="NULL"?null:$Cb)),"null"=>!$H["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$H["pk"],);if($H["pk"]){if($He!="")$G[$He]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$T))$G[$A]["auto_increment"]=true;$He=$A;}}$Ef=$h->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$Ef,$Id,PREG_SET_ORDER);foreach($Id
as$_){$A=str_replace('""','"',preg_replace('~^"|"$~','',$_[1]));if($G[$A])$G[$A]["collation"]=trim($_[3],"'");}return$G;}function
indexes($Q,$i=null){global$h;if(!is_object($i))$i=$h;$G=array();$Ef=$i->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$Ef,$_)){$G[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$_[1],$Id,PREG_SET_ORDER);foreach($Id
as$_){$G[""]["columns"][]=idf_unescape($_[2]).$_[4];$G[""]["descs"][]=(preg_match('~DESC~i',$_[5])?'1':null);}}if(!$G){foreach(fields($Q)as$A=>$o){if($o["primary"])$G[""]=array("type"=>"PRIMARY","columns"=>array($A),"lengths"=>array(),"descs"=>array(null));}}$Gf=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($Q),$i);foreach(get_rows("PRAGMA index_list(".table($Q).")",$i)as$H){$A=$H["name"];$u=array("type"=>($H["unique"]?"UNIQUE":"INDEX"));$u["lengths"]=array();$u["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($A).")",$i)as$gf){$u["columns"][]=$gf["name"];$u["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($A).' ON '.idf_escape($Q),'~').' \((.*)\)$~i',$Gf[$A],$Ue)){preg_match_all('/("[^"]*+")+( DESC)?/',$Ue[2],$Id);foreach($Id[2]as$x=>$X){if($X)$u["descs"][$x]='1';}}if(!$G[""]||$u["type"]!="UNIQUE"||$u["columns"]!=$G[""]["columns"]||$u["descs"]!=$G[""]["descs"]||!preg_match("~^sqlite_~",$A))$G[$A]=$u;}return$G;}function
foreign_keys($Q){$G=array();foreach(get_rows("PRAGMA foreign_key_list(".table($Q).")")as$H){$Bc=&$G[$H["id"]];if(!$Bc)$Bc=$H;$Bc["source"][]=$H["from"];$Bc["target"][]=$H["to"];}return$G;}function
view($A){global$h;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$h->result("SELECT sql FROM sqlite_master WHERE name = ".q($A))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($l){return
false;}function
error(){global$h;return
h($h->error);}function
check_sqlite_name($A){global$h;$lc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($lc)\$~",$A)){$h->error=lang(24,str_replace("|",", ",$lc));return
false;}return
true;}function
create_database($l,$d){global$h;if(file_exists($l)){$h->error=lang(25);return
false;}if(!check_sqlite_name($l))return
false;try{$z=new
Min_SQLite($l);}catch(Exception$fc){$h->error=$fc->getMessage();return
false;}$z->query('PRAGMA encoding = "UTF-8"');$z->query('CREATE TABLE adminer (i)');$z->query('DROP TABLE adminer');return
true;}function
drop_databases($k){global$h;$h->__construct(":memory:");foreach($k
as$l){if(!@unlink($l)){$h->error=lang(25);return
false;}}return
true;}function
rename_database($A,$d){global$h;if(!check_sqlite_name($A))return
false;$h->__construct(":memory:");$h->error=lang(25);return@rename(DB,$A);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($Q,$A,$p,$zc,$gb,$Yb,$d,$Da,$_e){global$h;$Dg=($Q==""||$zc);foreach($p
as$o){if($o[0]!=""||!$o[1]||$o[2]){$Dg=true;break;}}$c=array();$se=array();foreach($p
as$o){if($o[1]){$c[]=($Dg?$o[1]:"ADD ".implode($o[1]));if($o[0]!="")$se[$o[0]]=$o[1][0];}}if(!$Dg){foreach($c
as$X){if(!queries("ALTER TABLE ".table($Q)." $X"))return
false;}if($Q!=$A&&!queries("ALTER TABLE ".table($Q)." RENAME TO ".table($A)))return
false;}elseif(!recreate_table($Q,$A,$c,$se,$zc,$Da))return
false;if($Da){queries("BEGIN");queries("UPDATE sqlite_sequence SET seq = $Da WHERE name = ".q($A));if(!$h->affected_rows)queries("INSERT INTO sqlite_sequence (name, seq) VALUES (".q($A).", $Da)");queries("COMMIT");}return
true;}function
recreate_table($Q,$A,$p,$se,$zc,$Da=0,$v=array()){global$h;if($Q!=""){if(!$p){foreach(fields($Q)as$x=>$o){if($v)$o["auto_increment"]=0;$p[]=process_field($o,$o);$se[$x]=idf_escape($x);}}$Ie=false;foreach($p
as$o){if($o[6])$Ie=true;}$Ob=array();foreach($v
as$x=>$X){if($X[2]=="DROP"){$Ob[$X[1]]=true;unset($v[$x]);}}foreach(indexes($Q)as$pd=>$u){$f=array();foreach($u["columns"]as$x=>$e){if(!$se[$e])continue
2;$f[]=$se[$e].($u["descs"][$x]?" DESC":"");}if(!$Ob[$pd]){if($u["type"]!="PRIMARY"||!$Ie)$v[]=array($u["type"],$pd,$f);}}foreach($v
as$x=>$X){if($X[0]=="PRIMARY"){unset($v[$x]);$zc[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($Q)as$pd=>$Bc){foreach($Bc["source"]as$x=>$e){if(!$se[$e])continue
2;$Bc["source"][$x]=idf_unescape($se[$e]);}if(!isset($zc[" $pd"]))$zc[]=" ".format_foreign_key($Bc);}queries("BEGIN");}foreach($p
as$x=>$o)$p[$x]="  ".implode($o);$p=array_merge($p,array_filter($zc));$Tf=($Q==$A?"adminer_$A":$A);if(!queries("CREATE TABLE ".table($Tf)." (\n".implode(",\n",$p)."\n)"))return
false;if($Q!=""){if($se&&!queries("INSERT INTO ".table($Tf)." (".implode(", ",$se).") SELECT ".implode(", ",array_map('idf_escape',array_keys($se)))." FROM ".table($Q)))return
false;$rg=array();foreach(triggers($Q)as$pg=>$ag){$og=trigger($pg);$rg[]="CREATE TRIGGER ".idf_escape($pg)." ".implode(" ",$ag)." ON ".table($A)."\n$og[Statement]";}$Da=$Da?0:$h->result("SELECT seq FROM sqlite_sequence WHERE name = ".q($Q));if(!queries("DROP TABLE ".table($Q))||($Q==$A&&!queries("ALTER TABLE ".table($Tf)." RENAME TO ".table($A)))||!alter_indexes($A,$v))return
false;if($Da)queries("UPDATE sqlite_sequence SET seq = $Da WHERE name = ".q($A));foreach($rg
as$og){if(!queries($og))return
false;}queries("COMMIT");}return
true;}function
index_sql($Q,$T,$A,$f){return"CREATE $T ".($T!="INDEX"?"INDEX ":"").idf_escape($A!=""?$A:uniqid($Q."_"))." ON ".table($Q)." $f";}function
alter_indexes($Q,$c){foreach($c
as$He){if($He[0]=="PRIMARY")return
recreate_table($Q,$Q,array(),array(),array(),0,$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($Q,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($S){return
apply_queries("DELETE FROM",$S);}function
drop_views($Lg){return
apply_queries("DROP VIEW",$Lg);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
move_tables($S,$Lg,$Sf){return
false;}function
trigger($A){global$h;if($A=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$t='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$qg=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$t\\s*(".implode("|",$qg["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($t))?\\s+ON\\s*$t\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$h->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($A)),$_);$be=$_[3];return
array("Timing"=>strtoupper($_[1]),"Event"=>strtoupper($_[2]).($be?" OF":""),"Of"=>idf_unescape($be),"Trigger"=>$A,"Statement"=>$_[4],);}function
triggers($Q){$G=array();$qg=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q))as$H){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$qg["Timing"]).')\s*(.*?)\s+ON\b~i',$H["sql"],$_);$G[$H["name"]]=array($_[1],$_[2]);}return$G;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$h;return$h->result("SELECT LAST_INSERT_ROWID()");}function
explain($h,$E){return$h->query("EXPLAIN QUERY PLAN $E");}function
found_rows($R,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($jf){return
true;}function
create_sql($Q,$Da,$Kf){global$h;$G=$h->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($Q));foreach(indexes($Q)as$A=>$u){if($A=='')continue;$G.=";\n\n".index_sql($Q,$u['type'],$A,"(".implode(", ",array_map('idf_escape',$u['columns'])).")");}return$G;}function
truncate_sql($Q){return"DELETE FROM ".table($Q);}function
use_sql($j){}function
trigger_sql($Q){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q)));}function
show_variables(){global$h;$G=array();foreach(get_rows("PRAGMA pragma_list")as$H)$G[$H["name"]]=$h->result("PRAGMA $H[name]");return$G;}function
show_status(){$G=array();foreach(get_vals("PRAGMA compile_options")as$le){list($x,$X)=explode("=",$le,2);$G[$x]=$X;}return$G;}function
convert_field($o){}function
unconvert_field($o,$G){return$G;}function
support($oc){return
preg_match('~^(columns|database|drop_col|dump|indexes|descidx|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$oc);}function
driver_config(){$U=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);return
array('possible_drivers'=>array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite"),'jush'=>"sqlite",'types'=>$U,'structured_types'=>array_keys($U),'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL"),'functions'=>array("hex","length","lower","round","unixepoch","upper"),'grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",)),);}}$Mb["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($cc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($L,$V,$D){global$b;$l=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($L,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($D,"'\\")."'";$N=$b->connectSsl();if(isset($N["mode"]))$this->_string.=" sslmode='".$N["mode"]."'";$this->_link=@pg_connect("$this->_string dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$l!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$Jg=pg_version($this->_link);$this->server_info=$Jg["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($P){return
pg_escape_literal($this->_link,$P);}function
value($X,$o){return($o["type"]=="bytea"&&$X!==null?pg_unescape_bytea($X):$X);}function
quoteBinary($P){return"'".pg_escape_bytea($this->_link,$P)."'";}function
select_db($j){global$b;if($j==$b->database())return$this->_database;$G=@pg_connect("$this->_string dbname='".addcslashes($j,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($G)$this->_link=$G;return$G;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($E,$tg=false){$F=@pg_query($this->_link,$E);$this->error="";if(!$F){$this->error=pg_last_error($this->_link);$G=false;}elseif(!pg_num_fields($F)){$this->affected_rows=pg_affected_rows($F);$G=true;}else$G=new
Min_Result($F);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$G;}function
multi_query($E){return$this->_result=$this->query($E);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($E,$o=0){$F=$this->query($E);if(!$F||!$F->num_rows)return
false;return
pg_fetch_result($F->_result,0,$o);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($F){$this->_result=$F;$this->num_rows=pg_num_rows($F);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$e=$this->_offset++;$G=new
stdClass;if(function_exists('pg_field_table'))$G->orgtable=pg_field_table($this->_result,$e);$G->name=pg_field_name($this->_result,$e);$G->orgname=$G->name;$G->type=pg_field_type($this->_result,$e);$G->charsetnr=($G->type=="bytea"?63:0);return$G;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($L,$V,$D){global$b;$l=$b->database();$Pb="pgsql:host='".str_replace(":","' port='",addcslashes($L,"'\\"))."' client_encoding=utf8 dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'";$N=$b->connectSsl();if(isset($N["mode"]))$Pb.=" sslmode='".$N["mode"]."'";$this->dsn($Pb,$V,$D);return
true;}function
select_db($j){global$b;return($b->database()==$j);}function
quoteBinary($hf){return
q($hf);}function
query($E,$tg=false){$G=parent::query($E,$tg);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$G;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$I,$He){global$h;foreach($I
as$M){$Ag=array();$Z=array();foreach($M
as$x=>$X){$Ag[]="$x = $X";if(isset($He[idf_unescape($x)]))$Z[]="$x = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Ag)." WHERE ".implode(" AND ",$Z))&&$h->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($M)).") VALUES (".implode(", ",$M).")")))return
false;}return
true;}function
slowQuery($E,$Zf){$this->_conn->query("SET statement_timeout = ".(1000*$Zf));$this->_conn->timeout=1000*$Zf;return$E;}function
convertSearch($t,$X,$o){$Vf="char|text";if(strpos($X["op"],"LIKE")===false)$Vf.="|date|time(stamp)?|boolean|uuid|inet|cidr|macaddr|".number_type();return(preg_match("~$Vf~",$o["type"])?$t:"CAST($t AS text)");}function
quoteBinary($hf){return$this->_conn->quoteBinary($hf);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($A){$Bd=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$z=$Bd[$_GET["ns"]];if($z)return"$z-".str_replace("_","-",$A).".html";}function
hasCStyleEscapes(){static$Qa;if($Qa===null)$Qa=($this->_conn->result("SHOW standard_conforming_strings")=="off");return$Qa;}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b,$U,$Jf;$h=new
Min_DB;$vb=$b->credentials();if($h->connect($vb[0],$vb[1],$vb[2])){if(min_version(9,0,$h)){$h->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$h)){$Jf[lang(26)][]="json";$U["json"]=4294967295;if(min_version(9.4,0,$h)){$Jf[lang(26)][]="jsonb";$U["jsonb"]=4294967295;}}}return$h;}return$h->error;}function
get_databases(){return
get_vals("SELECT d.datname FROM pg_database d JOIN pg_roles r ON d.datdba = r.oid
WHERE d.datallowconn = TRUE AND has_database_privilege(d.datname, 'CONNECT') AND pg_has_role(r.rolname, 'USAGE')
ORDER BY d.datname");}function
limit($E,$Z,$y,$ce=0,$K=" "){return" $E$Z".($y!==null?$K."LIMIT $y".($ce?" OFFSET $ce":""):"");}function
limit1($Q,$E,$Z,$K="\n"){return(preg_match('~^INTO~',$E)?limit($E,$Z,1,0,$K):" $E".(is_view(table_status1($Q))?$Z:$K."WHERE ctid = (SELECT ctid FROM ".table($Q).$Z.$K."LIMIT 1)"));}function
db_collation($l,$bb){global$h;return$h->result("SELECT datcollate FROM pg_database WHERE datname = ".q($l));}function
engines(){return
array();}function
logged_user(){global$h;return$h->result("SELECT user");}function
tables_list(){$E="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support("materializedview"))$E.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$E.="
ORDER BY 1";return
get_key_vals($E);}function
count_tables($k){return
array();}function
table_status($A=""){$G=array();foreach(get_rows("SELECT
	c.relname AS \"Name\",
	CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\",
	pg_table_size(c.oid) AS \"Data_length\",
	pg_indexes_size(c.oid) AS \"Index_length\",
	obj_description(c.oid, 'pg_class') AS \"Comment\",
	".(min_version(12)?"''":"CASE WHEN c.relhasoids THEN 'oid' ELSE '' END")." AS \"Oid\",
	c.reltuples as \"Rows\",
	n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f', 'p')
".($A!=""?"AND relname = ".q($A):"ORDER BY relname"))as$H)$G[$H["Name"]]=$H;return($A!=""?$G[$A]:$G);}function
is_view($R){return
in_array($R["Engine"],array("view","materialized view"));}function
fk_support($R){return
true;}function
fields($Q){$G=array();$va=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, pg_get_expr(d.adbin, d.adrelid) AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment".(min_version(10)?", a.attidentity":"")."
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($Q)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$H){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$H["full_type"],$_);list(,$T,$zd,$H["length"],$ra,$xa)=$_;$H["length"].=$xa;$Ta=$T.$ra;if(isset($va[$Ta])){$H["type"]=$va[$Ta];$H["full_type"]=$H["type"].$zd.$xa;}else{$H["type"]=$T;$H["full_type"]=$H["type"].$zd.$ra.$xa;}if(in_array($H['attidentity'],array('a','d')))$H['default']='GENERATED '.($H['attidentity']=='d'?'BY DEFAULT':'ALWAYS').' AS IDENTITY';$H["null"]=!$H["attnotnull"];$H["auto_increment"]=$H['attidentity']||preg_match('~^nextval\(~i',$H["default"]);$H["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^,)]+(.*)~',$H["default"],$_))$H["default"]=($_[1]=="NULL"?null:idf_unescape($_[1]).$_[2]);$G[$H["field"]]=$H;}return$G;}function
indexes($Q,$i=null){global$h;if(!is_object($i))$i=$h;$G=array();$Rf=$i->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($Q));$f=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Rf AND attnum > 0",$i);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption, (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Rf AND ci.oid = i.indexrelid",$i)as$H){$Ve=$H["relname"];$G[$Ve]["type"]=($H["indispartial"]?"INDEX":($H["indisprimary"]?"PRIMARY":($H["indisunique"]?"UNIQUE":"INDEX")));$G[$Ve]["columns"]=array();foreach(explode(" ",$H["indkey"])as$cd)$G[$Ve]["columns"][]=$f[$cd];$G[$Ve]["descs"]=array();foreach(explode(" ",$H["indoption"])as$dd)$G[$Ve]["descs"][]=($dd&1?'1':null);$G[$Ve]["lengths"]=array();}return$G;}function
foreign_keys($Q){global$fe;$G=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($Q)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$H){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$H['definition'],$_)){$H['source']=array_map('idf_unescape',array_map('trim',explode(',',$_[1])));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$_[2],$Hd)){$H['ns']=idf_unescape($Hd[2]);$H['table']=idf_unescape($Hd[4]);}$H['target']=array_map('idf_unescape',array_map('trim',explode(',',$_[3])));$H['on_delete']=(preg_match("~ON DELETE ($fe)~",$_[4],$Hd)?$Hd[1]:'NO ACTION');$H['on_update']=(preg_match("~ON UPDATE ($fe)~",$_[4],$Hd)?$Hd[1]:'NO ACTION');$G[$H['conname']]=$H;}}return$G;}function
view($A){global$h;return
array("select"=>trim($h->result("SELECT pg_get_viewdef(".$h->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($A)).")")));}function
collations(){return
array();}function
information_schema($l){return($l=="information_schema");}function
error(){global$h;$G=h($h->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$G,$_))$G=$_[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($_[3]).'})(.*)~','\1<b>\2</b>',$_[2]).$_[4];return
nl_br($G);}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" ENCODING ".idf_escape($d):""));}function
drop_databases($k){global$h;$h->close();return
apply_queries("DROP DATABASE",$k,'idf_escape');}function
rename_database($A,$d){global$h;$h->close();return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($A));}function
auto_increment(){return"";}function
alter_table($Q,$A,$p,$zc,$gb,$Yb,$d,$Da,$_e){$c=array();$Oe=array();if($Q!=""&&$Q!=$A)$Oe[]="ALTER TABLE ".table($Q)." RENAME TO ".table($A);$qf="";foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c[]="DROP $e";else{$Gg=$X[5];unset($X[5]);if($o[0]==""){if(isset($X[6]))$X[1]=($X[1]==" bigint"?" big":($X[1]==" smallint"?" small":" "))."serial";$c[]=($Q!=""?"ADD ":"  ").implode($X);if(isset($X[6]))$c[]=($Q!=""?"ADD":" ")." PRIMARY KEY ($X[0])";}else{if($e!=$X[0])$Oe[]="ALTER TABLE ".table($A)." RENAME $e TO $X[0]";$c[]="ALTER $e TYPE$X[1]";$rf=$Q."_".idf_unescape($X[0])."_seq";$c[]="ALTER $e ".($X[3]?"SET$X[3]":(isset($X[6])?"SET DEFAULT nextval(".q($rf).")":"DROP DEFAULT"));if(isset($X[6]))$qf="CREATE SEQUENCE IF NOT EXISTS ".idf_escape($rf)." OWNED BY ".idf_escape($Q).".$X[0]";$c[]="ALTER $e ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}if($o[0]!=""||$Gg!="")$Oe[]="COMMENT ON COLUMN ".table($A).".$X[0] IS ".($Gg!=""?substr($Gg,9):"''");}}$c=array_merge($c,$zc);if($Q=="")array_unshift($Oe,"CREATE TABLE ".table($A)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($Oe,"ALTER TABLE ".table($Q)."\n".implode(",\n",$c));if($qf)array_unshift($Oe,$qf);if($gb!==null)$Oe[]="COMMENT ON TABLE ".table($A)." IS ".q($gb);if($Da!=""){}foreach($Oe
as$E){if(!queries($E))return
false;}return
true;}function
alter_indexes($Q,$c){$tb=array();$Nb=array();$Oe=array();foreach($c
as$X){if($X[0]!="INDEX")$tb[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$Nb[]=idf_escape($X[1]);else$Oe[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($tb)array_unshift($Oe,"ALTER TABLE ".table($Q).implode(",",$tb));if($Nb)array_unshift($Oe,"DROP INDEX ".implode(", ",$Nb));foreach($Oe
as$E){if(!queries($E))return
false;}return
true;}function
truncate_tables($S){return
queries("TRUNCATE ".implode(", ",array_map('table',$S)));return
true;}function
drop_views($Lg){return
drop_tables($Lg);}function
drop_tables($S){foreach($S
as$Q){$O=table_status($Q);if(!queries("DROP ".strtoupper($O["Engine"])." ".table($Q)))return
false;}return
true;}function
move_tables($S,$Lg,$Sf){foreach(array_merge($S,$Lg)as$Q){$O=table_status($Q);if(!queries("ALTER ".strtoupper($O["Engine"])." ".table($Q)." SET SCHEMA ".idf_escape($Sf)))return
false;}return
true;}function
trigger($A,$Q){if($A=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");$f=array();$Z="WHERE trigger_schema = current_schema() AND event_object_table = ".q($Q)." AND trigger_name = ".q($A);foreach(get_rows("SELECT * FROM information_schema.triggered_update_columns $Z")as$H)$f[]=$H["event_object_column"];$G=array();foreach(get_rows('SELECT trigger_name AS "Trigger", action_timing AS "Timing", event_manipulation AS "Event", \'FOR EACH \' || action_orientation AS "Type", action_statement AS "Statement" FROM information_schema.triggers '."$Z ORDER BY event_manipulation DESC")as$H){if($f&&$H["Event"]=="UPDATE")$H["Event"].=" OF";$H["Of"]=implode(", ",$f);if($G)$H["Event"].=" OR $G[Event]";$G=$H;}return$G;}function
triggers($Q){$G=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE trigger_schema = current_schema() AND event_object_table = ".q($Q))as$H){$og=trigger($H["trigger_name"],$Q);$G[$og["Trigger"]]=array($og["Timing"],$og["Event"]);}return$G;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE","INSERT OR UPDATE","INSERT OR UPDATE OF","DELETE OR INSERT","DELETE OR UPDATE","DELETE OR UPDATE OF","DELETE OR INSERT OR UPDATE","DELETE OR INSERT OR UPDATE OF"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($A,$T){$I=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($A));$G=$I[0];$G["returns"]=array("type"=>$G["type_udt_name"]);$G["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($A).'
ORDER BY ordinal_position');return$G;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($A,$H){$G=array();foreach($H["fields"]as$o)$G[]=$o["type"];return
idf_escape($A)."(".implode(", ",$G).")";}function
last_id(){return
0;}function
explain($h,$E){return$h->query("EXPLAIN $E");}function
found_rows($R,$Z){global$h;if(preg_match("~ rows=([0-9]+)~",$h->result("EXPLAIN SELECT * FROM ".idf_escape($R["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$Ue))return$Ue[1];return
false;}function
types(){return
get_key_vals("SELECT oid, typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$h;return$h->result("SELECT current_schema()");}function
set_schema($if,$i=null){global$h,$U,$Jf;if(!$i)$i=$h;$G=$i->query("SET search_path TO ".idf_escape($if));foreach(types()as$x=>$T){if(!isset($U[$T])){$U[$T]=$x;$Jf[lang(9)][]=$T;}}return$G;}function
foreign_keys_sql($Q){$G="";$O=table_status($Q);$wc=foreign_keys($Q);ksort($wc);foreach($wc
as$vc=>$uc)$G.="ALTER TABLE ONLY ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." ADD CONSTRAINT ".idf_escape($vc)." $uc[definition] ".($uc['deferrable']?'DEFERRABLE':'NOT DEFERRABLE').";\n";return($G?"$G\n":$G);}function
create_sql($Q,$Da,$Kf){$ef=array();$sf=array();$O=table_status($Q);if(is_view($O)){$Kg=view($Q);return
rtrim("CREATE VIEW ".idf_escape($Q)." AS $Kg[select]",";");}$p=fields($Q);$v=indexes($Q);ksort($v);if(!$O||empty($p))return
false;$G="CREATE TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." (\n    ";foreach($p
as$o){$ze=idf_escape($o['field']).' '.$o['full_type'].default_value($o).($o['attnotnull']?" NOT NULL":"");$ef[]=$ze;if(preg_match('~nextval\(\'([^\']+)\'\)~',$o['default'],$Id)){$rf=$Id[1];$Df=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q(idf_unescape($rf)):"SELECT * FROM $rf"));$sf[]=($Kf=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $rf;\n":"")."CREATE SEQUENCE $rf INCREMENT $Df[increment_by] MINVALUE $Df[min_value] MAXVALUE $Df[max_value]".($Da&&$Df['last_value']?" START ".($Df["last_value"]+1):"")." CACHE $Df[cache_value];";}}if(!empty($sf))$G=implode("\n\n",$sf)."\n\n$G";foreach($v
as$ad=>$u){switch($u['type']){case'UNIQUE':$ef[]="CONSTRAINT ".idf_escape($ad)." UNIQUE (".implode(', ',array_map('idf_escape',$u['columns'])).")";break;case'PRIMARY':$ef[]="CONSTRAINT ".idf_escape($ad)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$u['columns'])).")";break;}}$ob=get_key_vals("SELECT conname, ".(min_version(8)?"pg_get_constraintdef(pg_constraint.oid)":"CONCAT('CHECK ', consrc)")."
FROM pg_catalog.pg_constraint
INNER JOIN pg_catalog.pg_namespace ON pg_constraint.connamespace = pg_namespace.oid
INNER JOIN pg_catalog.pg_class ON pg_constraint.conrelid = pg_class.oid AND pg_constraint.connamespace = pg_class.relnamespace
WHERE pg_constraint.contype = 'c'
AND conrelid != 0 -- handle only CONSTRAINTs here, not TYPES
AND nspname = current_schema()
AND relname = ".q($Q)."
ORDER BY connamespace, conname");foreach($ob
as$lb=>$nb)$ef[]="CONSTRAINT ".idf_escape($lb)." $nb";$G.=implode(",\n    ",$ef)."\n) WITH (oids = ".($O['Oid']?'true':'false').");";foreach($v
as$ad=>$u){if($u['type']=='INDEX'){$f=array();foreach($u['columns']as$x=>$X)$f[]=idf_escape($X).($u['descs'][$x]?" DESC":"");$G.="\n\nCREATE INDEX ".idf_escape($ad)." ON ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." USING btree (".implode(', ',$f).");";}}if($O['Comment'])$G.="\n\nCOMMENT ON TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." IS ".q($O['Comment']).";";foreach($p
as$pc=>$o){if($o['comment'])$G.="\n\nCOMMENT ON COLUMN ".idf_escape($O['nspname']).".".idf_escape($O['Name']).".".idf_escape($pc)." IS ".q($o['comment']).";";}return
rtrim($G,';');}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
trigger_sql($Q){$O=table_status($Q);$G="";foreach(triggers($Q)as$ng=>$mg){$og=trigger($ng,$O['Name']);$G.="\nCREATE TRIGGER ".idf_escape($og['Trigger'])." $og[Timing] $og[Event] ON ".idf_escape($O["nspname"]).".".idf_escape($O['Name'])." $og[Type] $og[Statement];;\n";}return$G;}function
use_sql($j){return"\connect ".idf_escape($j);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($o){}function
unconvert_field($o,$G){return$G;}function
support($oc){return
preg_match('~^(check|database|table|columns|sql|indexes|descidx|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$oc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$h;return$h->result("SHOW max_connections");}function
driver_config(){$U=array();$Jf=array();foreach(array(lang(27)=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),lang(28)=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),lang(26)=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),lang(29)=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),lang(30)=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"macaddr8"=>23,"txid_snapshot"=>0),lang(31)=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$x=>$X){$U+=$X;$Jf[$x]=array_keys($X);}return
array('possible_drivers'=>array("PgSQL","PDO_PgSQL"),'jush'=>"pgsql",'types'=>$U,'structured_types'=>$Jf,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'functions'=>array("char_length","lower","round","to_hex","to_timestamp","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",)),);}}$Mb["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;var$_current_db;function
_error($cc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($L,$V,$D){$this->_link=@oci_new_connect($V,$D,$L,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$n=oci_error();$this->error=$n["message"];return
false;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($j){$this->_current_db=$j;return
true;}function
query($E,$tg=false){$F=oci_parse($this->_link,$E);$this->error="";if(!$F){$n=oci_error($this->_link);$this->errno=$n["code"];$this->error=$n["message"];return
false;}set_error_handler(array($this,'_error'));$G=@oci_execute($F);restore_error_handler();if($G){if(oci_num_fields($F))return
new
Min_Result($F);$this->affected_rows=oci_num_rows($F);oci_free_statement($F);}return$G;}function
multi_query($E){return$this->_result=$this->query($E);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($E,$o=1){$F=$this->query($E);if(!is_object($F)||!oci_fetch($F->_result))return
false;return
oci_result($F->_result,$o);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($F){$this->_result=$F;}function
_convert($H){foreach((array)$H
as$x=>$X){if(is_a($X,'OCI-Lob'))$H[$x]=$X->load();}return$H;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$e=$this->_offset++;$G=new
stdClass;$G->name=oci_field_name($this->_result,$e);$G->orgname=$G->name;$G->type=oci_field_type($this->_result,$e);$G->charsetnr=(preg_match("~raw|blob|bfile~",$G->type)?63:0);return$G;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";var$_current_db;function
connect($L,$V,$D){$this->dsn("oci:dbname=//$L;charset=AL32UTF8",$V,$D);return
true;}function
select_db($j){$this->_current_db=$j;return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}function
insertUpdate($Q,$I,$He){global$h;foreach($I
as$M){$Ag=array();$Z=array();foreach($M
as$x=>$X){$Ag[]="$x = $X";if(isset($He[idf_unescape($x)]))$Z[]="$x = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Ag)." WHERE ".implode(" AND ",$Z))&&$h->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($M)).") VALUES (".implode(", ",$M).")")))return
false;}return
true;}function
hasCStyleEscapes(){return
true;}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b;$h=new
Min_DB;$vb=$b->credentials();if($h->connect($vb[0],$vb[1],$vb[2]))return$h;return$h->error;}function
get_databases(){return
get_vals("SELECT DISTINCT tablespace_name FROM (
SELECT tablespace_name FROM user_tablespaces
UNION SELECT tablespace_name FROM all_tables WHERE tablespace_name IS NOT NULL
)
ORDER BY 1");}function
limit($E,$Z,$y,$ce=0,$K=" "){return($ce?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $E$Z) t WHERE rownum <= ".($y+$ce).") WHERE rnum > $ce":($y!==null?" * FROM (SELECT $E$Z) WHERE rownum <= ".($y+$ce):" $E$Z"));}function
limit1($Q,$E,$Z,$K="\n"){return" $E$Z";}function
db_collation($l,$bb){global$h;return$h->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$h;return$h->result("SELECT USER FROM DUAL");}function
get_current_db(){global$h;$l=$h->_current_db?$h->_current_db:DB;unset($h->_current_db);return$l;}function
where_owner($Ge,$ue="owner"){if(!$_GET["ns"])return'';return"$Ge$ue = sys_context('USERENV', 'CURRENT_SCHEMA')";}function
views_table($f){$ue=where_owner('');return"(SELECT $f FROM all_views WHERE ".($ue?$ue:"rownum < 0").")";}function
tables_list(){$Kg=views_table("view_name");$ue=where_owner(" AND ");return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."$ue
UNION SELECT view_name, 'view' FROM $Kg
ORDER BY 1");}function
count_tables($k){global$h;$G=array();foreach($k
as$l)$G[$l]=$h->result("SELECT COUNT(*) FROM all_tables WHERE tablespace_name = ".q($l));return$G;}function
table_status($A=""){$G=array();$kf=q($A);$l=get_current_db();$Kg=views_table("view_name");$ue=where_owner(" AND ");foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q($l).$ue.($A!=""?" AND table_name = $kf":"")."
UNION SELECT view_name, 'view', 0, 0 FROM $Kg".($A!=""?" WHERE view_name = $kf":"")."
ORDER BY 1")as$H){if($A!="")return$H;$G[$H["Name"]]=$H;}return$G;}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){return
true;}function
fields($Q){$G=array();$ue=where_owner(" AND ");foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($Q)."$ue ORDER BY column_id")as$H){$T=$H["DATA_TYPE"];$zd="$H[DATA_PRECISION],$H[DATA_SCALE]";if($zd==",")$zd=$H["CHAR_COL_DECL_LENGTH"];$G[$H["COLUMN_NAME"]]=array("field"=>$H["COLUMN_NAME"],"full_type"=>$T.($zd?"($zd)":""),"type"=>strtolower($T),"length"=>$zd,"default"=>$H["DATA_DEFAULT"],"null"=>($H["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$G;}function
indexes($Q,$i=null){$G=array();$ue=where_owner(" AND ","aic.table_owner");foreach(get_rows("SELECT aic.*, ac.constraint_type, atc.data_default
FROM all_ind_columns aic
LEFT JOIN all_constraints ac ON aic.index_name = ac.constraint_name AND aic.table_name = ac.table_name AND aic.index_owner = ac.owner
LEFT JOIN all_tab_cols atc ON aic.column_name = atc.column_name AND aic.table_name = atc.table_name AND aic.index_owner = atc.owner
WHERE aic.table_name = ".q($Q)."$ue
ORDER BY ac.constraint_type, aic.column_position",$i)as$H){$ad=$H["INDEX_NAME"];$eb=$H["DATA_DEFAULT"];$eb=($eb?trim($eb,'"'):$H["COLUMN_NAME"]);$G[$ad]["type"]=($H["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($H["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$G[$ad]["columns"][]=$eb;$G[$ad]["lengths"][]=($H["CHAR_LENGTH"]&&$H["CHAR_LENGTH"]!=$H["COLUMN_LENGTH"]?$H["CHAR_LENGTH"]:null);$G[$ad]["descs"][]=($H["DESCEND"]&&$H["DESCEND"]=="DESC"?'1':null);}return$G;}function
view($A){$Kg=views_table("view_name, text");$I=get_rows('SELECT text "select" FROM '.$Kg.' WHERE view_name = '.q($A));return
reset($I);}function
collations(){return
array();}function
information_schema($l){return
false;}function
error(){global$h;return
h($h->error);}function
explain($h,$E){$h->query("EXPLAIN PLAN FOR $E");return$h->query("SELECT * FROM plan_table");}function
found_rows($R,$Z){}function
auto_increment(){return"";}function
alter_table($Q,$A,$p,$zc,$gb,$Yb,$d,$Da,$_e){$c=$Nb=array();$qe=($Q?fields($Q):array());foreach($p
as$o){$X=$o[1];if($X&&$o[0]!=""&&idf_escape($o[0])!=$X[0])queries("ALTER TABLE ".table($Q)." RENAME COLUMN ".idf_escape($o[0])." TO $X[0]");$pe=$qe[$o[0]];if($X&&$pe){$ee=process_field($pe,$pe);if($X[2]==$ee[2])$X[2]="";}if($X)$c[]=($Q!=""?($o[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($Q!=""?")":"");else$Nb[]=idf_escape($o[0]);}if($Q=="")return
queries("CREATE TABLE ".table($A)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($Q)."\n".implode("\n",$c)))&&(!$Nb||queries("ALTER TABLE ".table($Q)." DROP (".implode(", ",$Nb).")"))&&($Q==$A||queries("ALTER TABLE ".table($Q)." RENAME TO ".table($A)));}function
alter_indexes($Q,$c){$Nb=array();$Oe=array();foreach($c
as$X){if($X[0]!="INDEX"){$X[2]=preg_replace('~ DESC$~','',$X[2]);$tb=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");array_unshift($Oe,"ALTER TABLE ".table($Q).$tb);}elseif($X[2]=="DROP")$Nb[]=idf_escape($X[1]);else$Oe[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($Nb)array_unshift($Oe,"DROP INDEX ".implode(", ",$Nb));foreach($Oe
as$E){if(!queries($E))return
false;}return
true;}function
foreign_keys($Q){$G=array();$E="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($Q);foreach(get_rows($E)as$H)$G[$H['NAME']]=array("db"=>$H['DEST_DB'],"table"=>$H['DEST_TABLE'],"source"=>array($H['SRC_COLUMN']),"target"=>array($H['DEST_COLUMN']),"on_delete"=>$H['ON_DELETE'],"on_update"=>null,);return$G;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Lg){return
apply_queries("DROP VIEW",$Lg);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
last_id(){return
0;}function
schemas(){$G=get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX')) ORDER BY 1");return($G?$G:get_vals("SELECT DISTINCT owner FROM all_tables WHERE tablespace_name = ".q(DB)." ORDER BY 1"));}function
get_schema(){global$h;return$h->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($jf,$i=null){global$h;if(!$i)$i=$h;return$i->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($jf));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$I=get_rows('SELECT * FROM v$instance');return
reset($I);}function
convert_field($o){}function
unconvert_field($o,$G){return$G;}function
support($oc){return
preg_match('~^(columns|database|drop_col|indexes|descidx|processlist|scheme|sql|status|table|variables|view)$~',$oc);}function
driver_config(){$U=array();$Jf=array();foreach(array(lang(27)=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),lang(28)=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),lang(26)=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),lang(29)=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$x=>$X){$U+=$X;$Jf[$x]=array_keys($X);}return
array('possible_drivers'=>array("OCI8","PDO_OCI"),'jush'=>"oracle",'types'=>$U,'structured_types'=>$Jf,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL"),'functions'=>array("length","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",)),);}}$Mb["mssql"]="MS SQL";if(isset($_GET["mssql"])){define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$n){$this->errno=$n["code"];$this->error.="$n[message]\n";}$this->error=rtrim($this->error);}function
connect($L,$V,$D){global$b;$mb=array("UID"=>$V,"PWD"=>$D,"CharacterSet"=>"UTF-8");$N=$b->connectSsl();if(isset($N["Encrypt"]))$mb["Encrypt"]=$N["Encrypt"];if(isset($N["TrustServerCertificate"]))$mb["TrustServerCertificate"]=$N["TrustServerCertificate"];$l=$b->database();if($l!="")$mb["Database"]=$l;$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$L),$mb);if($this->_link){$ed=sqlsrv_server_info($this->_link);$this->server_info=$ed['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($P){$ug=strlen($P)!=strlen(utf8_decode($P));return($ug?"N":"")."'".str_replace("'","''",$P)."'";}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($E,$tg=false){$F=sqlsrv_query($this->_link,$E);$this->error="";if(!$F){$this->_get_error();return
false;}return$this->store_result($F);}function
multi_query($E){$this->_result=sqlsrv_query($this->_link,$E);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($F=null){if(!$F)$F=$this->_result;if(!$F)return
false;if(sqlsrv_field_metadata($F))return
new
Min_Result($F);$this->affected_rows=sqlsrv_rows_affected($F);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($E,$o=0){$F=$this->query($E);if(!is_object($F))return
false;$H=$F->fetch_row();return$H[$o];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($F){$this->_result=$F;}function
_convert($H){foreach((array)$H
as$x=>$X){if(is_a($X,'DateTime'))$H[$x]=$X->format("Y-m-d H:i:s");}return$H;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$o=$this->_fields[$this->_offset++];$G=new
stdClass;$G->name=$o["Name"];$G->orgname=$o["Name"];$G->type=($o["Type"]==1?254:0);return$G;}function
seek($ce){for($s=0;$s<$ce;$s++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($L,$V,$D){$this->_link=@mssql_connect($L,$V,$D);if($this->_link){$F=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($F){$H=$F->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$H[0]] $H[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($P){$ug=strlen($P)!=strlen(utf8_decode($P));return($ug?"N":"")."'".str_replace("'","''",$P)."'";}function
select_db($j){return
mssql_select_db($j);}function
query($E,$tg=false){$F=@mssql_query($E,$this->_link);$this->error="";if(!$F){$this->error=mssql_get_last_message();return
false;}if($F===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($F);}function
multi_query($E){return$this->_result=$this->query($E);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($E,$o=0){$F=$this->query($E);if(!is_object($F))return
false;return
mssql_result($F->_result,0,$o);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($F){$this->_result=$F;$this->num_rows=mssql_num_rows($F);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$G=mssql_fetch_field($this->_result);$G->orgtable=$G->table;$G->orgname=$G->name;return$G;}function
seek($ce){mssql_data_seek($this->_result,$ce);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($L,$V,$D){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$L)),$V,$D);return
true;}function
select_db($j){return$this->query("USE ".idf_escape($j));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$I,$He){foreach($I
as$M){$Ag=array();$Z=array();foreach($M
as$x=>$X){$Ag[]="$x = $X";if(isset($He[idf_unescape($x)]))$Z[]="$x = $X";}if(!queries("MERGE ".table($Q)." USING (VALUES(".implode(", ",$M).")) AS source (c".implode(", c",range(1,count($M))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Ag)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($M)).") VALUES (".implode(", ",$M).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($t){return"[".str_replace("]","]]",$t)."]";}function
table($t){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($t);}function
connect(){global$b;$h=new
Min_DB;$vb=$b->credentials();if($vb[0]=="")$vb[0]="localhost:1433";if($h->connect($vb[0],$vb[1],$vb[2]))return$h;return$h->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($E,$Z,$y,$ce=0,$K=" "){return($y!==null?" TOP (".($y+$ce).")":"")." $E$Z";}function
limit1($Q,$E,$Z,$K="\n"){return
limit($E,$Z,1,0,$K);}function
db_collation($l,$bb){global$h;return$h->result("SELECT collation_name FROM sys.databases WHERE name = ".q($l));}function
engines(){return
array();}function
logged_user(){global$h;return$h->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($k){global$h;$G=array();foreach($k
as$l){$h->select_db($l);$G[$l]=$h->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$G;}function
table_status($A=""){$G=array();foreach(get_rows("SELECT ao.name AS Name, ao.type_desc AS Engine, (SELECT value FROM fn_listextendedproperty(default, 'SCHEMA', schema_name(schema_id), 'TABLE', ao.name, null, null)) AS Comment
FROM sys.all_objects AS ao
WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($A!=""?"AND name = ".q($A):"ORDER BY name"))as$H){if($A!="")return$H;$G[$H["Name"]]=$H;}return$G;}function
is_view($R){return$R["Engine"]=="VIEW";}function
fk_support($R){return
true;}function
fields($Q){$hb=get_key_vals("SELECT objname, cast(value as varchar(max)) FROM fn_listextendedproperty('MS_DESCRIPTION', 'schema', ".q(get_schema()).", 'table', ".q($Q).", 'column', NULL)");$G=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default], d.name default_constraint
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.object_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($Q))as$H){$T=$H["type"];$zd=(preg_match("~char|binary~",$T)?$H["max_length"]/($T[0]=='n'?2:1):($T=="decimal"?"$H[precision],$H[scale]":""));$G[$H["name"]]=array("field"=>$H["name"],"full_type"=>$T.($zd?"($zd)":""),"type"=>$T,"length"=>$zd,"default"=>(preg_match("~^\('(.*)'\)$~",$H["default"],$_)?str_replace("''","'",$_[1]):$H["default"]),"default_constraint"=>$H["default_constraint"],"null"=>$H["is_nullable"],"auto_increment"=>$H["is_identity"],"collation"=>$H["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$H["is_identity"],"comment"=>$hb[$H["name"]],);}return$G;}function
indexes($Q,$i=null){$G=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($Q),$i)as$H){$A=$H["name"];$G[$A]["type"]=($H["is_primary_key"]?"PRIMARY":($H["is_unique"]?"UNIQUE":"INDEX"));$G[$A]["lengths"]=array();$G[$A]["columns"][$H["key_ordinal"]]=$H["column_name"];$G[$A]["descs"][$H["key_ordinal"]]=($H["is_descending_key"]?'1':null);}return$G;}function
view($A){global$h;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$h->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($A))));}function
collations(){$G=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$d)$G[preg_replace('~_.*~','',$d)][]=$d;return$G;}function
information_schema($l){return
false;}function
error(){global$h;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$h->error)));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).(preg_match('~^[a-z0-9_]+$~i',$d)?" COLLATE $d":""));}function
drop_databases($k){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$k)));}function
rename_database($A,$d){if(preg_match('~^[a-z0-9_]+$~i',$d))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $d");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($A));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($Q,$A,$p,$zc,$gb,$Yb,$d,$Da,$_e){$c=array();$hb=array();$qe=fields($Q);foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c["DROP"][]=" COLUMN $e";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);$hb[$o[0]]=$X[5];unset($X[5]);if($o[0]=="")$c["ADD"][]="\n  ".implode("",$X).($Q==""?substr($zc[$X[0]],16+strlen($X[0])):"");else{$Cb=$X[3];unset($X[3]);unset($X[6]);if($e!=$X[0])queries("EXEC sp_rename ".q(table($Q).".$e").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";$pe=$qe[$o[0]];if(default_value($pe)!=$Cb){if($pe["default"]!==null)$c["DROP"][]=" ".idf_escape($pe["default_constraint"]);if($Cb)$c["ADD"][]="\n $Cb FOR $e";}}}}if($Q=="")return
queries("CREATE TABLE ".table($A)." (".implode(",",(array)$c["ADD"])."\n)");if($Q!=$A)queries("EXEC sp_rename ".q(table($Q)).", ".q($A));if($zc)$c[""]=$zc;foreach($c
as$x=>$X){if(!queries("ALTER TABLE ".table($A)." $x".implode(",",$X)))return
false;}foreach($hb
as$x=>$X){$gb=substr($X,9);queries("EXEC sp_dropextendedproperty @name = N'MS_Description', @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($A).", @level2type = N'Column', @level2name = ".q($x));queries("EXEC sp_addextendedproperty @name = N'MS_Description', @value = ".$gb.", @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($A).", @level2type = N'Column', @level2name = ".q($x));}return
true;}function
alter_indexes($Q,$c){$u=array();$Nb=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$Nb[]=idf_escape($X[1]);else$u[]=idf_escape($X[1])." ON ".table($Q);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q):"ALTER TABLE ".table($Q)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$u||queries("DROP INDEX ".implode(", ",$u)))&&(!$Nb||queries("ALTER TABLE ".table($Q)." DROP ".implode(", ",$Nb)));}function
last_id(){global$h;return$h->result("SELECT SCOPE_IDENTITY()");}function
explain($h,$E){$h->query("SET SHOWPLAN_ALL ON");$G=$h->query($E);$h->query("SET SHOWPLAN_ALL OFF");return$G;}function
found_rows($R,$Z){}function
foreign_keys($Q){$G=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($Q).", @fktable_owner = ".q(get_schema()))as$H){$Bc=&$G[$H["FK_NAME"]];$Bc["db"]=$H["PKTABLE_QUALIFIER"];$Bc["table"]=$H["PKTABLE_NAME"];$Bc["source"][]=$H["FKCOLUMN_NAME"];$Bc["target"][]=$H["PKCOLUMN_NAME"];}return$G;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Lg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Lg)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$Lg,$Sf){return
apply_queries("ALTER SCHEMA ".idf_escape($Sf)." TRANSFER",array_merge($S,$Lg));}function
trigger($A){if($A=="")return
array();$I=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($A));$G=reset($I);if($G)$G["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$G["text"]);return$G;}function
triggers($Q){$G=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($Q))as$H)$G[$H["name"]]=array($H["Timing"],$H["Event"]);return$G;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$h;if($_GET["ns"]!="")return$_GET["ns"];return$h->result("SELECT SCHEMA_NAME()");}function
set_schema($if){return
true;}function
use_sql($j){return"USE ".idf_escape($j);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($o){}function
unconvert_field($o,$G){return$G;}function
support($oc){return
preg_match('~^(check|comment|columns|database|drop_col|indexes|descidx|scheme|sql|table|trigger|view|view_trigger)$~',$oc);}function
driver_config(){$U=array();$Jf=array();foreach(array(lang(27)=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),lang(28)=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),lang(26)=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),lang(29)=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$x=>$X){$U+=$X;$Jf[$x]=array_keys($X);}return
array('possible_drivers'=>array("SQLSRV","MSSQL","PDO_DBLIB"),'jush'=>"mssql",'types'=>$U,'structured_types'=>$Jf,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'functions'=>array("len","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",)),);}}$Mb["mongo"]="MongoDB (alpha)";if(isset($_GET["mongo"])){define("DRIVER","mongo");if(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Bg,$B){try{$this->_link=new
MongoClient($Bg,$B);if($B["password"]!=""){$B["password"]="";try{new
MongoClient($Bg,$B);$this->error=lang(23);}catch(Exception$Qb){}}}catch(Exception$Qb){$this->error=$Qb->getMessage();}}function
query($E){return
false;}function
select_db($j){try{$this->_db=$this->_link->selectDB($j);return
true;}catch(Exception$fc){$this->error=$fc->getMessage();return
false;}}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($F){foreach($F
as$nd){$H=array();foreach($nd
as$x=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$x]=63;$H[$x]=(is_a($X,'MongoId')?"ObjectId(\"$X\")":(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?"$X":(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$H;foreach($H
as$x=>$X){if(!isset($this->_rows[0][$x]))$this->_rows[0][$x]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$H=current($this->_rows);if(!$H)return$H;$G=array();foreach($this->_rows[0]as$x=>$X)$G[$x]=$H[$x];next($this->_rows);return$G;}function
fetch_row(){$G=$this->fetch_assoc();if(!$G)return$G;return
array_values($G);}function
fetch_field(){$qd=array_keys($this->_rows[0]);$A=$qd[$this->_offset++];return(object)array('name'=>$A,'charsetnr'=>$this->_charset[$A],);}}class
Min_Driver
extends
Min_SQL{public$He="_id";function
select($Q,$J,$Z,$Ic,$ne=array(),$y=1,$C=0,$Je=false){$J=($J==array("*")?array():array_fill_keys($J,true));$Af=array();foreach($ne
as$X){$X=preg_replace('~ DESC$~','',$X,1,$rb);$Af[$X]=($rb?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($Q)->find(array(),$J)->sort($Af)->limit($y!=""?+$y:0)->skip($C*$y));}function
insert($Q,$M){try{$G=$this->_conn->_db->selectCollection($Q)->insert($M);$this->_conn->errno=$G['code'];$this->_conn->error=$G['err'];$this->_conn->last_id=$M['_id'];return!$G['err'];}catch(Exception$fc){$this->_conn->error=$fc->getMessage();return
false;}}}function
get_databases($xc){global$h;$G=array();$Ab=$h->_link->listDBs();foreach($Ab['databases']as$l)$G[]=$l['name'];return$G;}function
count_tables($k){global$h;$G=array();foreach($k
as$l)$G[$l]=count($h->_link->selectDB($l)->getCollectionNames(true));return$G;}function
tables_list(){global$h;return
array_fill_keys($h->_db->getCollectionNames(true),'table');}function
drop_databases($k){global$h;foreach($k
as$l){$af=$h->_link->selectDB($l)->drop();if(!$af['ok'])return
false;}return
true;}function
indexes($Q,$i=null){global$h;$G=array();foreach($h->_db->selectCollection($Q)->getIndexInfo()as$u){$Gb=array();foreach($u["key"]as$e=>$T)$Gb[]=($T==-1?'1':null);$G[$u["name"]]=array("type"=>($u["name"]=="_id_"?"PRIMARY":($u["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($u["key"]),"lengths"=>array(),"descs"=>$Gb,);}return$G;}function
fields($Q){return
fields_from_edit();}function
found_rows($R,$Z){global$h;return$h->_db->selectCollection($_GET["select"])->count($Z);}$ke=array("=");}elseif(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$affected_rows,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Bg,$B){$Xa='MongoDB\Driver\Manager';$this->_link=new$Xa($Bg,$B);$this->executeCommand($B["db"],array('ping'=>1));}function
executeCommand($l,$fb){$Xa='MongoDB\Driver\Command';try{return$this->_link->executeCommand($l,new$Xa($fb));}catch(Exception$Qb){$this->error=$Qb->getMessage();return
array();}}function
executeBulkWrite($Wd,$Pa,$sb){try{$df=$this->_link->executeBulkWrite($Wd,$Pa);$this->affected_rows=$df->$sb();return
true;}catch(Exception$Qb){$this->error=$Qb->getMessage();return
false;}}function
query($E){return
false;}function
select_db($j){$this->_db_name=$j;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($F){foreach($F
as$nd){$H=array();foreach($nd
as$x=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$x]=63;$H[$x]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'."$X\")":(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->getData():(is_a($X,'MongoDB\BSON\Regex')?"$X":(is_object($X)||is_array($X)?json_encode($X,256):$X)))));}$this->_rows[]=$H;foreach($H
as$x=>$X){if(!isset($this->_rows[0][$x]))$this->_rows[0][$x]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$H=current($this->_rows);if(!$H)return$H;$G=array();foreach($this->_rows[0]as$x=>$X)$G[$x]=$H[$x];next($this->_rows);return$G;}function
fetch_row(){$G=$this->fetch_assoc();if(!$G)return$G;return
array_values($G);}function
fetch_field(){$qd=array_keys($this->_rows[0]);$A=$qd[$this->_offset++];return(object)array('name'=>$A,'charsetnr'=>$this->_charset[$A],);}}class
Min_Driver
extends
Min_SQL{public$He="_id";function
select($Q,$J,$Z,$Ic,$ne=array(),$y=1,$C=0,$Je=false){global$h;$J=($J==array("*")?array():array_fill_keys($J,1));if(count($J)&&!isset($J['_id']))$J['_id']=0;$Z=where_to_query($Z);$Af=array();foreach($ne
as$X){$X=preg_replace('~ DESC$~','',$X,1,$rb);$Af[$X]=($rb?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$y=$_GET['limit'];$y=min(200,max(1,(int)$y));$yf=$C*$y;$Xa='MongoDB\Driver\Query';try{return
new
Min_Result($h->_link->executeQuery("$h->_db_name.$Q",new$Xa($Z,array('projection'=>$J,'limit'=>$y,'skip'=>$yf,'sort'=>$Af))));}catch(Exception$Qb){$h->error=$Qb->getMessage();return
false;}}function
update($Q,$M,$Pe,$y=0,$K="\n"){global$h;$l=$h->_db_name;$Z=sql_query_where_parser($Pe);$Xa='MongoDB\Driver\BulkWrite';$Pa=new$Xa(array());if(isset($M['_id']))unset($M['_id']);$We=array();foreach($M
as$x=>$Y){if($Y=='NULL'){$We[$x]=1;unset($M[$x]);}}$Ag=array('$set'=>$M);if(count($We))$Ag['$unset']=$We;$Pa->update($Z,$Ag,array('upsert'=>false));return$h->executeBulkWrite("$l.$Q",$Pa,'getModifiedCount');}function
delete($Q,$Pe,$y=0){global$h;$l=$h->_db_name;$Z=sql_query_where_parser($Pe);$Xa='MongoDB\Driver\BulkWrite';$Pa=new$Xa(array());$Pa->delete($Z,array('limit'=>$y));return$h->executeBulkWrite("$l.$Q",$Pa,'getDeletedCount');}function
insert($Q,$M){global$h;$l=$h->_db_name;$Xa='MongoDB\Driver\BulkWrite';$Pa=new$Xa(array());if($M['_id']=='')unset($M['_id']);$Pa->insert($M);return$h->executeBulkWrite("$l.$Q",$Pa,'getInsertedCount');}}function
get_databases($xc){global$h;$G=array();foreach($h->executeCommand($h->_db_name,array('listDatabases'=>1))as$Ab){foreach($Ab->databases
as$l)$G[]=$l->name;}return$G;}function
count_tables($k){$G=array();return$G;}function
tables_list(){global$h;$cb=array();foreach($h->executeCommand($h->_db_name,array('listCollections'=>1))as$F)$cb[$F->name]='table';return$cb;}function
drop_databases($k){return
false;}function
indexes($Q,$i=null){global$h;$G=array();foreach($h->executeCommand($h->_db_name,array('listIndexes'=>$Q))as$u){$Gb=array();$f=array();foreach(get_object_vars($u->key)as$e=>$T){$Gb[]=($T==-1?'1':null);$f[]=$e;}$G[$u->name]=array("type"=>($u->name=="_id_"?"PRIMARY":(isset($u->unique)?"UNIQUE":"INDEX")),"columns"=>$f,"lengths"=>array(),"descs"=>$Gb,);}return$G;}function
fields($Q){global$m;$p=fields_from_edit();if(!$p){$F=$m->select($Q,array("*"),null,null,array(),10);if($F){while($H=$F->fetch_assoc()){foreach($H
as$x=>$X){$H[$x]=null;$p[$x]=array("field"=>$x,"type"=>"string","null"=>($x!=$m->primary),"auto_increment"=>($x==$m->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}}return$p;}function
found_rows($R,$Z){global$h;$Z=where_to_query($Z);$gg=$h->executeCommand($h->_db_name,array('count'=>$R['Name'],'query'=>$Z))->toArray();return$gg[0]->n;}function
sql_query_where_parser($Pe){$Pe=preg_replace('~^\s*WHERE\s*~',"",$Pe);while($Pe[0]=="(")$Pe=preg_replace('~^\((.*)\)$~',"$1",$Pe);$Tg=explode(' AND ',$Pe);$Ug=explode(') OR (',$Pe);$Z=array();foreach($Tg
as$Rg)$Z[]=trim($Rg);if(count($Ug)==1)$Ug=array();elseif(count($Ug)>1)$Z=array();return
where_to_query($Z,$Ug);}function
where_to_query($Pg=array(),$Qg=array()){global$b;$zb=array();foreach(array('and'=>$Pg,'or'=>$Qg)as$T=>$Z){if(is_array($Z)){foreach($Z
as$ic){list($ab,$ie,$X)=explode(" ",$ic,3);if($ab=="_id"&&preg_match('~^(MongoDB\\\\BSON\\\\ObjectID)\("(.+)"\)$~',$X,$_)){list(,$Xa,$X)=$_;$X=new$Xa($X);}if(!in_array($ie,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$ie,$_)){$X=(float)$X;$ie=$_[1];}elseif(preg_match('~^\(date\)(.+)~',$ie,$_)){$_b=new
DateTime($X);$Xa='MongoDB\BSON\UTCDatetime';$X=new$Xa($_b->getTimestamp()*1000);$ie=$_[1];}switch($ie){case'=':$ie='$eq';break;case'!=':$ie='$ne';break;case'>':$ie='$gt';break;case'<':$ie='$lt';break;case'>=':$ie='$gte';break;case'<=':$ie='$lte';break;case'regex':$ie='$regex';break;default:continue
2;}if($T=='and')$zb['$and'][]=array($ab=>array($ie=>$X));elseif($T=='or')$zb['$or'][]=array($ab=>array($ie=>$X));}}}return$zb;}$ke=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);}function
table($t){return$t;}function
idf_escape($t){return$t;}function
table_status($A="",$nc=false){$G=array();foreach(tables_list()as$Q=>$T){$G[$Q]=array("Name"=>$Q);if($A==$Q)return$G[$Q];}return$G;}function
create_database($l,$d){return
true;}function
last_id(){global$h;return$h->last_id;}function
error(){global$h;return
h($h->error);}function
collations(){return
array();}function
logged_user(){global$b;$vb=$b->credentials();return$vb[1];}function
connect(){global$b;$h=new
Min_DB;list($L,$V,$D)=$b->credentials();if($L=="")$L="localhost:27017";$B=array();if($V.$D!=""){$B["username"]=$V;$B["password"]=$D;}$l=$b->database();if($l!="")$B["db"]=$l;if(($Ca=getenv("MONGO_AUTH_SOURCE")))$B["authSource"]=$Ca;$h->connect("mongodb://$L",$B);if($h->error)return$h->error;return$h;}function
alter_indexes($Q,$c){global$h;foreach($c
as$X){list($T,$A,$M)=$X;if($M=="DROP")$G=$h->_db->command(array("deleteIndexes"=>$Q,"index"=>$A));else{$f=array();foreach($M
as$e){$e=preg_replace('~ DESC$~','',$e,1,$rb);$f[$e]=($rb?-1:1);}$G=$h->_db->selectCollection($Q)->ensureIndex($f,array("unique"=>($T=="UNIQUE"),"name"=>$A,));}if($G['errmsg']){$h->error=$G['errmsg'];return
false;}}return
true;}function
support($oc){return
preg_match("~database|indexes|descidx~",$oc);}function
db_collation($l,$bb){}function
information_schema(){}function
is_view($R){}function
convert_field($o){}function
unconvert_field($o,$G){return$G;}function
foreign_keys($Q){return
array();}function
fk_support($R){}function
engines(){return
array();}function
alter_table($Q,$A,$p,$zc,$gb,$Yb,$d,$Da,$_e){global$h;if($Q==""){$h->_db->createCollection($A);return
true;}}function
drop_tables($S){global$h;foreach($S
as$Q){$af=$h->_db->selectCollection($Q)->drop();if(!$af['ok'])return
false;}return
true;}function
truncate_tables($S){global$h;foreach($S
as$Q){$af=$h->_db->selectCollection($Q)->remove();if(!$af['ok'])return
false;}return
true;}function
driver_config(){global$ke;return
array('possible_drivers'=>array("mongo","mongodb"),'jush'=>"mongo",'operators'=>$ke,'functions'=>array(),'grouping'=>array(),'edit_functions'=>array(array("json")),);}}class
Adminer{var$operators=array("<=",">=");var$_values=array();function
name(){return"<a href='https://www.adminer.org/editor/'".target_blank()." id='h1'>".lang(32)."</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($tb=false){return
password_file($tb);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($L){}function
database(){global$h;if($h){$k=$this->databases(false);return(!$k?$h->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1)"):$k[(information_schema($k[0])?1:0)]);}}function
schemas(){return
schemas();}function
databases($xc=true){return
get_databases($xc);}function
queryTimeout(){return
5;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$G=array();$q="adminer.css";if(file_exists($q))$G[]=$q;return$G;}function
loginForm(){echo"<table class='layout'>\n",$this->loginFormField('username','<tr><th>'.lang(33).'<td>','<input type="hidden" name="auth[driver]" value="server"><input name="auth[username]" autofocus value="'.h($_GET["username"]).'" autocomplete="username" autocapitalize="off">'),$this->loginFormField('password','<tr><th>'.lang(34).'<td>','<input type="password" name="auth[password]" autocomplete="current-password">'."\n"),"</table>\n","<p><input type='submit' value='".lang(35)."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],lang(36))."\n";}function
loginFormField($A,$Sc,$Y){return$Sc.$Y;}function
login($Dd,$D){return
true;}function
tableName($Pf){return
h($Pf["Comment"]!=""?$Pf["Comment"]:$Pf["Name"]);}function
fieldName($o,$ne=0){return
h(preg_replace('~\s+\[.*\]$~','',($o["comment"]!=""?$o["comment"]:$o["field"])));}function
selectLinks($Pf,$M=""){$a=$Pf["Name"];if($M!==null)echo'<p class="tabs"><a href="'.h(ME.'edit='.urlencode($a).$M).'">'.lang(37)."</a>\n";}function
foreignKeys($Q){return
foreign_keys($Q);}function
backwardKeys($Q,$Of){$G=array();foreach(get_rows("SELECT TABLE_NAME, CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_COLUMN_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_NAME = ".q($Q)."
ORDER BY ORDINAL_POSITION",null,"")as$H)$G[$H["TABLE_NAME"]]["keys"][$H["CONSTRAINT_NAME"]][$H["COLUMN_NAME"]]=$H["REFERENCED_COLUMN_NAME"];foreach($G
as$x=>$X){$A=$this->tableName(table_status($x,true));if($A!=""){$kf=preg_quote($Of);$K="(:|\\s*-)?\\s+";$G[$x]["name"]=(preg_match("(^$kf$K(.+)|^(.+?)$K$kf\$)iu",$A,$_)?$_[2].$_[3]:$A);}else
unset($G[$x]);}return$G;}function
backwardKeysPrint($Ha,$H){foreach($Ha
as$Q=>$Ga){foreach($Ga["keys"]as$db){$z=ME.'select='.urlencode($Q);$s=0;foreach($db
as$e=>$X)$z.=where_link($s++,$e,$H[$X]);echo"<a href='".h($z)."'>".h($Ga["name"])."</a>";$z=ME.'edit='.urlencode($Q);foreach($db
as$e=>$X)$z.="&set".urlencode("[".bracket_escape($e)."]")."=".urlencode($H[$X]);echo"<a href='".h($z)."' title='".lang(37)."'>+</a> ";}}}function
selectQuery($E,$Hf,$mc=false){return"<!--\n".str_replace("--","--><!-- ",$E)."\n(".format_time($Hf).")\n-->\n";}function
rowDescription($Q){foreach(fields($Q)as$o){if(preg_match("~varchar|character varying~",$o["type"]))return
idf_escape($o["field"]);}return"";}function
rowDescriptions($I,$Ac){$G=$I;foreach($I[0]as$x=>$X){if(list($Q,$Wc,$A)=$this->_foreignColumn($Ac,$x)){$Yc=array();foreach($I
as$H)$Yc[$H[$x]]=q($H[$x]);$Fb=$this->_values[$Q];if(!$Fb)$Fb=get_key_vals("SELECT $Wc, $A FROM ".table($Q)." WHERE $Wc IN (".implode(", ",$Yc).")");foreach($I
as$Ud=>$H){if(isset($H[$x]))$G[$Ud][$x]=(string)$Fb[$H[$x]];}}}return$G;}function
selectLink($X,$o){}function
selectVal($X,$z,$o,$re){$G=$X;$z=h($z);if(preg_match('~blob|bytea~',$o["type"])&&!is_utf8($X)){$G=lang(38,strlen($re));if(preg_match("~^(GIF|\xFF\xD8\xFF|\x89PNG\x0D\x0A\x1A\x0A)~",$re))$G="<img src='$z' alt='$G'>";}if(like_bool($o)&&$G!="")$G=(preg_match('~^(1|t|true|y|yes|on)$~i',$X)?lang(39):lang(40));if($z)$G="<a href='$z'".(is_url($z)?target_blank():"").">$G</a>";if(!$z&&!like_bool($o)&&preg_match(number_type(),$o["type"]))$G="<div class='number'>$G</div>";elseif(preg_match('~date~',$o["type"]))$G="<div class='datetime'>$G</div>";return$G;}function
editVal($X,$o){if(preg_match('~date|timestamp~',$o["type"])&&$X!==null)return
preg_replace('~^(\d{2}(\d+))-(0?(\d+))-(0?(\d+))~',lang(41),$X);return$X;}function
selectColumnsPrint($J,$f){}function
selectSearchPrint($Z,$f,$v){$Z=(array)$_GET["where"];echo'<fieldset id="fieldset-search"><legend>'.lang(42)."</legend><div>\n";$qd=array();foreach($Z
as$x=>$X)$qd[$X["col"]]=$x;$s=0;$p=fields($_GET["select"]);foreach($f
as$A=>$Eb){$o=$p[$A];if(preg_match("~enum~",$o["type"])||like_bool($o)){$x=$qd[$A];$s--;echo"<div>".h($Eb)."<input type='hidden' name='where[$s][col]' value='".h($A)."'>:",(like_bool($o)?" <select name='where[$s][val]'>".optionlist(array(""=>"",lang(40),lang(39)),$Z[$x]["val"],true)."</select>":enum_input("checkbox"," name='where[$s][val][]'",$o,(array)$Z[$x]["val"],($o["null"]?0:null))),"</div>\n";unset($f[$A]);}elseif(is_array($B=$this->_foreignKeyOptions($_GET["select"],$A))){if($p[$A]["null"])$B[0]='('.lang(7).')';$x=$qd[$A];$s--;echo"<div>".h($Eb)."<input type='hidden' name='where[$s][col]' value='".h($A)."'><input type='hidden' name='where[$s][op]' value='='>: <select name='where[$s][val]'>".optionlist($B,$Z[$x]["val"],true)."</select></div>\n";unset($f[$A]);}}$s=0;foreach($Z
as$X){if(($X["col"]==""||$f[$X["col"]])&&"$X[col]$X[val]"!=""){echo"<div><select name='where[$s][col]'><option value=''>(".lang(43).")".optionlist($f,$X["col"],true)."</select>",html_select("where[$s][op]",array(-1=>"")+$this->operators,$X["op"]),"<input type='search' name='where[$s][val]' value='".h($X["val"])."'>".script("mixin(qsl('input'), {onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});","")."</div>\n";$s++;}}echo"<div><select name='where[$s][col]'><option value=''>(".lang(43).")".optionlist($f,null,true)."</select>",script("qsl('select').onchange = selectAddRow;",""),html_select("where[$s][op]",array(-1=>"")+$this->operators),"<input type='search' name='where[$s][val]'></div>",script("mixin(qsl('input'), {onchange: function () { this.parentNode.firstChild.onchange(); }, onsearch: selectSearchSearch});"),"</div></fieldset>\n";}function
selectOrderPrint($ne,$f,$v){$oe=array();foreach($v
as$x=>$u){$ne=array();foreach($u["columns"]as$X)$ne[]=$f[$X];if(count(array_filter($ne,'strlen'))>1&&$x!="PRIMARY")$oe[$x]=implode(", ",$ne);}if($oe){echo'<fieldset><legend>'.lang(44)."</legend><div>","<select name='index_order'>".optionlist(array(""=>"")+$oe,($_GET["order"][0]!=""?"":$_GET["index_order"]),true)."</select>","</div></fieldset>\n";}if($_GET["order"])echo"<div style='display: none;'>".hidden_fields(array("order"=>array(1=>reset($_GET["order"])),"desc"=>($_GET["desc"]?array(1=>1):array()),))."</div>\n";}function
selectLimitPrint($y){echo"<fieldset><legend>".lang(45)."</legend><div>";echo
html_select("limit",array("","50","100"),$y),"</div></fieldset>\n";}function
selectLengthPrint($Wf){}function
selectActionPrint($v){echo"<fieldset><legend>".lang(46)."</legend><div>","<input type='submit' value='".lang(47)."'>","</div></fieldset>\n";}function
selectCommandPrint(){return
true;}function
selectImportPrint(){return
true;}function
selectEmailPrint($Vb,$f){if($Vb){print_fieldset("email",lang(48),$_POST["email_append"]);echo"<div>",script("qsl('div').onkeydown = partialArg(bodyKeydown, 'email');"),"<p>".lang(49).": <input name='email_from' value='".h($_POST?$_POST["email_from"]:$_COOKIE["adminer_email"])."'>\n",lang(50).": <input name='email_subject' value='".h($_POST["email_subject"])."'>\n","<p><textarea name='email_message' rows='15' cols='75'>".h($_POST["email_message"].($_POST["email_append"]?'{$'."$_POST[email_addition]}":""))."</textarea>\n","<p>".script("qsl('p').onkeydown = partialArg(bodyKeydown, 'email_append');","").html_select("email_addition",$f,$_POST["email_addition"])."<input type='submit' name='email_append' value='".lang(12)."'>\n";echo"<p>".lang(51).": <input type='file' name='email_files[]'>".script("qsl('input').onchange = emailFileChange;"),"<p>".(count($Vb)==1?'<input type="hidden" name="email_field" value="'.h(key($Vb)).'">':html_select("email_field",$Vb)),"<input type='submit' name='email' value='".lang(52)."'>".confirm(),"</div>\n","</div></fieldset>\n";}}function
selectColumnsProcess($f,$v){return
array(array(),array());}function
selectSearchProcess($p,$v){global$m;$G=array();foreach((array)$_GET["where"]as$x=>$Z){$ab=$Z["col"];$ie=$Z["op"];$X=$Z["val"];if(($x>=0&&$ab!="")||$X!=""){$ib=array();foreach(($ab!=""?array($ab=>$p[$ab]):$p)as$A=>$o){if($ab!=""||is_numeric($X)||!preg_match(number_type(),$o["type"])){$A=idf_escape($A);if($ab!=""&&$o["type"]=="enum")$ib[]=(in_array(0,$X)?"$A IS NULL OR ":"")."$A IN (".implode(", ",array_map('intval',$X)).")";else{$Xf=preg_match('~char|text|enum|set~',$o["type"]);$Y=$this->processInput($o,(!$ie&&$Xf&&preg_match('~^[^%]+$~',$X)?"%$X%":$X));$ib[]=$m->convertSearch($A,$Z,$o).($Y=="NULL"?" IS".($ie==">="?" NOT":"")." $Y":(in_array($ie,$this->operators)||$ie=="="?" $ie $Y":($Xf?" LIKE $Y":" IN (".str_replace(",","', '",$Y).")")));if($x<0&&$X=="0")$ib[]="$A IS NULL";}}}$G[]=($ib?"(".implode(" OR ",$ib).")":"1 = 0");}}return$G;}function
selectOrderProcess($p,$v){$bd=$_GET["index_order"];if($bd!="")unset($_GET["order"][1]);if($_GET["order"])return
array(idf_escape(reset($_GET["order"])).($_GET["desc"]?" DESC":""));foreach(($bd!=""?array($v[$bd]):$v)as$u){if($bd!=""||$u["type"]=="INDEX"){$Nc=array_filter($u["descs"]);$Eb=false;foreach($u["columns"]as$X){if(preg_match('~date|timestamp~',$p[$X]["type"])){$Eb=true;break;}}$G=array();foreach($u["columns"]as$x=>$X)$G[]=idf_escape($X).(($Nc?$u["descs"][$x]:$Eb)?" DESC":"");return$G;}}return
array();}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return"100";}function
selectEmailProcess($Z,$Ac){if($_POST["email_append"])return
true;if($_POST["email"]){$of=0;if($_POST["all"]||$_POST["check"]){$o=idf_escape($_POST["email_field"]);$Lf=$_POST["email_subject"];$Od=$_POST["email_message"];preg_match_all('~\{\$([a-z0-9_]+)\}~i',"$Lf.$Od",$Id);$I=get_rows("SELECT DISTINCT $o".($Id[1]?", ".implode(", ",array_map('idf_escape',array_unique($Id[1]))):"")." FROM ".table($_GET["select"])." WHERE $o IS NOT NULL AND $o != ''".($Z?" AND ".implode(" AND ",$Z):"").($_POST["all"]?"":" AND ((".implode(") OR (",array_map('where_check',(array)$_POST["check"]))."))"));$p=fields($_GET["select"]);foreach($this->rowDescriptions($I,$Ac)as$H){$Ye=array('{\\'=>'{');foreach($Id[1]as$X)$Ye['{$'."$X}"]=$this->editVal($H[$X],$p[$X]);$Ub=$H[$_POST["email_field"]];if(is_mail($Ub)&&send_mail($Ub,strtr($Lf,$Ye),strtr($Od,$Ye),$_POST["email_from"],$_FILES["email_files"]))$of++;}}cookie("adminer_email",$_POST["email_from"]);redirect(remove_from_uri(),lang(53,$of));}return
false;}function
selectQueryBuild($J,$Z,$Ic,$ne,$y,$C){return"";}function
messageQuery($E,$Yf,$mc=false){return" <span class='time'>".@date("H:i:s")."</span><!--\n".str_replace("--","--><!-- ",$E)."\n".($Yf?"($Yf)\n":"")."-->";}function
editRowPrint($Q,$p,$H,$Ag){}function
editFunctions($o){$G=array();if($o["null"]&&preg_match('~blob~',$o["type"]))$G["NULL"]=lang(7);$G[""]=($o["null"]||$o["auto_increment"]||like_bool($o)?"":"*");if(preg_match('~date|time~',$o["type"]))$G["now"]=lang(54);if(preg_match('~_(md5|sha1)$~i',$o["field"],$_))$G[]=strtolower($_[1]);return$G;}function
editInput($Q,$o,$Aa,$Y){if($o["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$Aa value='-1' checked><i>".lang(8)."</i></label> ":"").enum_input("radio",$Aa,$o,($Y||isset($_GET["select"])?$Y:0),($o["null"]?"":null));$B=$this->_foreignKeyOptions($Q,$o["field"],$Y);if($B!==null)return(is_array($B)?"<select$Aa>".optionlist($B,$Y,true)."</select>":"<input value='".h($Y)."'$Aa class='hidden'>"."<input value='".h($B)."' class='jsonly'>"."<div></div>".script("qsl('input').oninput = partial(whisper, '".ME."script=complete&source=".urlencode($Q)."&field=".urlencode($o["field"])."&value=');
qsl('div').onclick = whisperClick;",""));if(like_bool($o))return'<input type="checkbox" value="1"'.(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?' checked':'')."$Aa>";$Tc="";if(preg_match('~time~',$o["type"]))$Tc=lang(55);if(preg_match('~date|timestamp~',$o["type"]))$Tc=lang(56).($Tc?" [$Tc]":"");if($Tc)return"<input value='".h($Y)."'$Aa> ($Tc)";if(preg_match('~_(md5|sha1)$~i',$o["field"]))return"<input type='password' value='".h($Y)."'$Aa>";return'';}function
editHint($Q,$o,$Y){return(preg_match('~\s+(\[.*\])$~',($o["comment"]!=""?$o["comment"]:$o["field"]),$_)?h(" $_[1]"):'');}function
processInput($o,$Y,$r=""){if($r=="now")return"$r()";$G=$Y;if(preg_match('~date|timestamp~',$o["type"])&&preg_match('(^'.str_replace('\$1','(?P<p1>\d*)',preg_replace('~(\\\\\\$([2-6]))~','(?P<p\2>\d{1,2})',preg_quote(lang(41)))).'(.*))',$Y,$_))$G=($_["p1"]!=""?$_["p1"]:($_["p2"]!=""?($_["p2"]<70?20:19).$_["p2"]:gmdate("Y")))."-$_[p3]$_[p4]-$_[p5]$_[p6]".end($_);$G=($o["type"]=="bit"&&preg_match('~^[0-9]+$~',$Y)?$G:q($G));if($Y==""&&like_bool($o))$G="'0'";elseif($Y==""&&($o["null"]||!preg_match('~char|text~',$o["type"])))$G="NULL";elseif(preg_match('~^(md5|sha1)$~',$r))$G="$r($G)";return
unconvert_field($o,$G);}function
dumpOutput(){return
array();}function
dumpFormat(){return
array('csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($l){}function
dumpTable($Q,$Kf,$md=0){echo"\xef\xbb\xbf";}function
dumpData($Q,$Kf,$E){global$h;$F=$h->query($E,1);if($F){while($H=$F->fetch_assoc()){if($Kf=="table"){dump_csv(array_keys($H));$Kf="INSERT";}dump_csv($H);}}}function
dumpFilename($Xc){return
friendly_url($Xc);}function
dumpHeaders($Xc,$Sd=false){$jc="csv";header("Content-Type: text/csv; charset=utf-8");return$jc;}function
importServerPath(){}function
homepage(){return
true;}function
navigation($Rd){global$ca;echo'<h1>
',$this->name(),'<span class="version">
',$ca,' <a href="https://www.adminer.org/editor/#download"',target_blank(),' id="version">',(version_compare($ca,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</span>
</h1>
';switch_lang();if($Rd=="auth"){$tc=true;foreach((array)$_SESSION["pwds"]as$Ig=>$uf){foreach($uf[""]as$V=>$D){if($D!==null){if($tc){echo"<ul id='logins'>",script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");$tc=false;}echo"<li><a href='".h(auth_url($Ig,"",$V))."'>".($V!=""?h($V):"<i>".lang(7)."</i>")."</a>\n";}}}}else{$this->databasesPrint($Rd);if($Rd!="db"&&$Rd!="ns"){$R=table_status('',true);if(!$R)echo"<p class='message'>".lang(10)."\n";else$this->tablesPrint($R);}}}function
databasesPrint($Rd){}function
tablesPrint($S){echo"<ul id='tables'>",script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($S
as$H){echo'<li>';$A=$this->tableName($H);if(isset($H["Engine"])&&$A!="")echo"<a href='".h(ME).'select='.urlencode($H["Name"])."'".bold($_GET["select"]==$H["Name"]||$_GET["edit"]==$H["Name"],"select")." title='".lang(57)."'>$A</a>\n";}echo"</ul>\n";}function
_foreignColumn($Ac,$e){foreach((array)$Ac[$e]as$_c){if(count($_c["source"])==1){$A=$this->rowDescription($_c["table"]);if($A!=""){$Wc=idf_escape($_c["target"][0]);return
array($_c["table"],$Wc,$A);}}}}function
_foreignKeyOptions($Q,$e,$Y=null){global$h;if(list($Sf,$Wc,$A)=$this->_foreignColumn(column_foreign_keys($Q),$e)){$G=&$this->_values[$Sf];if($G===null){$R=table_status($Sf);$G=($R["Rows"]>1000?"":array(""=>"")+get_key_vals("SELECT $Wc, $A FROM ".table($Sf)." ORDER BY 2"));}if(!$G&&$Y!==null)return$h->result("SELECT $A FROM ".table($Sf)." WHERE $Wc = ".q($Y));return$G;}}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);$Mb=array("server"=>"MySQL")+$Mb;if(!defined("DRIVER")){define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($L="",$V="",$D="",$j=null,$De=null,$_f=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($Uc,$De)=explode(":",$L,2);$N=$b->connectSsl();if($N)$this->ssl_set($N['key'],$N['cert'],$N['ca'],'','');$G=@$this->real_connect(($L!=""?$Uc:ini_get("mysqli.default_host")),($L.$V!=""?$V:ini_get("mysqli.default_user")),($L.$V.$D!=""?$D:ini_get("mysqli.default_pw")),$j,(is_numeric($De)?$De:ini_get("mysqli.default_port")),(!is_numeric($De)?$De:$_f),($N?(empty($N['cert'])?2048:64):0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$G;}function
set_charset($Ra){if(parent::set_charset($Ra))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $Ra");}function
result($E,$o=0){$F=$this->query($E);if(!$F)return
false;$H=$F->fetch_array();return$H[$o];}function
quote($P){return"'".$this->escape_string($P)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($L,$V,$D){if(ini_bool("mysql.allow_local_infile")){$this->error=lang(58,"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($L!=""?$L:ini_get("mysql.default_host")),("$L$V"!=""?$V:ini_get("mysql.default_user")),("$L$V$D"!=""?$D:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($Ra){if(function_exists('mysql_set_charset')){if(mysql_set_charset($Ra,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $Ra");}function
quote($P){return"'".mysql_real_escape_string($P,$this->_link)."'";}function
select_db($j){return
mysql_select_db($j,$this->_link);}function
query($E,$tg=false){$F=@($tg?mysql_unbuffered_query($E,$this->_link):mysql_query($E,$this->_link));$this->error="";if(!$F){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($F===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($F);}function
multi_query($E){return$this->_result=$this->query($E);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($E,$o=0){$F=$this->query($E);if(!$F||!$F->num_rows)return
false;return
mysql_result($F->_result,0,$o);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($F){$this->_result=$F;$this->num_rows=mysql_num_rows($F);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$G=mysql_fetch_field($this->_result,$this->_offset++);$G->orgtable=$G->table;$G->orgname=$G->name;$G->charsetnr=($G->blob?63:0);return$G;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($L,$V,$D){global$b;$B=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$N=$b->connectSsl();if($N){if(!empty($N['key']))$B[PDO::MYSQL_ATTR_SSL_KEY]=$N['key'];if(!empty($N['cert']))$B[PDO::MYSQL_ATTR_SSL_CERT]=$N['cert'];if(!empty($N['ca']))$B[PDO::MYSQL_ATTR_SSL_CA]=$N['ca'];if(!empty($N['verify']))$B[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT]=$N['verify'];}$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$L)),$V,$D,$B);return
true;}function
set_charset($Ra){$this->query("SET NAMES $Ra");}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($E,$tg=false){$this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,!$tg);return
parent::query($E,$tg);}}}class
Min_Driver
extends
Min_SQL{function
insert($Q,$M){return($M?parent::insert($Q,$M):queries("INSERT INTO ".table($Q)." ()\nVALUES ()"));}function
insertUpdate($Q,$I,$He){$f=array_keys(reset($I));$Ge="INSERT INTO ".table($Q)." (".implode(", ",$f).") VALUES\n";$Hg=array();foreach($f
as$x)$Hg[$x]="$x = VALUES($x)";$Mf="\nON DUPLICATE KEY UPDATE ".implode(", ",$Hg);$Hg=array();$zd=0;foreach($I
as$M){$Y="(".implode(", ",$M).")";if($Hg&&(strlen($Ge)+$zd+strlen($Y)+strlen($Mf)>1e6)){if(!queries($Ge.implode(",\n",$Hg).$Mf))return
false;$Hg=array();$zd=0;}$Hg[]=$Y;$zd+=strlen($Y)+2;}return
queries($Ge.implode(",\n",$Hg).$Mf);}function
slowQuery($E,$Zf){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$Zf FOR $E";elseif(preg_match('~^(SELECT\b)(.+)~is',$E,$_))return"$_[1] /*+ MAX_EXECUTION_TIME(".($Zf*1000).") */ $_[2]";}}function
convertSearch($t,$X,$o){return(preg_match('~char|text|enum|set~',$o["type"])&&!preg_match("~^utf8~",$o["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($t USING ".charset($this->_conn).")":$t);}function
warnings(){$F=$this->_conn->query("SHOW WARNINGS");if($F&&$F->num_rows){ob_start();select($F);return
ob_get_clean();}}function
tableHelp($A){$Fd=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower("information-schema-".($Fd?"$A-table/":str_replace("_","-",$A)."-table.html"));if(DB=="mysql")return($Fd?"mysql$A-table/":"system-schema.html");}function
hasCStyleEscapes(){static$Qa;if($Qa===null){$Ff=$this->_conn->result("SHOW VARIABLES LIKE 'sql_mode'",1);$Qa=(strpos($Ff,'NO_BACKSLASH_ESCAPES')===false);}return$Qa;}}function
idf_escape($t){return"`".str_replace("`","``",$t)."`";}function
table($t){return
idf_escape($t);}function
connect(){global$b,$U,$Jf,$Rb;$h=new
Min_DB;$vb=$b->credentials();if($h->connect($vb[0],$vb[1],$vb[2])){$h->set_charset(charset($h));$h->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$h)){$Jf[lang(26)][]="json";$U["json"]=4294967295;}if(min_version('',10.7,$h)){$Jf[lang(26)][]="uuid";$U["uuid"]=128;$Rb[0]['uuid']='uuid';}if(min_version(9,'',$h)){$Jf[lang(27)][]="vector";$U["vector"]=16383;$Rb[0]['vector']='string_to_vector';}return$h;}$G=$h->error;if(function_exists('iconv')&&!is_utf8($G)&&strlen($hf=iconv("windows-1250","utf-8",$G))>strlen($G))$G=$hf;return$G;}function
get_databases($xc){$G=get_session("dbs");if($G===null){$E=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$G=($xc?slow_query($E):get_vals($E));restart_session();set_session("dbs",$G);stop_session();}return$G;}function
limit($E,$Z,$y,$ce=0,$K=" "){return" $E$Z".($y!==null?$K."LIMIT $y".($ce?" OFFSET $ce":""):"");}function
limit1($Q,$E,$Z,$K="\n"){return
limit($E,$Z,1,0,$K);}function
db_collation($l,$bb){global$h;$G=null;$tb=$h->result("SHOW CREATE DATABASE ".idf_escape($l),1);if(preg_match('~ COLLATE ([^ ]+)~',$tb,$_))$G=$_[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$tb,$_))$G=$bb[$_[1]][-1];return$G;}function
engines(){$G=array();foreach(get_rows("SHOW ENGINES")as$H){if(preg_match("~YES|DEFAULT~",$H["Support"]))$G[]=$H["Engine"];}return$G;}function
logged_user(){global$h;return$h->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($k){$G=array();foreach($k
as$l)$G[$l]=count(get_vals("SHOW TABLES IN ".idf_escape($l)));return$G;}function
table_status($A="",$nc=false){$G=array();foreach(get_rows($nc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($A!=""?"AND TABLE_NAME = ".q($A):"ORDER BY Name"):"SHOW TABLE STATUS".($A!=""?" LIKE ".q(addcslashes($A,"%_\\")):""))as$H){if($H["Engine"]=="InnoDB")$H["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$H["Comment"]);if(!isset($H["Engine"]))$H["Comment"]="";if($A!=""){$H["Name"]=$A;return$H;}$G[$H["Name"]]=$H;}return$G;}function
is_view($R){return$R["Engine"]===null;}function
fk_support($R){return
preg_match('~InnoDB|IBMDB2I~i',$R["Engine"])||(preg_match('~NDB~i',$R["Engine"])&&min_version(5.6));}function
fields($Q){$G=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($Q))as$H){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$H["Type"],$_);$G[$H["Field"]]=array("field"=>$H["Field"],"full_type"=>$H["Type"],"type"=>$_[1],"length"=>$_[2],"unsigned"=>ltrim($_[3].$_[4]),"default"=>($H["Default"]!=""||preg_match("~char|set~",$_[1])?(preg_match('~text~',$_[1])?stripslashes(preg_replace("~^'(.*)'\$~",'\1',$H["Default"])):$H["Default"]):null),"null"=>($H["Null"]=="YES"),"auto_increment"=>($H["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$H["Extra"],$_)?$_[1]:""),"collation"=>$H["Collation"],"privileges"=>array_flip(preg_split('~, *~',$H["Privileges"])),"comment"=>$H["Comment"],"primary"=>($H["Key"]=="PRI"),"generated"=>preg_match('~^(VIRTUAL|PERSISTENT|STORED)~',$H["Extra"]),);}return$G;}function
indexes($Q,$i=null){$G=array();foreach(get_rows("SHOW INDEX FROM ".table($Q),$i)as$H){$A=$H["Key_name"];$G[$A]["type"]=($A=="PRIMARY"?"PRIMARY":($H["Index_type"]=="FULLTEXT"?"FULLTEXT":($H["Non_unique"]?($H["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$G[$A]["columns"][]=$H["Column_name"];$G[$A]["lengths"][]=($H["Index_type"]=="SPATIAL"?null:$H["Sub_part"]);$G[$A]["descs"][]=null;}return$G;}function
foreign_keys($Q){global$h,$fe;static$Ae='(?:`(?:[^`]|``)+`|"(?:[^"]|"")+")';$G=array();$ub=$h->result("SHOW CREATE TABLE ".table($Q),1);if($ub){preg_match_all("~CONSTRAINT ($Ae) FOREIGN KEY ?\\(((?:$Ae,? ?)+)\\) REFERENCES ($Ae)(?:\\.($Ae))? \\(((?:$Ae,? ?)+)\\)(?: ON DELETE ($fe))?(?: ON UPDATE ($fe))?~",$ub,$Id,PREG_SET_ORDER);foreach($Id
as$_){preg_match_all("~$Ae~",$_[2],$Bf);preg_match_all("~$Ae~",$_[5],$Sf);$G[idf_unescape($_[1])]=array("db"=>idf_unescape($_[4]!=""?$_[3]:$_[4]),"table"=>idf_unescape($_[4]!=""?$_[4]:$_[3]),"source"=>array_map('idf_unescape',$Bf[0]),"target"=>array_map('idf_unescape',$Sf[0]),"on_delete"=>($_[6]?$_[6]:"RESTRICT"),"on_update"=>($_[7]?$_[7]:"RESTRICT"),);}}return$G;}function
view($A){global$h;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$h->result("SHOW CREATE VIEW ".table($A),1)));}function
collations(){$G=array();foreach(get_rows("SHOW COLLATION")as$H){if($H["Default"])$G[$H["Charset"]][-1]=$H["Collation"];else$G[$H["Charset"]][]=$H["Collation"];}ksort($G);foreach($G
as$x=>$X)asort($G[$x]);return$G;}function
information_schema($l){return(min_version(5)&&$l=="information_schema")||(min_version(5.5)&&$l=="performance_schema");}function
error(){global$h;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$h->error));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" COLLATE ".q($d):""));}function
drop_databases($k){$G=apply_queries("DROP DATABASE",$k,'idf_escape');restart_session();set_session("dbs",null);return$G;}function
rename_database($A,$d){$G=false;if(create_database($A,$d)){$S=array();$Lg=array();foreach(tables_list()as$Q=>$T){if($T=='VIEW')$Lg[]=$Q;else$S[]=$Q;}$G=(!$S&&!$Lg)||move_tables($S,$Lg,$A);drop_databases($G?array(DB):array());}return$G;}function
auto_increment(){$Ea=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$u){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$u["columns"],true)){$Ea="";break;}if($u["type"]=="PRIMARY")$Ea=" UNIQUE";}}return" AUTO_INCREMENT$Ea";}function
alter_table($Q,$A,$p,$zc,$gb,$Yb,$d,$Da,$_e){$c=array();foreach($p
as$o)$c[]=($o[1]?($Q!=""?($o[0]!=""?"CHANGE ".idf_escape($o[0]):"ADD"):" ")." ".implode($o[1]).($Q!=""?$o[2]:""):"DROP ".idf_escape($o[0]));$c=array_merge($c,$zc);$O=($gb!==null?" COMMENT=".q($gb):"").($Yb?" ENGINE=".q($Yb):"").($d?" COLLATE ".q($d):"").($Da!=""?" AUTO_INCREMENT=$Da":"");if($Q=="")return
queries("CREATE TABLE ".table($A)." (\n".implode(",\n",$c)."\n)$O$_e");if($Q!=$A)$c[]="RENAME TO ".table($A);if($O)$c[]=ltrim($O);return($c||$_e?queries("ALTER TABLE ".table($Q)."\n".implode(",\n",$c).$_e):true);}function
alter_indexes($Q,$c){foreach($c
as$x=>$X)$c[$x]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($Q).implode(",",$c));}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Lg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Lg)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$Lg,$Sf){global$h;$Xe=array();foreach($S
as$Q)$Xe[]=table($Q)." TO ".idf_escape($Sf).".".table($Q);if(!$Xe||queries("RENAME TABLE ".implode(", ",$Xe))){$Db=array();foreach($Lg
as$Q)$Db[table($Q)]=view($Q);$h->select_db($Sf);$l=idf_escape(DB);foreach($Db
as$A=>$Kg){if(!queries("CREATE VIEW $A AS ".str_replace(" $l."," ",$Kg["select"]))||!queries("DROP VIEW $l.$A"))return
false;}return
true;}return
false;}function
copy_tables($S,$Lg,$Sf){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($S
as$Q){$A=($Sf==DB?table("copy_$Q"):idf_escape($Sf).".".table($Q));if(($_POST["overwrite"]&&!queries("\nDROP TABLE IF EXISTS $A"))||!queries("CREATE TABLE $A LIKE ".table($Q))||!queries("INSERT INTO $A SELECT * FROM ".table($Q)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$H){$og=$H["Trigger"];if(!queries("CREATE TRIGGER ".($Sf==DB?idf_escape("copy_$og"):idf_escape($Sf).".".idf_escape($og))." $H[Timing] $H[Event] ON $A FOR EACH ROW\n$H[Statement];"))return
false;}}foreach($Lg
as$Q){$A=($Sf==DB?table("copy_$Q"):idf_escape($Sf).".".table($Q));$Kg=view($Q);if(($_POST["overwrite"]&&!queries("DROP VIEW IF EXISTS $A"))||!queries("CREATE VIEW $A AS $Kg[select]"))return
false;}return
true;}function
trigger($A){if($A=="")return
array();$I=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($A));return
reset($I);}function
triggers($Q){$G=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$H)$G[$H["Trigger"]]=array($H["Timing"],$H["Event"]);return$G;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($A,$T){global$h,$Zb,$gd,$U;$va=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$Cf="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$sg="((".implode("|",array_merge(array_keys($U),$va)).")\\b(?:\\s*\\(((?:[^'\")]|$Zb)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$Ae="$Cf*(".($T=="FUNCTION"?"":$gd).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$sg";$tb=$h->result("SHOW CREATE $T ".idf_escape($A),2);preg_match("~\\(((?:$Ae\\s*,?)*)\\)\\s*".($T=="FUNCTION"?"RETURNS\\s+$sg\\s+":"")."(.*)~is",$tb,$_);$p=array();preg_match_all("~$Ae\\s*,?~is",$_[1],$Id,PREG_SET_ORDER);foreach($Id
as$xe)$p[]=array("field"=>str_replace("``","`",$xe[2]).$xe[3],"type"=>strtolower($xe[5]),"length"=>preg_replace_callback("~$Zb~s",'normalize_enum',$xe[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$xe[8] $xe[7]"))),"null"=>1,"full_type"=>$xe[4],"inout"=>strtoupper($xe[1]),"collation"=>strtolower($xe[9]),);return
array("fields"=>$p,"comment"=>$h->result("SELECT ROUTINE_COMMENT FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB)." AND ROUTINE_NAME = ".q($A)),)+($T!="FUNCTION"?array("definition"=>$_[11]):array("returns"=>array("type"=>$_[12],"length"=>$_[13],"unsigned"=>$_[15],"collation"=>$_[16]),"definition"=>$_[17],"language"=>"SQL",));}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($A,$H){return
idf_escape($A);}function
last_id(){global$h;return$h->result("SELECT LAST_INSERT_ID()");}function
explain($h,$E){return$h->query("EXPLAIN ".(min_version(5.1)&&!min_version(5.7)?"PARTITIONS ":"").$E);}function
found_rows($R,$Z){return($Z||$R["Engine"]!="InnoDB"?null:$R["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($if,$i=null){return
true;}function
create_sql($Q,$Da,$Kf){global$h;$G=$h->result("SHOW CREATE TABLE ".table($Q),1);if(!$Da)$G=preg_replace('~ AUTO_INCREMENT=\d+~','',$G);return$G;}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
use_sql($j){return"USE ".idf_escape($j);}function
trigger_sql($Q){$G="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")),null,"-- ")as$H)$G.="\nCREATE TRIGGER ".idf_escape($H["Trigger"])." $H[Timing] $H[Event] ON ".table($H["Table"])." FOR EACH ROW\n$H[Statement];;\n";return$G;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($o){if(preg_match("~binary~",$o["type"]))return"HEX(".idf_escape($o["field"]).")";if($o["type"]=="bit")return"BIN(".idf_escape($o["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$o["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($o["field"]).")";}function
unconvert_field($o,$G){if(preg_match("~binary~",$o["type"]))$G="UNHEX($G)";if($o["type"]=="bit")$G="CONVERT(b$G, UNSIGNED)";if(preg_match("~geometry|point|linestring|polygon~",$o["type"])){$Ge=(min_version(8)?"ST_":"");$G=$Ge."GeomFromText($G, $Ge"."SRID($o[field]))";}return$G;}function
support($oc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(8)?"":"|descidx".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view"))).(min_version('8.0.16','10.2.1')?"":"|check")."~",$oc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$h;return$h->result("SELECT @@max_connections");}function
driver_config(){$U=array();$Jf=array();foreach(array(lang(27)=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),lang(28)=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),lang(26)=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),lang(59)=>array("enum"=>65535,"set"=>64),lang(29)=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),lang(31)=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$x=>$X){$U+=$X;$Jf[$x]=array_keys($X);}return
array('possible_drivers'=>array("MySQLi","MySQL","PDO_MySQL"),'jush'=>"sql",'types'=>$U,'structured_types'=>$Jf,'unsigned'=>array("unsigned","zerofill","unsigned zerofill"),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL"),'functions'=>array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper"),'grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",)),);}}$jb=driver_config();$Fe=$jb['possible_drivers'];$w=$jb['jush'];$U=$jb['types'];$Jf=$jb['structured_types'];$_g=$jb['unsigned'];$ke=$jb['operators'];$Hc=$jb['functions'];$Lc=$jb['grouping'];$Rb=$jb['edit_functions'];if($b->operators===null)$b->operators=$ke;define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~\?.*~','',relative_uri()).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));function
page_header($bg,$n="",$Oa=array(),$cg=""){global$ba,$ca,$b,$Mb,$w;page_headers();if(is_ajax()&&$n){page_messages($n);exit;}$dg=$bg.($cg!=""?": $cg":"");$eg=strip_tags($dg.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="',$ba,'" dir="',lang(60),'">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width">
<title>',$eg,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.17.1"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.17.1");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.17.1"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.17.1"),'">
';foreach($b->css()as$xb){echo'<link rel="stylesheet" type="text/css" href="',h($xb),'">
';}}echo'
<body class="',lang(60),' nojs">
';$q=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($q)&&filemtime($q)+86400>time()){$Jg=unserialize(file_get_contents($q));$Me="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($Jg["version"],base64_decode($Jg["signature"]),$Me)==1)$_COOKIE["adminer_version"]=$Jg["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ca', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape(lang(61)),'\';
var thousandsSeparator = \'',js_escape(lang(5)),'\';
</script>

<div id="help" class="jush-',$w,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Oa!==null){$z=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($z?$z:".").'">'.$Mb[DRIVER].'</a> Â» ';$z=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$L=$b->serverName(SERVER);$L=($L!=""?$L:lang(62));if($Oa===false)echo"$L\n";else{echo"<a href='".h($z)."' accesskey='1' title='Alt+Shift+1'>$L</a> Â» ";if($_GET["ns"]!=""||(DB!=""&&is_array($Oa)))echo'<a href="'.h($z."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> Â» ';if(is_array($Oa)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> Â» ';foreach($Oa
as$x=>$X){$Eb=(is_array($X)?$X[1]:h($X));if($Eb!="")echo"<a href='".h(ME."$x=").urlencode(is_array($X)?$X[0]:$X)."'>$Eb</a> Â» ";}}echo"$bg\n";}}echo"<h2>$dg</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($n);$k=&get_session("dbs");if(DB!=""&&$k&&!in_array(DB,$k,true))$k=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$wb){$Qc=array();foreach($wb
as$x=>$X)$Qc[]="$x $X";header("Content-Security-Policy: ".implode("; ",$Qc));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$Yd;if(!$Yd)$Yd=base64_encode(rand_string());return$Yd;}function
page_messages($n){$Bg=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Pd=$_SESSION["messages"][$Bg];if($Pd){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Pd)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Bg]);}if($n)echo"<div class='error'>$n</div>\n";}function
page_footer($Rd=""){global$b,$hg;echo'</div>

<div id="menu">
';$b->navigation($Rd);echo'</div>

';if($Rd!="auth"){echo'<form action="" method="post">
<p class="logout">
',h($_GET["username"])."\n",'<input type="submit" name="logout" value="',lang(63),'" id="logout">
<input type="hidden" name="token" value="',$hg,'">
</p>
</form>
';}echo
script("setupSubmitHighlight(document);");}function
int32($Ud){while($Ud>=2147483648)$Ud-=4294967296;while($Ud<=-2147483649)$Ud+=4294967296;return(int)$Ud;}function
long2str($W,$Ng){$hf='';foreach($W
as$X)$hf.=pack('V',$X);if($Ng)return
substr($hf,0,end($W));return$hf;}function
str2long($hf,$Ng){$W=array_values(unpack('V*',str_pad($hf,4*ceil(strlen($hf)/4),"\0")));if($Ng)$W[]=strlen($hf);return$W;}function
xxtea_mx($Xg,$Wg,$Nf,$od){return
int32((($Xg>>5&0x7FFFFFF)^$Wg<<2)+(($Wg>>3&0x1FFFFFFF)^$Xg<<4))^int32(($Nf^$Wg)+($od^$Xg));}function
encrypt_string($If,$x){if($If=="")return"";$x=array_values(unpack("V*",pack("H*",md5($x))));$W=str2long($If,true);$Ud=count($W)-1;$Xg=$W[$Ud];$Wg=$W[0];$Ne=floor(6+52/($Ud+1));$Nf=0;while($Ne-->0){$Nf=int32($Nf+0x9E3779B9);$Qb=$Nf>>2&3;for($ve=0;$ve<$Ud;$ve++){$Wg=$W[$ve+1];$Td=xxtea_mx($Xg,$Wg,$Nf,$x[$ve&3^$Qb]);$Xg=int32($W[$ve]+$Td);$W[$ve]=$Xg;}$Wg=$W[0];$Td=xxtea_mx($Xg,$Wg,$Nf,$x[$ve&3^$Qb]);$Xg=int32($W[$Ud]+$Td);$W[$Ud]=$Xg;}return
long2str($W,false);}function
decrypt_string($If,$x){if($If=="")return"";if(!$x)return
false;$x=array_values(unpack("V*",pack("H*",md5($x))));$W=str2long($If,false);$Ud=count($W)-1;$Xg=$W[$Ud];$Wg=$W[0];$Ne=floor(6+52/($Ud+1));$Nf=int32($Ne*0x9E3779B9);while($Nf){$Qb=$Nf>>2&3;for($ve=$Ud;$ve>0;$ve--){$Xg=$W[$ve-1];$Td=xxtea_mx($Xg,$Wg,$Nf,$x[$ve&3^$Qb]);$Wg=int32($W[$ve]-$Td);$W[$ve]=$Wg;}$Xg=$W[$Ud];$Td=xxtea_mx($Xg,$Wg,$Nf,$x[$ve&3^$Qb]);$Wg=int32($W[0]-$Td);$W[0]=$Wg;$Nf=int32($Nf-0x9E3779B9);}return
long2str($W,true);}$h='';$Pc=$_SESSION["token"];if(!$Pc)$_SESSION["token"]=rand(1,1e6);$hg=get_token();$Ce=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($x)=explode(":",$X);$Ce[$x]=$X;}}function
add_invalid_login(){global$b;$Fc=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$Fc)return;$jd=unserialize(stream_get_contents($Fc));$Yf=time();if($jd){foreach($jd
as$kd=>$X){if($X[0]<$Yf)unset($jd[$kd]);}}$id=&$jd[$b->bruteForceKey()];if(!$id)$id=array($Yf+30*60,0);$id[1]++;file_write_unlock($Fc,serialize($jd));}function
check_invalid_login(){global$b;$jd=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$id=($jd?$jd[$b->bruteForceKey()]:array());$Xd=($id[1]>29?$id[0]-time():0);if($Xd>0)auth_error(lang(64,ceil($Xd/60)));}$Ba=$_POST["auth"];if($Ba){session_regenerate_id();$Ig=$Ba["driver"];$L=$Ba["server"];$V=$Ba["username"];$D=(string)$Ba["password"];$l=$Ba["db"];set_password($Ig,$L,$V,$D);$_SESSION["db"][$Ig][$L][$V][$l]=true;if($Ba["permanent"]){$x=base64_encode($Ig)."-".base64_encode($L)."-".base64_encode($V)."-".base64_encode($l);$Ke=$b->permanentLogin(true);$Ce[$x]="$x:".base64_encode($Ke?encrypt_string($D,$Ke):"");cookie("adminer_permanent",implode(" ",$Ce));}if(count($_POST)==1||DRIVER!=$Ig||SERVER!=$L||$_GET["username"]!==$V||DB!=$l)redirect(auth_url($Ig,$L,$V,$l));}elseif($_POST["logout"]&&(!$Pc||verify_token())){foreach(array("pwds","db","dbs","queries")as$x)set_session($x,null);unset_permanent();redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),lang(65).' '.lang(66));}elseif($Ce&&!$_SESSION["pwds"]){session_regenerate_id();$Ke=$b->permanentLogin();foreach($Ce
as$x=>$X){list(,$Wa)=explode(":",$X);list($Ig,$L,$V,$l)=array_map('base64_decode',explode("-",$x));set_password($Ig,$L,$V,decrypt_string(base64_decode($Wa),$Ke));$_SESSION["db"][$Ig][$L][$V][$l]=true;}}function
unset_permanent(){global$Ce;foreach($Ce
as$x=>$X){list($Ig,$L,$V,$l)=array_map('base64_decode',explode("-",$x));if($Ig==DRIVER&&$L==SERVER&&$V==$_GET["username"]&&$l==DB)unset($Ce[$x]);}cookie("adminer_permanent",implode(" ",$Ce));}function
auth_error($n){global$b,$Pc;$vf=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$vf]||$_GET[$vf])&&!$Pc)$n=lang(67);else{restart_session();add_invalid_login();$D=get_password();if($D!==null){if($D===false)$n.=($n?'<br>':'').lang(68,target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$vf]&&$_GET[$vf]&&ini_bool("session.use_only_cookies"))$n=lang(69);$ye=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$ye["lifetime"]);page_header(lang(35),$n,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".lang(70)."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header(lang(71),lang(72,implode(", ",$Fe)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])&&is_string(get_password())){list($Uc,$De)=explode(":",SERVER,2);if(preg_match('~^\s*([-+]?\d+)~',$De,$_)&&($_[1]<1024||$_[1]>65535))auth_error(lang(73));check_invalid_login();$h=connect();$m=new
Min_Driver($h);}$Dd=null;if(!is_object($h)||($Dd=$b->login($_GET["username"],get_password()))!==true){$n=(is_string($h)?nl_br(h($h)):(is_string($Dd)?$Dd:lang(74)));auth_error($n.(preg_match('~^ | $~',get_password())?'<br>'.lang(75):''));}if($_POST["logout"]&&$Pc&&!verify_token()){page_header(lang(63),lang(76));page_footer("db");exit;}if($Ba&&$_POST["token"])$_POST["token"]=$hg;$n='';if($_POST){if(!verify_token()){$fd="max_input_vars";$Md=ini_get($fd);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$x){$X=ini_get($x);if($X&&(!$Md||$X<$Md)){$fd=$x;$Md=$X;}}}$n=(!$_POST["token"]&&$Md?lang(77,"'$fd'"):lang(76).' '.lang(78));}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$n=lang(79,"'post_max_size'");if(isset($_GET["sql"]))$n.=' '.lang(80);}function
email_header($Qc){return"=?UTF-8?B?".base64_encode($Qc)."?=";}function
send_mail($Ub,$Lf,$Od,$Gc="",$rc=array()){$bc=(DIRECTORY_SEPARATOR=="/"?"\n":"\r\n");$Od=str_replace("\n",$bc,wordwrap(str_replace("\r","","$Od\n")));$Na=uniqid("boundary");$_a="";foreach((array)$rc["error"]as$x=>$X){if(!$X)$_a.="--$Na$bc"."Content-Type: ".str_replace("\n","",$rc["type"][$x]).$bc."Content-Disposition: attachment; filename=\"".preg_replace('~["\n]~','',$rc["name"][$x])."\"$bc"."Content-Transfer-Encoding: base64$bc$bc".chunk_split(base64_encode(file_get_contents($rc["tmp_name"][$x])),76,$bc).$bc;}$Ja="";$Rc="Content-Type: text/plain; charset=utf-8$bc"."Content-Transfer-Encoding: 8bit";if($_a){$_a.="--$Na--$bc";$Ja="--$Na$bc$Rc$bc$bc";$Rc="Content-Type: multipart/mixed; boundary=\"$Na\"";}$Rc.=$bc."MIME-Version: 1.0$bc"."X-Mailer: Adminer Editor".($Gc?$bc."From: ".str_replace("\n","",$Gc):"");return
mail($Ub,email_header($Lf),$Ja.$Od.$_a,$Rc);}function
like_bool($o){return
preg_match("~bool|(tinyint|bit)\\(1\\)~",$o["full_type"]);}$h->select_db($b->database());$fe="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";$Mb[DRIVER]=lang(35);if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["download"])){$a=$_GET["download"];$p=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$J=array(idf_escape($_GET["field"]));$F=$m->select($a,$J,array(where($_GET,$p)),$J);$H=($F?$F->fetch_row():array());echo$m->value($H[0],$p[$_GET["field"]]);exit;}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$p=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$p):""):where($_GET,$p));$Ag=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($p
as$A=>$o){if(!isset($o["privileges"][$Ag?"update":"insert"])||$b->fieldName($o)==""||$o["generated"])unset($p[$A]);}if($_POST&&!$n&&!isset($_GET["select"])){$Cd=$_POST["referer"];if($_POST["insert"])$Cd=($Ag?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$Cd))$Cd=ME."select=".urlencode($a);$v=indexes($a);$wg=unique_array($_GET["where"],$v);$Qe="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($Cd,lang(81),$m->delete($a,$Qe,!$wg));else{$M=array();foreach($p
as$A=>$o){$X=process_input($o);if($X!==false&&$X!==null)$M[idf_escape($A)]=$X;}if($Ag){if(!$M)redirect($Cd);queries_redirect($Cd,lang(82),$m->update($a,$M,$Qe,!$wg));if(is_ajax()){page_headers();page_messages($n);exit;}}else{$F=$m->insert($a,$M);$xd=($F?last_id():0);queries_redirect($Cd,lang(83,($xd?" $xd":"")),$F);}}}$H=null;if($_POST["save"])$H=(array)$_POST["fields"];elseif($Z){$J=array();foreach($p
as$A=>$o){if(isset($o["privileges"]["select"])){$ya=convert_field($o);if($_POST["clone"]&&$o["auto_increment"])$ya="''";if($w=="sql"&&preg_match("~enum|set~",$o["type"]))$ya="1*".idf_escape($A);$J[]=($ya?"$ya AS ":"").idf_escape($A);}}$H=array();if(!support("table"))$J=array("*");if($J){$F=$m->select($a,$J,array($Z),$J,array(),(isset($_GET["select"])?2:1));if(!$F)$n=error();else{$H=$F->fetch_assoc();if(!$H)$H=false;}if(isset($_GET["select"])&&(!$H||$F->fetch_assoc()))$H=null;}}if(!support("table")&&!$p){if(!$Z){$F=$m->select($a,array("*"),$Z,array("*"));$H=($F?$F->fetch_assoc():false);if(!$H)$H=array($m->primary=>"");}if($H){foreach($H
as$x=>$X){if(!$Z)$H[$x]=null;$p[$x]=array("field"=>$x,"null"=>($x!=$m->primary),"auto_increment"=>($x==$m->primary));}}}edit_form($a,$p,$H,$Ag);}elseif(isset($_GET["select"])){$a=$_GET["select"];$R=table_status1($a);$v=indexes($a);$p=fields($a);$Cc=column_foreign_keys($a);$de=$R["Oid"];parse_str($_COOKIE["adminer_import"],$sa);$ff=array();$f=array();$Wf=null;foreach($p
as$x=>$o){$A=$b->fieldName($o);if(isset($o["privileges"]["select"])&&$A!=""){$f[$x]=html_entity_decode(strip_tags($A),ENT_QUOTES);if(is_shortable($o))$Wf=$b->selectLengthProcess();}$ff+=$o["privileges"];}list($J,$Ic)=$b->selectColumnsProcess($f,$v);$ld=count($Ic)<count($J);$Z=$b->selectSearchProcess($p,$v);$ne=$b->selectOrderProcess($p,$v);$y=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$xg=>$H){$ya=convert_field($p[key($H)]);$J=array($ya?$ya:idf_escape(key($H)));$Z[]=where_check($xg,$p);$G=$m->select($a,$J,$Z,$J);if($G)echo
reset($G->fetch_row());}exit;}$He=$zg=null;foreach($v
as$u){if($u["type"]=="PRIMARY"){$He=array_flip($u["columns"]);$zg=($J?$He:array());foreach($zg
as$x=>$X){if(in_array(idf_escape($x),$J))unset($zg[$x]);}break;}}if($de&&!$He){$He=$zg=array($de=>0);$v[]=array("type"=>"PRIMARY","columns"=>array($de));}if($_POST&&!$n){$Sg=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$Va=array();foreach($_POST["check"]as$Sa)$Va[]=where_check($Sa,$p);$Sg[]="((".implode(") OR (",$Va)."))";}$Sg=($Sg?"\nWHERE ".implode(" AND ",$Sg):"");if($_POST["export"]){cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$Gc=($J?implode(", ",$J):"*").convert_fields($f,$p,$J)."\nFROM ".table($a);$Kc=($Ic&&$ld?"\nGROUP BY ".implode(", ",$Ic):"").($ne?"\nORDER BY ".implode(", ",$ne):"");if(!is_array($_POST["check"])||$He)$E="SELECT $Gc$Sg$Kc";else{$vg=array();foreach($_POST["check"]as$X)$vg[]="(SELECT".limit($Gc,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p).$Kc,1).")";$E=implode(" UNION ALL ",$vg);}$b->dumpData($a,"table",$E);exit;}if(!$b->selectEmailProcess($Z,$Cc)){if($_POST["save"]||$_POST["delete"]){$F=true;$ta=0;$M=array();if(!$_POST["delete"]){foreach($f
as$A=>$X){$X=process_input($p[$A]);if($X!==null&&($_POST["clone"]||$X!==false))$M[idf_escape($A)]=($X!==false?$X:idf_escape($A));}}if($_POST["delete"]||$M){if($_POST["clone"])$E="INTO ".table($a)." (".implode(", ",array_keys($M)).")\nSELECT ".implode(", ",$M)."\nFROM ".table($a);if($_POST["all"]||($He&&is_array($_POST["check"]))||$ld){$F=($_POST["delete"]?$m->delete($a,$Sg):($_POST["clone"]?queries("INSERT $E$Sg"):$m->update($a,$M,$Sg)));$ta=$h->affected_rows;}else{foreach((array)$_POST["check"]as$X){$Og="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p);$F=($_POST["delete"]?$m->delete($a,$Og,1):($_POST["clone"]?queries("INSERT".limit1($a,$E,$Og)):$m->update($a,$M,$Og,1)));if(!$F)break;$ta+=$h->affected_rows;}}}$Od=lang(84,$ta);if($_POST["clone"]&&$F&&$ta==1){$xd=last_id();if($xd)$Od=lang(83," $xd");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Od,$F);if(!$_POST["delete"]){edit_form($a,$p,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$n=lang(85);else{$F=true;$ta=0;foreach($_POST["val"]as$xg=>$H){$M=array();foreach($H
as$x=>$X){$x=bracket_escape($x,1);$M[idf_escape($x)]=(preg_match('~char|text~',$p[$x]["type"])||$X!=""?$b->processInput($p[$x],$X):"NULL");}$F=$m->update($a,$M," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($xg,$p),!$ld&&!$He," ");if(!$F)break;$ta+=$h->affected_rows;}queries_redirect(remove_from_uri(),lang(84,$ta),$F);}}elseif(!is_string($qc=get_file("csv_file",true)))$n=upload_error($qc);elseif(!preg_match('~~u',$qc))$n=lang(86);else{cookie("adminer_import","output=".urlencode($sa["output"])."&format=".urlencode($_POST["separator"]));$F=true;$db=array_keys($p);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$qc,$Id);$ta=count($Id[0]);$m->begin();$K=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$I=array();foreach($Id[0]as$x=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$K]*)$K~",$X.$K,$Jd);if(!$x&&!array_diff($Jd[1],$db)){$db=$Jd[1];$ta--;}else{$M=array();foreach($Jd[1]as$s=>$ab)$M[idf_escape($db[$s])]=($ab==""&&$p[$db[$s]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$ab))));$I[]=$M;}}$F=(!$I||$m->insertUpdate($a,$I,$He));if($F)$F=$m->commit();queries_redirect(remove_from_uri("page"),lang(87,$ta),$F);$m->rollback();}}}$Qf=$b->tableName($R);if(is_ajax()){page_headers();ob_start();}else
page_header(lang(47).": $Qf",$n);$M=null;if(isset($ff["insert"])||!support("table")){$ye=array();foreach((array)$_GET["where"]as$X){if(isset($Cc[$X["col"]])&&count($Cc[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&(is_array($X["val"])||!preg_match('~[_%]~',$X["val"])))))$ye["set"."[".bracket_escape($X["col"])."]"]=$X["val"];}$M=$ye?"&".http_build_query($ye):"";}$b->selectLinks($R,$M);if(!$f&&support("table"))echo"<p class='error'>".lang(88).($p?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">',"</div>\n";$b->selectColumnsPrint($J,$f);$b->selectSearchPrint($Z,$f,$v);$b->selectOrderPrint($ne,$f,$v);$b->selectLimitPrint($y);$b->selectLengthPrint($Wf);$b->selectActionPrint($v);echo"</form>\n";$C=$_GET["page"];if($C=="last"){$Ec=$h->result(count_rows($a,$Z,$ld,$Ic));$C=floor(max(0,$Ec-1)/$y);}$lf=$J;$Jc=$Ic;if(!$lf){$lf[]="*";$qb=convert_fields($f,$p,$J);if($qb)$lf[]=substr($qb,2);}foreach($J
as$x=>$X){$o=$p[idf_unescape($X)];if($o&&($ya=convert_field($o)))$lf[$x]="$ya AS $X";}if(!$ld&&$zg){foreach($zg
as$x=>$X){$lf[]=idf_escape($x);if($Jc)$Jc[]=idf_escape($x);}}$F=$m->select($a,$lf,$Z,$Jc,$ne,$y,$C,true);if(!$F)echo"<p class='error'>".error()."\n";else{if($w=="mssql"&&$C)$F->seek($y*$C);$Wb=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$I=array();while($H=$F->fetch_assoc()){if($C&&$w=="oracle")unset($H["RNUM"]);$I[]=$H;}if($_GET["page"]!="last"&&$y!=""&&$Ic&&$ld&&$w=="sql")$Ec=$h->result(" SELECT FOUND_ROWS()");if(!$I)echo"<p class='message'>".lang(13)."\n";else{$Ia=$b->backwardKeys($a,$Qf);echo"<div class='scrollable'>","<table id='table' class='nowrap checkable odds'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$Ic&&$J?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".lang(89)."</a>");$Vd=array();$Hc=array();reset($J);$Se=1;foreach($I[0]as$x=>$X){if(!isset($zg[$x])){$X=$_GET["columns"][key($J)];$o=$p[$J?($X?$X["col"]:current($J)):$x];$A=($o?$b->fieldName($o,$Se):($X["fun"]?"*":h($x)));if($A!=""){$Se++;$Vd[$x]=$A;$e=idf_escape($x);$Vc=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($x);$Eb="&desc%5B0%5D=1";echo"<th id='th[".h(bracket_escape($x))."]'>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Vc.($ne[0]==$e||$ne[0]==$x||(!$ne&&$ld&&$Ic[0]==$e)?$Eb:'')).'">';echo
apply_sql_function($X["fun"],$A)."</a>";echo"<span class='column hidden'>","<a href='".h($Vc.$Eb)."' title='".lang(90)."' class='text'> â†“</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.lang(42).'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($x)."');");}echo"</span>";}$Hc[$x]=$X["fun"];next($J);}}$_d=array();if($_GET["modify"]){foreach($I
as$H){foreach($H
as$x=>$X)$_d[$x]=max($_d[$x],min(40,strlen(utf8_decode($X))));}}echo($Ia?"<th>".lang(91):"")."</thead>\n";if(is_ajax())ob_end_clean();foreach($b->rowDescriptions($I,$Cc)as$Ud=>$H){$wg=unique_array($I[$Ud],$v);if(!$wg){$wg=array();foreach($I[$Ud]as$x=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$x))$wg[$x]=$X;}}$xg="";foreach($wg
as$x=>$X){if(($w=="sql"||$w=="pgsql")&&preg_match('~char|text|enum|set~',$p[$x]["type"])&&strlen($X)>64){$x=(strpos($x,'(')?$x:idf_escape($x));$x="MD5(".($w!='sql'||preg_match("~^utf8~",$p[$x]["collation"])?$x:"CONVERT($x USING ".charset($h).")").")";$X=md5($X);}$xg.="&".($X!==null?urlencode("where[".bracket_escape($x)."]")."=".urlencode($X===false?"f":$X):"null%5B%5D=".urlencode($x));}echo"<tr>".(!$Ic&&$J?"":"<td>".checkbox("check[]",substr($xg,1),in_array(substr($xg,1),(array)$_POST["check"])).($ld||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$xg)."' class='edit'>".lang(92)."</a>"));foreach($H
as$x=>$X){if(isset($Vd[$x])){$o=$p[$x];$X=$m->value($X,$o);if($X!=""&&(!isset($Wb[$x])||$Wb[$x]!=""))$Wb[$x]=(is_mail($X)?$Vd[$x]:"");$z="";if(preg_match('~blob|bytea|raw|file~',$o["type"])&&$X!="")$z=ME.'download='.urlencode($a).'&field='.urlencode($x).$xg;if(!$z&&$X!==null){foreach((array)$Cc[$x]as$Bc){if(count($Cc[$x])==1||end($Bc["source"])==$x){$z="";foreach($Bc["source"]as$s=>$Bf)$z.=where_link($s,$Bc["target"][$s],$I[$Ud][$Bf]);$z=($Bc["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($Bc["db"]),ME):ME).'select='.urlencode($Bc["table"]).$z;if($Bc["ns"])$z=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($Bc["ns"]),$z);if(count($Bc["source"])==1)break;}}}if($x=="COUNT(*)"){$z=ME."select=".urlencode($a);$s=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$wg))$z.=where_link($s++,$W["col"],$W["val"],$W["op"]);}foreach($wg
as$od=>$W)$z.=where_link($s++,$od,$W);}$X=select_value($X,$z,$o,$Wf);$Wc=h("val[$xg][".bracket_escape($x)."]");$Y=$_POST["val"][$xg][bracket_escape($x)];$Sb=!is_array($H[$x])&&is_utf8($X)&&$I[$Ud][$x]==$H[$x]&&!$Hc[$x];$Uf=preg_match('~text|lob~',$o["type"]);echo"<td id='$Wc'";if(($_GET["modify"]&&$Sb)||$Y!==null){$Mc=h($Y!==null?$Y:$H[$x]);echo">".($Uf?"<textarea name='$Wc' cols='30' rows='".(substr_count($H[$x],"\n")+1)."'>$Mc</textarea>":"<input name='$Wc' value='$Mc' size='$_d[$x]'>");}else{$Ed=strpos($X,"<i>â€¦</i>");echo" data-text='".($Ed?2:($Uf?1:0))."'".($Sb?"":" data-warning='".h(lang(93))."'").">$X</td>";}}}if($Ia)echo"<td>";$b->backwardKeysPrint($Ia,$I[$Ud]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n","</div>\n";}if(!is_ajax()){if($I||$C){$gc=true;if($_GET["page"]!="last"){if($y==""||(count($I)<$y&&($I||!$C)))$Ec=($C?$C*$y:0)+count($I);elseif($w!="sql"||!$ld){$Ec=($ld?false:found_rows($R,$Z));if($Ec<max(1e4,2*($C+1)*$y))$Ec=reset(slow_query(count_rows($a,$Z,$ld,$Ic)));else$gc=false;}}$we=($y!=""&&($Ec===false||$Ec>$y||$C));if($we){echo(($Ec===false?count($I)+1:$Ec-$C*$y)>$y?'<p><a href="'.h(remove_from_uri("page")."&page=".($C+1)).'" class="loadmore">'.lang(94).'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$y).", '".lang(95)."â€¦');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($I||$C){if($we){$Kd=($Ec===false?$C+(count($I)>=$y?2:1):floor(($Ec-1)/$y));echo"<fieldset>";if($w!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".lang(96)."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".lang(96)."', '".($C+1)."')); return false; };"),pagination(0,$C).($C>5?" â€¦":"");for($s=max(1,$C-4);$s<min($Kd,$C+5);$s++)echo
pagination($s,$C);if($Kd>0){echo($C+5<$Kd?" â€¦":""),($gc&&$Ec!==false?pagination($Kd,$C):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Kd'>".lang(97)."</a>");}}else{echo"<legend>".lang(96)."</legend>",pagination(0,$C).($C>1?" â€¦":""),($C?pagination($C,$C):""),($Kd>$C?pagination($C+1,$C).($Kd>$C+1?" â€¦":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".lang(98)."</legend>";$Kb=($gc?"":"~ ").$Ec;echo
checkbox("all",1,0,($Ec!==false?($gc?"":"~ ").lang(99,$Ec):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$Kb' : checked); selectCount('selected2', this.checked || !checked ? '$Kb' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>',lang(89),'</legend><div>
<input type="submit" value="',lang(15),'"',($_GET["modify"]?'':' title="'.lang(85).'"'),'>
</div></fieldset>
<fieldset><legend>',lang(100),' <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="',lang(11),'">
<input type="submit" name="clone" value="',lang(101),'">
<input type="submit" name="delete" value="',lang(19),'">',confirm(),'</div></fieldset>
';}$Dc=$b->dumpFormat();foreach((array)$_GET["columns"]as$e){if($e["fun"]){unset($Dc['sql']);break;}}if($Dc){print_fieldset("export",lang(102)." <span id='selected2'></span>");$te=$b->dumpOutput();echo($te?html_select("output",$te,$sa["output"])." ":""),html_select("format",$Dc,$sa["format"])," <input type='submit' name='export' value='".lang(102)."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($Wb,'strlen'),$f);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".lang(103)."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$sa["format"],1);echo" <input type='submit' name='import' value='".lang(103)."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$hg'>\n","</form>\n",(!$Ic&&$J?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["script"])){if($_GET["script"]=="kill")$h->query("KILL ".number($_POST["kill"]));elseif(list($Q,$Wc,$A)=$b->_foreignColumn(column_foreign_keys($_GET["source"]),$_GET["field"])){$y=11;$F=$h->query("SELECT $Wc, $A FROM ".table($Q)." WHERE ".(preg_match('~^[0-9]+$~',$_GET["value"])?"$Wc = $_GET[value] OR ":"")."$A LIKE ".q("$_GET[value]%")." ORDER BY 2 LIMIT $y");for($s=1;($H=$F->fetch_row())&&$s<$y;$s++)echo"<a href='".h(ME."edit=".urlencode($Q)."&where".urlencode("[".bracket_escape(idf_unescape($Wc))."]")."=".urlencode($H[0]))."'>".h($H[1])."</a><br>\n";if($H)echo"...\n";}exit;}else{page_header(lang(62),"",false);if($b->homepage()){echo"<form action='' method='post'>\n","<p>".lang(104).": <input type='search' name='query' value='".h($_POST["query"])."'> <input type='submit' value='".lang(42)."'>\n";if($_POST["query"]!="")search_tables();echo"<div class='scrollable'>\n","<table class='nowrap checkable odds'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^tables\[/);",""),'<th>'.lang(105),'<td>'.lang(106),"</thead>\n";foreach(table_status()as$Q=>$H){$A=$b->tableName($H);if(isset($H["Engine"])&&$A!=""){echo'<tr><td>'.checkbox("tables[]",$Q,in_array($Q,(array)$_POST["tables"],true)),"<th><a href='".h(ME).'select='.urlencode($Q)."'>$A</a>";$X=format_number($H["Rows"]);echo"<td align='right'><a href='".h(ME."edit=").urlencode($Q)."'>".($H["Engine"]=="InnoDB"&&$X?"~ $X":$X)."</a>";}}echo"</table>\n","</div>\n","</form>\n",script("tableCheck();");}}page_footer();