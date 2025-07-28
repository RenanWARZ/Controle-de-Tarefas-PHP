<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedSetorsTable extends Migration
{
    public function up()
    {
        DB::table('setors')->insert([
            ['nome' => 'RH'],
            ['nome' => 'TI'],
            ['nome' => 'FINANCEIRO'],
            ['nome' => 'MARKETING'],
            ['nome' => 'VENDAS'],
        ]);
    }

    public function down()
    {
        DB::table('setors')->whereIn('nome', ['RH', 'TI', 'FINANCEIRO', 'MARKETING', 'VENDAS'])->delete();
    }
}
