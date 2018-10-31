<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('meldoc_id',15)->nullable();
            $table->string('user_firstname',191)->nullable();
            $table->string('user_lastname',191)->nullable();
            $table->string('user_email',50)->unique();
            $table->string('user_mobile',12)->unique();
            $table->string('user_password',191)->nullable();
            $table->string('user_salutation',15)->nullable();
            $table->enum('user_status',['Inactive','Active'])->default('Inactive');
            $table->string('remember_token',191)->nullable();
            $table->string('user_image',191)->nullable();
            $table->string('user_profileurl',191)->nullable();
           // $table->('');
            //$table->('');
            $table->timestamps();
        });

        // $table->insert(
        //     array(
        //         'user_firstname'=>'admin',
        //         'user_lastname'=>'',
        //         'user_email' => 'admin@meldoc.com',
        //         'user_mobile' => '121231231234',
        //         'user_password' => 'qwerty',
        //         'user_status' => 'Active'
        //     )
        // );
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
