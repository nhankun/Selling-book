<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonHangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donhang', function (Blueprint $table) {
            $table->bigIncrements('MaDH');
            $table->unsignedBigInteger('MaND');
            $table->foreign('MaND')
                ->references('MaND')->on('NguoiDung')
                ->onDelete('cascade');
            $table->unsignedBigInteger('MaNVGH')->nullable();
            $table->foreign('MaNVGH')
                ->references('MaND')->on('NguoiDung')
                ->onDelete('cascade');
            $table->unsignedBigInteger('MaNVK')->nullable();
            $table->foreign('MaNVK')
                ->references('MaND')->on('NguoiDung')
                ->onDelete('cascade');
            $table->unsignedBigInteger('MaQL')->nullable();
            $table->foreign('MaQL')
                ->references('MaND')->on('NguoiDung')
                ->onDelete('cascade');
            $table->unsignedBigInteger('MaQTV')->nullable();
            $table->foreign('MaQTV')
                ->references('MaND')->on('NguoiDung')
                ->onDelete('cascade');
            $table->double('TongTien');
            $table->string('TenKH');
            $table->string('DiaChi');
            $table->string('SDT',15);
            $table->dateTime('NgayDat');
            $table->dateTime('NgayGiao')->nullable()->default(null);
            $table->unsignedBigInteger('MaTT');
            $table->foreign('MaTT')
                ->references('MaTT')->on('TrangThai')
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
        Schema::dropIfExists('don_hangs');
    }
}
