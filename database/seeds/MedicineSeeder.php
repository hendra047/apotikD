<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicines')->insert([
            'medicine_name' => 'Hidromorfon',
            'medicine_form' => 'tab lepas lambat 8 mg',
            'medicine_formula' => '30 tab/bulan',
            'description' => '',
            'faskes_1' => '0',
            'faskes_2' => '1',
            'faskes_3' => '1',
            'category_id' => '1',
        ]);

        DB::table('medicines')->insert([
            'medicine_name' => 'Kodein',
            'medicine_form' => 'tab 10 mg',
            'medicine_formula' => '30 tab/bulan',
            'description' => '',
            'faskes_1' => '1',
            'faskes_2' => '1',
            'faskes_3' => '1',
            'category_id' => '1',
        ]);

        DB::table('medicines')->insert([
            'medicine_name' => 'Morfin',
            'medicine_form' => 'tab 10 mg',
            'medicine_formula' => 'initial dosis 3-4 tab/hari',
            'description' => 'Hanya untuk pemakaian pada tindakan anestesi atau perawatan di Rumah Sakit;\n\nUntuk mengatasi nyeri kanker yang tidak respons terhadap analgesik non narkotik;\n\nUntuk nyeri pada serangan jantung.',
            'faskes_1' => '0',
            'faskes_2' => '1',
            'faskes_3' => '1',
            'category_id' => '1',
        ]);

        DB::table('medicines')->insert([
            'medicine_name' => 'Asam Mefenamat',
            'medicine_form' => 'kaps 250 mg',
            'medicine_formula' => '30 kaps/bulan',
            'description' => '',
            'faskes_1' => '1',
            'faskes_2' => '1',
            'faskes_3' => '1',
            'category_id' => '2',
        ]);

        DB::table('medicines')->insert([
            'medicine_name' => 'Ketorolak',
            'medicine_form' => 'inj 30 mg/mL',
            'medicine_formula' => '2 - 3 amp/hari, maks 2 hari.',
            'description' => 'Untuk nyeri sedang sampai berat pada pasien yang tidak dapat menggunakan analgesik secara oral.',
            'faskes_1' => '0',
            'faskes_2' => '1',
            'faskes_3' => '1',
            'category_id' => '2',
        ]);
    }
}
