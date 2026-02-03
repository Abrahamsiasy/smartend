<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

if (!class_exists('CreateLanguagesTable')) {
    class CreateLanguagesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasTable('languages')) {
                Schema::create('languages', function (Blueprint $table) {
                    $table->id();
                    $table->string('title')->nullable();
                    $table->string('code')->nullable();
                    $table->string('direction')->nullable();
                    $table->string('left')->nullable();
                    $table->string('right')->nullable();
                    $table->string('icon')->nullable();
                    $table->tinyInteger('box_status')->default('1')->nullable();
                    $table->tinyInteger('status')->default('1')->nullable();
                    $table->integer('created_by')->nullable();
                    $table->integer('updated_by')->nullable();
                    $table->timestamps();
                });
            } else {
                // Table exists, add missing columns if they don't exist
                Schema::table('languages', function (Blueprint $table) {
                    if (!Schema::hasColumn('languages', 'title')) {
                        $table->string('title')->nullable()->after('id');
                    }
                    if (!Schema::hasColumn('languages', 'code')) {
                        $table->string('code')->nullable()->after('title');
                    }
                    if (!Schema::hasColumn('languages', 'direction')) {
                        $table->string('direction')->nullable()->after('code');
                    }
                    if (!Schema::hasColumn('languages', 'left')) {
                        $table->string('left')->nullable()->after('direction');
                    }
                    if (!Schema::hasColumn('languages', 'right')) {
                        $table->string('right')->nullable()->after('left');
                    }
                    if (!Schema::hasColumn('languages', 'icon')) {
                        $table->string('icon')->nullable()->after('right');
                    }
                    if (!Schema::hasColumn('languages', 'box_status')) {
                        $table->tinyInteger('box_status')->default('1')->nullable()->after('icon');
                    }
                    if (!Schema::hasColumn('languages', 'status')) {
                        $table->tinyInteger('status')->default('1')->nullable()->after('box_status');
                    }
                    if (!Schema::hasColumn('languages', 'created_by')) {
                        $table->integer('created_by')->nullable()->after('status');
                    }
                    if (!Schema::hasColumn('languages', 'updated_by')) {
                        $table->integer('updated_by')->nullable()->after('created_by');
                    }
                });
            }
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('languages');
        }
    }
}