<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professionals', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->string('social_reason', 100);
            $table->string('company_name', 100);
            $table->string('siret', 100);
            $table->string('tva_intracommunity');
            $table->boolean('is_accepted')->default(false);
            $table->boolean('is_denied')->default(false);
            $table->boolean('is_requested')->default(false);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professionals');
    }
}
