<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoPrestationPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_prestation', function (Blueprint $table) {
            $table->bigInteger('photo_id')->unsigned()->index();
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
            $table->bigInteger('prestation_id')->unsigned()->index();
            $table->foreign('prestation_id')->references('id')->on('prestations')->onDelete('cascade');
            $table->primary(['photo_id', 'prestation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_prestation');
    }
}
