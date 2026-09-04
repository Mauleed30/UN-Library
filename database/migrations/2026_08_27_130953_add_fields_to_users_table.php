<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('student_id')->nullable()->after('role_id');
            $table->string('staff_id')->nullable()->after('student_id');
            $table->string('department')->nullable()->after('staff_id');
            $table->string('year_of_study')->nullable()->after('department');
            $table->string('title')->nullable()->after('year_of_study');
            $table->string('section')->nullable()->after('title');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['student_id', 'staff_id', 'department', 'year_of_study', 'title', 'section']);
        });
    }
};