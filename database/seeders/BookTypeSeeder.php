<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BookType;

class BookTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Fiction', 'Non-Fiction', 'Science', 'History', 'Biography', 'Fantasy'];

        foreach ($types as $type) {
            BookType::create(['name' => $type]);
        }
    }
}
