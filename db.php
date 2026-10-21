
<?php

$dbhost = 'aws-0-ap-northeast-2.pooler.supabase.com';
$dbUser = 'postgres.tcaxhcmsgzzybqmmgzsf';
$dbPassword = 'AP2400638amp';

$conn = pg_connect("host=$dbhost port=5432 dbname=postgres user=$dbUser password=$dbPassword");

if (!$conn) {
    exit('Database connection failed.');
}

?>
