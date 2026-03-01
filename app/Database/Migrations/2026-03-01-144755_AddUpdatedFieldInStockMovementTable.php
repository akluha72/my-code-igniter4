<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUpdatedFieldInStockMovementTable extends Migration
{
    public function up()
    {
        $fields = [
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
                'after' => 'created_at'
            ]
        ];
        $this->forge->addColumn('stock_movements', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('stock_movements', 'updated_at');
    }
}
