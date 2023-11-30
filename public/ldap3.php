<?php
$ldaphost = "192.168.1.103"; // Replace with the actual IP address of your Synology NAS
$ldapport = "389"; // Default LDAP port
$ldapdn = "uid=manon2029,cn=users,dc=synology"; // Replace with the admin DN of your Synology LDAP
$ldappass = "Hackbychu@2022"; // Replace with the admin password

$base = "dc=synology"; // Replace with the base DN of your LDAP directory
$filter = "(&(objectClass=person)(cn=*))"; // Adjust the filter based on your requirements

$ds = ldap_connect($ldaphost, $ldapport);

if ($ds) {
    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
    ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);

    $r = ldap_bind($ds, $ldapdn, $ldappass);

    if ($r) {
        echo "LDAP bind successful<br>";

        // Perform LDAP search
        $sr = ldap_search($ds, $base, $filter);
        $entries = ldap_get_entries($ds, $sr);

        // Display search results
        //echo "Search results:<br>";
        //print_r($entries);
        for ($i = 0; $i < $info["count"]; $i++) {
            $luser = $info[$i]["mail"][0];
        }

        echo $luser;

        ldap_close($ds);
    } else {
        echo "LDAP bind failed";
    }
} else {
    echo "Unable to connect to LDAP server";
}
