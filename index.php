<?php

define("USER", "");
define("PASS", "");
define("SALT", "29d0be3d2492d99362169be3d4238cb35b4"); // IMPORTANT: Must enter a random string (min 16 chars) here which will be used to create hashes.

error_reporting(0);
if (strlen(SALT) < 16) {die("system error: Min 16 character random string as SALT is required.");}
chdir(dirname(__FILE__)) or die("system error: chdir");
@mkdir("data");
if ($argc) {process($argv);}
if ($_REQUEST['id']) {status();}
$c=$_REQUEST['_'];
if ($c=='verify') {verify();}

echo <<<S_HTML

<meta charset="utf-8">
<html>
<head>
     <title>Free Wildcard Certificates from 80host</title>
<body bgcolor="#aed5e3">
<br><br>
<form method="POST">
<div id="content" align="center" style="font-family: Tahoma; font-size: 10pt; letter-spacing: 1">
  <center>
<table border="0" cellpadding="3" cellspacing="0" style="border-collapse: collapse; font-family: Tahoma; font-size: 10pt; letter-spacing: 1" bordercolor="#111111">
  <tr>
    <td width="100%" colspan="2" dir="ltr" style="color: #FFFFFF" bgcolor="4657af">
    请输入你的CSR:</td>
  </tr>
  <tr>
    <td width="100%" colspan="2" style="padding: 0" dir="ltr">&nbsp;</td>
    </tr>
  <tr>
    <td width="100%" colspan="2" dir="ltr" align="center">
    <textarea rows="13" name="csr" cols="90" style="font-family: Tahoma; font-size: 8pt"></textarea></td>
  </tr>
  <tr>
    <td width="100%" colspan="2" style="padding: 0">&nbsp;</td>
    </tr>
  <tr>
    <td width="100%" colspan="2" style="color: #FFFFFF" bgcolor="4657af">
    证书接收邮件地址:</td>
  </tr>
  <tr>
    <td width="100%" colspan="2" style="padding: 0">&nbsp;</td>
    </tr>
  <tr>
    <td width="50%" align="right">
    <font size="1">(请务必输入正确.
    )</font></td>
    <td width="50%">
    <input type="text" name="email" size="32" style="font-family: Tahoma; font-size: 10pt; letter-spacing: 1"></td>
  </tr>
  <tr>
    <td width="100%" colspan="2" style="padding: 0">&nbsp;</td>
    </tr>
  <tr>
    <td width="100%" colspan="2" style="color: #FFFFFF" bgcolor="4657af">
    必须输入,请不要随意填写. <font size="1">(请使用英文Or拼音)</font></td>
  </tr>
  <tr>
    <td width="100%" colspan="2" style="padding: 0">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%" align="right">
    <p dir="ltr">姓:<br>
    <font size="1">(仅字母3-20个字符)</font></td>
    <td width="50%">
    <input type="text" name="fname" size="32" style="font-family: Tahoma; font-size: 10pt; letter-spacing: 1"></td>
  </tr>
  <tr>
    <td width="50%" align="right">
    <p dir="ltr">名:<br>
    <font size="1">(仅字母3-20个字符)</font></td>
    <td width="50%">
    <input type="text" name="lname" size="32" style="font-family: Tahoma; font-size: 10pt; letter-spacing: 1"></td>
  </tr>
  <tr>
    <td width="50%" align="right">
    <p dir="ltr">电话号码:<br>
    <font size="1">(仅数字,6-20位)</font></td>
    <td width="50%">
    <input type="text" name="phone" size="32" style="font-family: Tahoma; font-size: 10pt; letter-spacing: 1"></td>
  </tr>
  <tr>
    <td width="100%" colspan="2" style="padding: 0">&nbsp;</td>
    </tr>
  <tr>
    <td width="100%" colspan="2" align="center">
    <input name="next" onclick="check(this.form)" type="button" value="校验 &gt;" style="font-family: Tahoma; font-size: 10pt; letter-spacing: 1"></td>
  </tr>
  </table>
  <center>
<br>
<br>
                                        <tr>
                                            <td valign="top" class="footerContent">
                                                 <a href="http://www.80host.com/specials.html">查看最新促销</a>
                                                <span class="hide-mobile"> | </span>
                                                <a href="http://www.80host.com">访问网站</a>
                                                <span class="hide-mobile"> | </span>
                                                <a href="https://my.80host.com/login.php">登陆账号</a>
                                                <span class="hide-mobile"> | </span>
                                                <a href="https://my.80host.com/submitticket.php">提交支持工单</a> <br />
                                                Copyright &copy; 80host, All rights reserved.
                                            </td>
                                            </center>
</div>
<input type="hidden" name="_" value="校验">
</form>

<script src="https://s11.cnzz.com/stat.php?id=1259531462&web_id=1259531462" language="JavaScript"></script>
<script>
function check(f) {ajax("?", function(res) {eval(res);}, "ajax=1&_=verify&csr="+encodeURIComponent(f.csr.value)+"&email="+encodeURIComponent(f.email.value));}
function ajax(B,A){this.bindFunction=function(E,D){return function(){return E.apply(D,[D])}};this.stateChange=function(D){if(this.request.readyState==4){this.callbackFunction(this.request.responseText)}};this.getRequest=function(){if(window.ActiveXObject){return new ActiveXObject("Microsoft.XMLHTTP")}else{if(window.XMLHttpRequest){return new XMLHttpRequest()}}return false};this.postBody=(arguments[2]||"");this.callbackFunction=A;this.url=B;this.request=this.getRequest();if(this.request){var C=this.request;C.onreadystatechange=this.bindFunction(this.stateChange,this);if(this.postBody!==""){C.open("POST",B,true);C.setRequestHeader("Content-type","application/x-www-form-urlencoded")}else{C.open("GET",B,true)}C.send(this.postBody)}};
</script>

</body>
</html>
S_HTML;


function verify()
{
$fname=preg_match('/^\s*([a-zA-Z]{3,20})\s*$/', $_REQUEST['fname'], $j) ? $j[1] : 'John';
$lname=preg_match('/^\s*([a-zA-Z]{3,20})\s*$/', $_REQUEST['lname'], $j) ? $j[1] : 'Doe';
$email=filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL);
$phone=preg_match('/^\s*([0-9]{6,20})\s*$/', $_REQUEST['phone'], $j) ? $j[1] : '9876543210';
$csr=preg_replace('!(\r\n|\r|\n)!', "\n", trim($_REQUEST['csr']));
$hash=md5($csr);

if (!$email) {$e='A valid email address is required. SSL certificate will be mailed to it.';}
elseif (($cn=getcn("$csr"))===false) {$e='CSR is invalid.';}
else
{
$fp=fopen("data/$hash.lock", 'w');
if(!flock($fp, LOCK_EX | LOCK_NB)) {$e='SSL issue is already under process for this CSR. Please wait few minutes before trying again.';}
else {flock($fp, LOCK_UN);}
fclose($fp);
}

if ($e) {die("alert('$e');");}

$md5=md5($fname.$lname.$email.$phone.$csr);
if ($_REQUEST["ajax"])
{
echo <<<S_HTML
if(confirm("您输入的CSR域名为:\\n\\n$cn\\n\\n点击确定继续签发证书或点击取消返回更改.")) {f.submit();}
S_HTML;
}
else
{
$uid=md5(time().rand().$fname.$lname.$email.$phone.$csr);
$id=md5($uid.SALT);
file_put_contents("data/$id.txt", serialize(array('fname'=>$fname, 'lname'=>$lname, 'email'=>$email, 'phone'=>$phone, 'csr'=>$csr, 'cn'=>$cn, 'status'=>'Please wait ...'))) or die("system error: write-id-file");
exec("php5 ".__FILE__." $id > /dev/null 2>&1 &");
header("Location: ?id=$uid");
}
exit;
}


function status()
{
$uid=$_REQUEST['id'];
$id=md5($uid.SALT);
if (!$id || !file_exists("data/$id.txt")) {$error="session: $uid not found.";}
else {$d=session($id); extract($d);}

$ve=$_REQUEST['vemail'];
if ($ve && !$vemail && count($emails) && in_array($ve, $emails) && !$error && !$done)
{
session($id, 'status', "<u>$ve</u> 向你选择的邮件地址发送验证邮件并.<br>提交订单中..");
extract(session($id, 'vemail', $ve));
exec("php5 ".__FILE__." $id > /dev/null 2>&1 &");
die(header("Location: ?id=$uid"));
}

if (!$done && !$error && !$vemail && count($emails))
{
$icon='info.png';
foreach ($emails as $i) $html.="<a href='?id=$uid&vemail=$i'>$i</a><br>";
$refresh='';
}
elseif ($error) {$icon='error.png'; $error="<font color='#FF0000'><h2>($error)</h2></font>";}
elseif ($done) {$icon='success.png';}
else {$icon='progress.gif'; $refresh=1; $info='<br>该页面将每5秒刷新一次,有时最多需要2-3分钟才能完成提交.';}

if ($refresh) {$refresh="<meta http-equiv='refresh' content='5;URL=?id=$uid'>";}

echo <<<S_HTML
<html>
<head>
$refresh
<style>
a {color: blue; text-decoration: none;}
a:visited {color: blue; text-decoration: none;}
a:hover {color: red;text-decoration: underline;}
</style>
</head>
<body bgcolor="#aed5e3">
<div align="center" style="font-family: Tahoma; font-size: 10pt; letter-spacing: 1">
<br><img src="$icon"><br>$info<br><h3>$status</h3>
$error
$html
</div>
</body>
</html>
S_HTML;
exit;
}


function process($argv)
{
$id=$argv[1];
extract(session($id));
if (!$cn) {session($id, 'error', 1); die("session not found.");}
if ($done || $error) {die("process already completed.");}

$hash=md5($csr);

$fp=fopen("data/$hash.lock", 'w');
if(!flock($fp, LOCK_EX | LOCK_NB)) {session($id, 'error', 1); error($id, __LINE__, "Could not get acquire file lock.");}

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
 
$cf="data/$id.cookies";
curl_setopt($ch, CURLOPT_COOKIEFILE, $cf);
curl_setopt($ch, CURLOPT_COOKIEJAR,  $cf);


if (!$csrf)
{
curl_setopt($ch, CURLOPT_URL, "https://leap.singlehop.com/"); 
$d = curl_exec($ch);
if (!preg_match('/csrftoken=(.+?);/', $d, $csrf)) {error($id, __LINE__, "Failed to get initial CSRF token.", $d);}
$csrf=urldecode($csrf[1]);
session($id, 'status', 'Logging in..');
$post = array('csrftoken' => $csrf,'username' => USER,'password' => PASS);
curl_setopt($ch, CURLOPT_URL, "https://leap.singlehop.com/user/actn/login/"); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
$d = curl_exec($ch);
if (!preg_match('/csrftoken=(.+?);/', $d, $csrf)) {error($id, __LINE__, "Failed to get CSRF token.", $d);}
$csrf=urldecode($csrf[1]);
if (strpos($d, '<meta http-equiv="refresh" content="0;URL=\'/user/dashboard\'"')===false) {error($id, __LINE__, "Login failed.", $d);}
session($id, 'csrf', $csrf);
session($id, 'status', 'Logged in.. CSRF token retrieved.');
}

if (!count($emails))
{
session($id, 'status', '创建订单状态..');
$post = array('csrftoken'  => $csrf,'domain' => $cn,'first' => $fname,'last' => $lname,'email' => $email,'phone' => $phone);
curl_setopt($ch, CURLOPT_URL, "https://leap.singlehop.com/account/actn/ssl-create/"); 
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
$d = curl_exec($ch);
if (!preg_match('~\Q<meta http-equiv="refresh" content="0;URL=\'/account/ssl-purchase/\E(.+?)/\'"~', $d, $order))  {error($id, __LINE__, "订单创建出错,请检查CSR信息并返回重试.", $d);}
$order=$order[1];
session($id, 'order', $order);
session($id, 'status', "Order: <u>$order</u> generated. Fetching email addresses..");
curl_setopt($ch, CURLOPT_URL, "https://leap.singlehop.com/account/ssl-purchase/$order/"); 
curl_setopt($ch, CURLOPT_HTTPGET, 1);
$d = curl_exec($ch);
if (!preg_match_all('/<option value="(.+?)"/', $d, $e)) {error($id, __LINE__, "Could not retrieve validation email addressess.", $d);}
$e=$e[1];
session($id, 'emails', $e);
session($id, 'status', "请选择一个邮件地址用于验证域名所有权(DV证书只验证域名所有权):");
}

elseif($vemail)
{
$post=array('csrftoken'  => $csrf, 'email' => $vemail,'csr' => $csr);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
curl_setopt($ch, CURLOPT_URL, "https://leap.singlehop.com/account/actn/ssl-purchase/$order/"); 
$d = curl_exec($ch);
if (strpos($d, '<meta http-equiv="refresh" content="0;URL=\'/account/ssl-finalize/\'" />')===false) {error($id, __LINE__, "Could not submit order.", $d);}
session($id, 'status', "过程成功完成.<br><br>您的这个邮件地址将会收到验证链接: <u>$vemail</u>.<br>它可能需要几分钟到几个小时才会发送到你的收件箱.<br>你必须访问邮件内的验证链接并点击 \"我同意(I Approve)\" 按钮才能颁发证书.<br>完整域名验证后txt格式的证书将被发送到这个邮件地址: <u>$email</u><br><br>");
session($id, 'done', 1);
}

curl_close($ch);
flock($fp, LOCK_UN);
fclose($fp);
unlink("data/$hash.lock");

exit;
}

function session($id, $k="", $v="")
{
$d=unserialize(file_get_contents("data/$id.txt"));
if ($k) {$d[$k]=$v;}
file_put_contents("data/$id.txt", serialize($d));
return $d;
}

function error($id, $line, $msg, $log='')
{
session($id, 'log', $log);
session($id, 'error-line', $line);
session($id, 'error', $msg);
die();
}

function getcn($csr)
{
$f=tempnam(sys_get_temp_dir(), 'csr');
file_put_contents($f, $csr);
$cn=exec("openssl req -in $f -noout -subject 2>/dev/null");
unlink($f);
if(preg_match('~CN=([^/\s]+)~', $cn, $cn)) {return $cn[1];}
return false;
}

?>


