<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            // $table->integer('category_id')
            //     ->after('category')
            //     ->unsigned()
            //     ->default(1);
            // $table->foreign('category_id')
            //     ->references('id')->on('categories')
            //     ->onDelete('resrict');
            $table->integer('category_id')->after('category')->unsigned()->default(1);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropForeign('restaurants_category_id_foreign'); //外部キー制約の削除
            $table->dropColumn('category_id'); //カラム削除
        });
    }
}
