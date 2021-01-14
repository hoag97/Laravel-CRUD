<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacultyIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->integer('faculty_id')->unsigned();
            $table->foreign('faculty_id')->references('id')->on('facultys')->onDelete('no action')->onUpdate('CASCADE');
        });

        $data = [
            ['name' => 'Nguyễn Đình Hoàng','phone' => '0339656735','email' => 'hoangboo1997@gmail.com','addres' => 'Hà Nội','faculty_id'=> '1'],
            ['name' => 'Nguyễn Đình Đạt','phone' => '0339656736','email' => 'dat23397@gmail.com','addres' => 'Hà Nội','faculty_id'=> '2'],
            ['name' => 'Lưu Hải Nam','phone' => '0339656737','email' => 'happiNam97@gmai.com','addres' => 'Hà Nội','faculty_id'=> '3']
        ];

        DB::table('members')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            //
        });
    }
}
