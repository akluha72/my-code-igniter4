<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class WarehouseProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $this->db->query('SET FOREIGN_KEY_CHECKS=0');
        $this->db->table('products')->truncate();
        $this->db->table('warehouses')->truncate();
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');

        $warehouses = [
            [
                'name' => 'Warehouse 1',
                'location' => $faker->city,
            ],
            [
                'name' => 'Warehouse 2',
                'location' => $faker->city,
            ],
            [
                'name' => 'Warehouse 3',
                'location' => $faker->city,
            ],
        ];

        $this->db->table('warehouses')->insertBatch($warehouses);

        $warehouseRows = $this->db->table('warehouses')->orderBy('id', 'ASC')->get()->getResultArray();

        $products = [];
        $counts = [4, 3, 1];
        $quantities = [150, 100, 10];

        foreach ($warehouseRows as $index => $warehouse) {
            $count = $counts[$index] ?? 0;
            $quantity = $quantities[$index] ?? 0;

            for ($i = 0; $i < $count; $i++) {
                $products[] = [
                    'warehouse_id' => $warehouse['id'],
                    'name' => $faker->unique()->words(2, true),
                    'sku' => strtoupper($faker->bothify('SKU-###??')),
                    'quantity' => $quantity,
                ];
            }
        }

        if (!empty($products)) {
            $this->db->table('products')->insertBatch($products);
        }
    }
}
