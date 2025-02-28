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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('cpf_cnpj', 20)->unique();
            $table->string('celular', 100)->nullable();
            $table->integer('permissao')->default(1);
            $table->string('imagem', 50)->nullable();
            $table->string('observacoes', 500)->nullable();
            $table->string('endereco', 100)->nullable();
            $table->string('complemento', 100)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('cep', 9)->nullable();
            $table->string('cidade', 50)->nullable();
            $table->string('uf', 2)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->dateTime('last_login')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('telefones', function (Blueprint $table) {
            $table->id('id')->primary();
            $table->unsignedBigInteger('usuarios_id')->nullable();
            $table->foreign('usuarios_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('contatos_id')->nullable();
            $table->foreign('contatos_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('telefone', 20);
            $table->timestamps();
        });

        Schema::create('contatos', function (Blueprint $table) {
            $table->id('id')->primary();
            $table->unsignedBigInteger('usuarios_id')->nullable();
            $table->foreign('usuarios_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('cpf_cnpj', 20);
            $table->string('celular', 15);
            $table->string('imagem', 50)->nullable();
            $table->string('observacoes', 500)->nullable();
            $table->string('endereco', 100);
            $table->string('complemento', 100)->nullable();
            $table->string('bairro', 50);
            $table->string('cep', 9);
            $table->string('cidade', 50);
            $table->string('uf', 2);
            $table->string('telefone', 20);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
            $table->unique(['cpf_cnpj', 'usuarios_id']);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('telefones');
        Schema::dropIfExists('contatos');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
