<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('free_trial_remaining')->default(10)->after('tokens');
        });

        if (Schema::hasColumn('users', 'free_trial_used')) {
            DB::table('users')->where('free_trial_used', true)->update(['free_trial_remaining' => 0]);

            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('free_trial_used');
            });
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('free_trial_used')->default(false)->after('tokens');
        });

        DB::table('users')->where('free_trial_remaining', '<=', 0)->update(['free_trial_used' => true]);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('free_trial_remaining');
        });
    }
};
