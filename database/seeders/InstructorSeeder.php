<?php

namespace Database\Seeders;

use App\Models\instructor;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        instructor::Create([
            'image'=>'1.jpg',
            'name'=>'samy',
            'spec'=>'programming',
            'email'=>'samy@gmail.com',
            'password'=>'samy'
        ]);

        instructor::Create([
            'image'=>'2.jpg',
            'name'=>'mohamed',
            'spec'=>'english',
            'email'=>'mohamed@gmail.com',
            'password'=>'mohamed'
        ]);

        instructor::Create([
            'image'=>'3.jpg',
            'name'=>'adam',
            'spec'=>'medical',
            'email'=>'adam@gmail.com',
            'password'=>'adam'
        ]);
    }
}
