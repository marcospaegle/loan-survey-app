<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->timestamps();
        });

        Schema::create('rule_section', function (Blueprint $table) {
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('rule_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rules');
        Schema::dropIfExists('rule_section');
    }
}
