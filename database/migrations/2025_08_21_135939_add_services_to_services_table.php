<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            DB::table('services')->insert([
                [
                    'code' => '746373y',
                    'description' => 'Criação de uma HomePage',
                    'price' => '19.90',
                    'discount' => '0',
                    'category_id' => '1'
                ],
                [
                    'code' => '746372y',
                    'description' => 'Criação de uma Base de Dados',
                    'price' => '10.90',
                    'discount' => '0',
                    'category_id' => '2'
                ]
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            //
        });
    }
};
