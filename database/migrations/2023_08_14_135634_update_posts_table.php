<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // creare la colonna della chiave esterna
            $table->unsignedBigInteger('tag_id')->after('id');

            // definire la colonna come chiave esterna
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // eliminare la chiave esterna
            $table->dropForeign('posts_tag_id_foreign');

            // eliminare la colonna
            $table->dropColumn('tag_id');
        });
    }
};
