<?php
require 'app/Config/Paths.php';
$paths = new Config\Paths();
define('FCPATH', __DIR__ . '/public/');
require $paths->systemDirectory . '/bootstrap.php';
$db = \Config\Database::connect();
$db->query('DROP TABLE IF EXISTS faqs');
$db->query('DROP TABLE IF EXISTS privacy_policies');
$db->query('DELETE FROM migrations WHERE class = "App\\\Database\\\Migrations\\\CreateFaqsTable" OR class = "App\\\Database\\\Migrations\\\CreatePrivacyPoliciesTable"');
echo "Done";
