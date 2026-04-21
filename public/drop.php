<?php
$db = new \mysqli('localhost', 'root', 'root', 'dinas_kelautan_perikanan_db');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
$db->query("DROP TABLE IF EXISTS faqs");
$db->query("DROP TABLE IF EXISTS privacy_policies");
$db->query("DELETE FROM migrations WHERE class = 'App\\\\Database\\\\Migrations\\\\CreateFaqsTable' OR class = 'App\\\\Database\\\\Migrations\\\\CreatePrivacyPoliciesTable'");
echo "Tables dropped";
