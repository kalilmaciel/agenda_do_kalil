<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KalilTest extends TestCase
{
    //Necessário para zerar o banco a cada teste efetuado
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_a_pagina_inicial_nao_acessa_sem_logar(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_a_tela_de_login_pode_ser_acessada()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_os_usuarios_podem_se_logar_na_tela_de_login()
    {
        $user = User::create([
            'name' => 'Chico da Silva',
            'email' => 'chico@dasilva.com',
            'password' => 'chicodasilva',
            'cpf_cnpj' => '412.381.670-39',
            'imagem' => ''
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'chicodasilva',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('home');
    }

    public function test_os_usuarios_nao_podem_acessar_com_senha_errada()
    {
        $this->user = User::create([
            'name' => 'Chica da Silva',
            'email' => 'chica@dasilva.com',
            'password' => 'chicadasilva',
            'cpf_cnpj' => '370.254.710-03',
            'imagem' => ''
        ]);

        $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'blablabla',
        ]);

        $this->assertGuest();
    }
}
