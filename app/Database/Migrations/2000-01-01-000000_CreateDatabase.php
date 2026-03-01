<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDatabase extends Migration
{
    public function up()
    {
        $dbName = 'ci4';
        $db = \Config\Database::forge();

        // Create database if it doesn't exist
        $db->createDatabase($dbName, true);
    }

    public function down()
    {
        $dbName = 'ci4';
        $db = \Config\Database::forge();

        // Drop database if exists
        $db->dropDatabase($dbName, true);
    }
}
