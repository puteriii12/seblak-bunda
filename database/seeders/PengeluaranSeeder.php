<?php

namespace Database\Seeders;

use App\Models\Pengeluaran;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenses = [
            // === MINGGU INI ===
            [
                'name' => 'Beli Minyak Goreng',
                'amount' => 25000,
                'expense_date' => Carbon::now()->subDays(1),
                'description' => 'Minyak goreng 2 liter',
            ],
            [
                'name' => 'Beli Cabai Merah',
                'amount' => 45000,
                'expense_date' => Carbon::now()->subDays(2),
                'description' => 'Cabai merah 2kg untuk sambal',
            ],
            [
                'name' => 'Beli Sawi',
                'amount' => 15000,
                'expense_date' => Carbon::now()->subDays(3),
                'description' => 'Sawi hijau segar',
            ],
            [
                'name' => 'Beli Telur Ayam',
                'amount' => 35000,
                'expense_date' => Carbon::now()->subDays(4),
                'description' => 'Telur ayam 1 tray',
            ],
            [
                'name' => 'Beli Bawang Putih',
                'amount' => 28000,
                'expense_date' => Carbon::now()->subDays(5),
                'description' => 'Bawang putih 1kg',
            ],
            [
                'name' => 'Beli Kerupuk',
                'amount' => 18000,
                'expense_date' => Carbon::now()->subDays(6),
                'description' => 'Kerupuk aneka rasa',
            ],

            // === MINGGU LALU ===
            [
                'name' => 'Beli Bakso',
                'amount' => 55000,
                'expense_date' => Carbon::now()->subDays(8),
                'description' => 'Bakso sapi 3kg',
            ],
            [
                'name' => 'Beli Sosis',
                'amount' => 40000,
                'expense_date' => Carbon::now()->subDays(9),
                'description' => 'Sosis ayam frozen',
            ],
            [
                'name' => 'Beli Kangkung',
                'amount' => 12000,
                'expense_date' => Carbon::now()->subDays(10),
                'description' => 'Kangkung segar 2 ikat',
            ],
            [
                'name' => 'Beli Kecap Manis',
                'amount' => 22000,
                'expense_date' => Carbon::now()->subDays(11),
                'description' => 'Kecap manis 1 botol besar',
            ],
            [
                'name' => 'Beli Gas Elpiji',
                'amount' => 24000,
                'expense_date' => Carbon::now()->subDays(12),
                'description' => 'Gas 3kg',
            ],

            // === 3 MINGGU LALU ===
            [
                'name' => 'Beli Jamur Kuping',
                'amount' => 30000,
                'expense_date' => Carbon::now()->subDays(15),
                'description' => 'Jamur kuping kering 500gr',
            ],
            [
                'name' => 'Beli Siomay',
                'amount' => 35000,
                'expense_date' => Carbon::now()->subDays(16),
                'description' => 'Siomay frozen 2 pack',
            ],
            [
                'name' => 'Beli Kol',
                'amount' => 10000,
                'expense_date' => Carbon::now()->subDays(17),
                'description' => 'Kol 1 buah besar',
            ],
            [
                'name' => 'Beli Dumpling',
                'amount' => 45000,
                'expense_date' => Carbon::now()->subDays(18),
                'description' => 'Dumpling keju frozen',
            ],
            [
                'name' => 'Beli Crab Stick',
                'amount' => 32000,
                'expense_date' => Carbon::now()->subDays(19),
                'description' => 'Crab stick 1 pack',
            ],

            // === 4 MINGGU LALU ===
            [
                'name' => 'Beli Ceker Ayam',
                'amount' => 50000,
                'expense_date' => Carbon::now()->subDays(22),
                'description' => 'Ceker ayam 2kg',
            ],
            [
                'name' => 'Beli Tulang Rangu',
                'amount' => 38000,
                'expense_date' => Carbon::now()->subDays(23),
                'description' => 'Tulang rangu frozen',
            ],
            [
                'name' => 'Beli Telur Puyuh',
                'amount' => 25000,
                'expense_date' => Carbon::now()->subDays(24),
                'description' => 'Telur puyuh 1kg',
            ],
            [
                'name' => 'Beli Saos Sambal',
                'amount' => 18000,
                'expense_date' => Carbon::now()->subDays(25),
                'description' => 'Saos sambal 2 botol',
            ],
            [
                'name' => 'Beli Cuanki',
                'amount' => 28000,
                'expense_date' => Carbon::now()->subDays(26),
                'description' => 'Cuanki frozen 1 pack',
            ],

            // === BULAN LALU ===
            [
                'name' => 'Beli Daging Ayam',
                'amount' => 150000,
                'expense_date' => Carbon::now()->subMonths(1)->subDays(5),
                'description' => 'Ayam segar 5kg',
            ],
            [
                'name' => 'Beli Mie',
                'amount' => 80000,
                'expense_date' => Carbon::now()->subMonths(1)->subDays(10),
                'description' => 'Mie instan 2 dus',
            ],
            [
                'name' => 'Beli Bumbu Rempah',
                'amount' => 65000,
                'expense_date' => Carbon::now()->subMonths(1)->subDays(15),
                'description' => 'Kemiri, kunyit, jahe',
            ],
            [
                'name' => 'Beli Plastik Kemasan',
                'amount' => 45000,
                'expense_date' => Carbon::now()->subMonths(1)->subDays(20),
                'description' => 'Plastik berbagai ukuran',
            ],
            [
                'name' => 'Beli Fish Roll',
                'amount' => 42000,
                'expense_date' => Carbon::now()->subMonths(1)->subDays(25),
                'description' => 'Fish roll frozen 2 pack',
            ],

            // === 2 BULAN LALU ===
            [
                'name' => 'Beli Peralatan Masak',
                'amount' => 350000,
                'expense_date' => Carbon::now()->subMonths(2)->subDays(5),
                'description' => 'Panci, wajan, spatula',
            ],
            [
                'name' => 'Service Kompor',
                'amount' => 150000,
                'expense_date' => Carbon::now()->subMonths(2)->subDays(15),
                'description' => 'Perbaikan kompor gas',
            ],
            [
                'name' => 'Beli Freezer',
                'amount' => 1500000,
                'expense_date' => Carbon::now()->subMonths(2)->subDays(25),
                'description' => 'Freezer 1 pintu untuk stok',
            ],
        ];

        foreach ($expenses as $expense) {
            Pengeluaran::create($expense);
        }

        $this->command->info('✅ Pengeluaran seeder berhasil dijalankan! ' . count($expenses) . ' data dibuat.');
    }
}