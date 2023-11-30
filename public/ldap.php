<?php
//ldap
$ldaphost = "192.168.1.103";
$ldapport = "389";
//$ldapdn = $_POST["user_name"]."@ipst.ac.th";
$ldapdn = $_POST["user_name"] . $_POST["ips_name"];
$ldappass = $_POST["password"];
$ldapdn = "manon2029@manon2029.local";
$ldappass = "Hackbychu@2022";
$base = "cn=users,dc=manon2029";
//$base = "ou=VPN,dc=ad,dc=ipst,dc=ac,dc=th";
$filter = "sAMAccountName=" . $ldapdn . "";
//$filter = "Mail=".$_POST["user_name"]."";
$ds = ldap_connect($ldaphost, $ldapport);
//echo "connect result is " . $ds . "<br>\n";
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
if ($ds) {
    //echo "Binding ...\n";
    if (!ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3)) {
        echo "Failed to setup LDAP protocol to 3 - Start TLS not support\n";
        exit;
    }
    $r = ldap_bind($ds, $ldapdn, $ldappass);
    //echo "Bind result is " . $r . "<br>\n";
    //echo "Searching for $filter ...";
    $sr = ldap_search($ds, $base, "($filter)");
    //echo "Search result is " . $sr . "<br>\n";
    //echo "Number of entires returned is " . ldap_count_entries($ds, $sr) . "<br>\n";
    //echo "Getting entries ...<p>\n";
    $info = ldap_get_entries($ds, $sr);
    //echo "Data for " . $info["count"] . " items returned:<p>\n";
    for ($i = 0; $i < $info["count"]; $i++) {
        //echo "DN : " . $info[$i]["dn"] . "<br>\n";
        //echo "User Name : " . $info[$i]["samaccountname"][0] . "<br>\n";
        //echo "Display Name : " . $info[$i]["givenname"][0] . "&nbsp;". $info[$i]["sn"][0] ."<br>\n";
        //echo "Description : " . $info[$i]["description"][0] . "<br>\n";
        //echo "Office : " . $info[$i]["physicaldeliveryofficename"][0] . "<br>\n";
        echo "Phone Number : " . $info[$i]["telephonenumber"][0] . "<br>\n";
        //echo "Exten : " . $info[$i]["extension"][0] . "<br>\n";
        //echo "E-Mail: " . $info[$i]["mail"][0] . "<br><hr>\n\n";
        $luser = $info[$i]["telephonenumber"][0];
        $lpass = $info[$i]["telephonenumber"][0];
    }
    //echo "Closing connection\n";
    ldap_close($ds);
} else {
    echo "<h4>Unable to connect to LDAP server</h4>";
}
//ldap