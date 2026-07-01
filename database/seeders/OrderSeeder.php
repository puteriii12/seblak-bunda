<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            // === HARI INI & MINGGU INI ===
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Ahmad Rizki',
                'customer_phone' => '081234567890',
                'spicy_level' => 3,
                'order_type' => 'dine-in',
                'payment_method' => 'cash',
                'note' => 'Level pedas sedang',
                'status' => 'completed',
                'total' => 45000,
                'created_at' => Carbon::now()->subHours(2),
            ],
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Siti Nurhaliza',
                'customer_phone' => '081234567891',
                'spicy_level' => 5,
                'order_type' => 'take-away',
                'payment_method' => 'qris',
                'note' => 'Jangan pakai sawi',
                'status' => 'completed',
                'total' => 62000,
                'created_at' => Carbon::now()->subHours(5),
            ],
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Budi Santoso',
                'customer_phone' => '081234567892',
                'spicy_level' => 2,
                'order_type' => 'dine-in',
                'payment_method' => 'cash',
                'note' => null,
                'status' => 'completed',
                'total' => 38000,
                'created_at' => Carbon::now()->subDays(1),
            ],
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Dewi Lestari',
                'customer_phone' => '081234567893',
                'spicy_level' => 4,
                'order_type' => 'take-away',
                'payment_method' => 'qris',
                'note' => 'Tambah kerupuk',
                'status' => 'completed',
                'total' => 75000,
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Eko Prasetyo',
                'customer_phone' => '081234567894',
                'spicy_level' => 1,
                'order_type' => 'dine-in',
                'payment_method' => 'cash',
                'note' => 'Tidak pedas',
                'status' => 'completed',
                'total' => 42000,
                'created_at' => Carbon::now()->subDays(3),
            ],

            // === MINGGU LALU ===
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Fitri Handayani',
                'customer_phone' => '081234567895',
                'spicy_level' => 3,
                'order_type' => 'take-away',
                'payment_method' => 'qris',
                'note' => null,
                'status' => 'completed',
                'total' => 55000,
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Gunawan',
                'customer_phone' => '081234567896',
                'spicy_level' => 5,
                'order_type' => 'dine-in',
                'payment_method' => 'cash',
                'note' => 'Super pedas!',
                'status' => 'completed',
                'total' => 68000,
                'created_at' => Carbon::now()->subDays(6),
            ],

            // === 2-3 MINGGU LALU ===
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Hana Pertiwi',
                'customer_phone' => '081234567897',
                'spicy_level' => 2,
                'order_type' => 'take-away',
                'payment_method' => 'qris',
                'note' => 'Banyak kuah',
                'status' => 'completed',
                'total' => 52000,
                'created_at' => Carbon::now()->subDays(10),
            ],
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Indra Wijaya',
                'customer_phone' => '081234567898',
                'spicy_level' => 4,
                'order_type' => 'dine-in',
                'payment_method' => 'cash',
                'note' => null,
                'status' => 'completed',
                'total' => 47000,
                'created_at' => Carbon::now()->subDays(12),
            ],
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Joko Susilo',
                'customer_phone' => '081234567899',
                'spicy_level' => 3,
                'order_type' => 'take-away',
                'payment_method' => 'qris',
                'note' => 'Tambah telor puyuh',
                'status' => 'completed',
                'total' => 85000,
                'created_at' => Carbon::now()->subDays(15),
            ],

            // === BULAN LALU ===
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Kartini',
                'customer_phone' => '081234567800',
                'spicy_level' => 2,
                'order_type' => 'dine-in',
                'payment_method' => 'cash',
                'note' => null,
                'status' => 'completed',
                'total' => 43000,
                'created_at' => Carbon::now()->subMonths(1)->subDays(5),
            ],
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Lukman Hakim',
                'customer_phone' => '081234567801',
                'spicy_level' => 5,
                'order_type' => 'take-away',
                'payment_method' => 'qris',
                'note' => 'Pedas maksimal',
                'status' => 'completed',
                'total' => 92000,
                'created_at' => Carbon::now()->subMonths(1)->subDays(10),
            ],
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Maya Sari',
                'customer_phone' => '081234567802',
                'spicy_level' => 1,
                'order_type' => 'dine-in',
                'payment_method' => 'cash',
                'note' => 'Sedikit pedas',
                'status' => 'completed',
                'total' => 35000,
                'created_at' => Carbon::now()->subMonths(1)->subDays(15),
            ],
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Nugroho',
                'customer_phone' => '081234567803',
                'spicy_level' => 3,
                'order_type' => 'take-away',
                'payment_method' => 'qris',
                'note' => null,
                'status' => 'completed',
                'total' => 58000,
                'created_at' => Carbon::now()->subMonths(1)->subDays(20),
            ],
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Olivia',
                'customer_phone' => '081234567804',
                'spicy_level' => 4,
                'order_type' => 'dine-in',
                'payment_method' => 'cash',
                'note' => 'Tambah bakso',
                'status' => 'completed',
                'total' => 72000,
                'created_at' => Carbon::now()->subMonths(1)->subDays(25),
            ],

            // === 2 BULAN LALU ===
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Putra Perdana',
                'customer_phone' => '081234567805',
                'spicy_level' => 2,
                'order_type' => 'take-away',
                'payment_method' => 'qris',
                'note' => null,
                'status' => 'completed',
                'total' => 48000,
                'created_at' => Carbon::now()->subMonths(2)->subDays(5),
            ],
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Qori Azzahra',
                'customer_phone' => '081234567806',
                'spicy_level' => 3,
                'order_type' => 'dine-in',
                'payment_method' => 'cash',
                'note' => 'Level sedang',
                'status' => 'completed',
                'total' => 55000,
                'created_at' => Carbon::now()->subMonths(2)->subDays(15),
            ],
            [
                'order_id' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => 'Rudi Hartono',
                'customer_phone' => '081234567807',
                'spicy_level' => 5,
                'order_type' => 'take-away',
                'payment_method' => 'qris',
                'note' => 'Extra pedas',
                'status' => 'completed',
                'total' => 88000,
                'created_at' => Carbon::now()->subMonths(2)->subDays(25),
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }

        $this->command->info('✅ Order seeder berhasil! ' . count($orders) . ' data dibuat.');
    }
}