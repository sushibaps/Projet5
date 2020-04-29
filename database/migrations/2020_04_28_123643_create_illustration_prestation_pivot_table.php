<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIllustrationPrestationPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('illustration_prestation', function (Blueprint $table) {
            $table->bigInteger('illustration_id')->unsigned()->index();
            $table->foreign('illustration_id')->references('id')->on('illustrations')->onDelete('cascade');
            $table->bigInteger('prestation_id')->unsigned()->index();
            $table->foreign('prestation_id')->references('id')->on('prestations')->onDelete('cascade');
            $table->primary(['illustration_id', 'prestation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('illustration_prestation');
    }
}
