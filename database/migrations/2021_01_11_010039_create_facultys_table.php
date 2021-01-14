<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facultys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->unique();
            $table->tinyInteger('status')->default(1);
            $table->timestamp('created_at')->useCurrent();
        });

        $data = [
            ['title'=>'Công nghệ thông tin'],
            ['title'=>'Ngôn ngữ Anh'],
            ['title'=>'Công nghệ sinh học'] 
        ];

        DB::table('facultys')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty');
    }
}
