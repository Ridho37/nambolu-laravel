<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLogsTable extends Migration
{
    public function up()
    {
        Schema::create('admin_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->text('description')->nullable();
            $table->string('admin_name')->nullable();
            $table->timestamps(); // ← Ini untuk created_at & updated_at
        });
    }


    public function down()
    {
        Schema::dropIfExists('admin_logs');
    }
}
