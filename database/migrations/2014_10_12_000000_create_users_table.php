<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // crée un champ id de type BIGINTEGER UNSIGNED et AUTOINCREMENT
            $table->string('name', 45);
            $table->string('firstname', 45);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->boolean('admin')->default(false);
            $table->boolean('chefRayon')->default(false);
            $table->rememberToken(); // sécurise les formulaires
            $table->timestamps(); // génère un champ created at (date de création) et un champ updated at (date de dernière modification)
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
