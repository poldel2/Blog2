<?php
require __DIR__.'/../../DB.php';

$db = \Laravel\Blog\application\DB::getConnection();

//require '20240508120000_create_users_table.php';
require '20240508130000_create_articles_table.php';
require '20240508140000_create_comments_table.php';