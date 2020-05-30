<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('email');
            $table->string('role')->nullable()->after('username');
            $table->boolean('status')->nullable()->default(0)->after('role')->comment('0=inactive , 1=active');
            $table->integer('created_by')->nullable()->after('status');
            $table->string('extra_field_1')->nullable()->after('created_by');
            $table->string('extra_field_2')->nullable()->after('extra_field_1');
            $table->string('extra_field_3')->nullable()->after('extra_field_2');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('role');
            $table->dropColumn('status');
            $table->dropColumn('extra_field_1');
            $table->dropColumn('extra_field_2');
            $table->dropColumn('extra_field_3');
        });
    }
}
