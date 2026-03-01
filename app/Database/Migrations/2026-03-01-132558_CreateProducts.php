<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProducts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'warehouse_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'sku' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at DATETIME default current_timestamp',
            'updated_at DATETIME default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('warehouse_id', 'warehouses', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');    
    }
}
