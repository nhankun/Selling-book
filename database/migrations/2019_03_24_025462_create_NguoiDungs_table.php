<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNguoiDungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->bigIncrements('MaND');
            $table->string('TenND');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('DiaChi');
            $table->string('SDT',15);
            $table->boolean('GioiTinh')->nullable();
            $table->date('NgaySinh')->nullable();
            $table->boolean('active')->default(false);
            $table->unsignedBigInteger('MaLND');
            $table->foreign('MaLND')
                ->references('MaLND')->on('LoaiND')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
