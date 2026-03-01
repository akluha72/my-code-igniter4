<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStockMovements extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'product_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['IN', 'OUT'],
            ],
            'quantity' => [
                'type' => 'INT',
            ],
            'created_at DATETIME default current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('stock_movements');
    }
    public function down()
    {
        $this->forge->dropTable('stock_movements');
    }
}
