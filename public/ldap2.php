
<?php
$server = " 192.168.1.103"; //dc1-nu
$user = $_POST["username"] . "@manon2029.local";
$pass = "Hackbychu@2022";

$ad = ldap_connect($server);
if (!$ad) {
    die("Connect not connect to " . $server);
    // include("chk_login_db.php");
    echo "ไม่สามารถติดต่อ server มหาลัยเพื่อตรวจสอบรหัสผ่านได้";
    exit();
} else {
    $b = @ldap_bind($ad, $user, $pass);
    if (!$b) {
        die("<br><br>
<div align='center'> ท่านกรอกรหัสผ่านผิดพลาด
<br>
</div>
<meta http-equiv='refresh' content='3 ;url=index.php'>");
    } else {

        echo "ok";
    }
}
