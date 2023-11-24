<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Создание таблицы Пользователь
        Schema::create('users', function (Blueprint $table) {
            //Атрибуты (Columns)
            $table->id();//PK
            $table->string('name',40);
            $table->string('surname',40);
            $table->string('phone',12);
            $table->string('avatar');
            //Создание временных отметок
            $table->timestamps();
            //Использовение "Мягкого удаления"
            $table->softDeletes();
        });

        //Создание таблицы Компания
        Schema::create('companies', function (Blueprint $table){
            //Атрибуты (Columns)
            $table->id();//PK
            $table->string('title',40);
            $table->string('description',400);
            $table->string('logo');
            //Создание временных отметок
            $table->timestamps();
            //Использовение "Мягкого удаления"
            $table->softDeletes();
        });

        //Создание таблицы Комментарий
        Schema::create('comments', function (Blueprint $table){
            //Атрибуты (Columns)
            $table->id();//PK
            $table->integer('user_id');
            $table->integer('company_id');
            $table->string('content', 550);
            $table->integer('score');
            //Создание временных отметок
            $table->timestamps();
            //Использовение "Мягкого удаления"
            $table->softDeletes();
            //Создание внешних ключей
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('users');
        Schema::dropIfExists('companies');
    }
};
