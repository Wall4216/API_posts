<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    // Подготовка тестовой бд
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }
    // Проверка index
    public function testGetAllPosts()
    {
        $response = $this->get('/api/posts');
        $response->assertStatus(200);
    }

}
