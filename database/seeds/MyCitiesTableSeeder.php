<?php

use Illuminate\Database\Seeder;

class MyCitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cities')->insert(array (
            0 =>
                array (
                    'id' => '1',
                    'name' => 'Thika',
                    'province_id' => '1',
                ),
            1 =>
                array (
                    'id' => '2',
                    'name' => 'Nairobi',
                    'province_id' => '1',
                ),
            2 =>
                array (
                    'id' => '3',
                    'name' => 'Kisumu',
                    'province_id' => '1',
                ),
            3 =>
                array (
                    'id' => '4',
                    'name' => 'Mombasa',
                    'province_id' => '1',
                ),
            4 =>
                array (
                    'id' => '5',
                    'name' => 'Mariakani',
                    'province_id' => '1',
                ),
            5 =>
                array (
                    'id' => '6',
                    'name' => 'Eldoret',
                    'province_id' => '1',
                ),
            6 =>
                array (
                    'id' => '7',
                    'name' => 'Westlands',
                    'province_id' => '1',
                ),
            7 =>
                array (
                    'id' => '8',
                    'name' => 'Kawangware',
                    'province_id' => '1',
                ),
            8 =>
                array (
                    'id' => '9',
                    'name' => 'Malaba',
                    'province_id' => '1',
                ),
            9 =>
                array (
                    'id' => '10',
                    'name' => 'Ruiru',
                    'province_id' => '1',
                ),
            10 =>
                array (
                    'id' => '11',
                    'name' => 'Juja',
                    'province_id' => '1',
                ),
            11 =>
                array (
                    'id' => '12',
                    'name' => 'Kiambu',
                    'province_id' => '1',
                ),
            12 =>
                array (
                    'id' => '13',
                    'name' => 'Kericho',
                    'province_id' => '1',
                ),
            13 =>
                array (
                    'id' => '14',
                    'name' => 'Naivasha',
                    'province_id' => '1',
                ),
            14 =>
                array (
                    'id' => '15',
                    'name' => 'Nakuru',
                    'province_id' => '1',
                ),
            15 =>
                array (
                    'id' => '16',
                    'name' => 'Nyeri',
                    'province_id' => '1',
                ),
            16 =>
                array (
                    'id' => '17',
                    'name' => 'Kahawa West',
                    'province_id' => '1',
                ),
            17 =>
                array (
                    'id' => '18',
                    'name' => 'Nyanyuki',
                    'province_id' => '1',
                ),
            18 =>
                array (
                    'id' => '19',
                    'name' => 'Maziwa',
                    'province_id' => '1',
                ),
            19 =>
                array (
                    'id' => '20',
                    'name' => 'Riverside',
                    'province_id' => '1',
                ),
            20 =>
                array (
                    'id' => '21',
                    'name' => 'Uthiru',
                    'province_id' => '1',
                )
        ));
    }
}
