<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Post;

class PostTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function testGetAllPosts()
    {
        $response = $this->get('/api/posts');
        $response->assertStatus(200);
    }

    public function testGetPostById()
    {
        $post = Post::factory()->create();

        $response = $this->get('/api/posts/' . $post->id);
        $response->assertStatus(200);
    }

    public function testGetNonExistingPost()
    {
        $response = $this->get('/api/posts/999');
        $response->assertStatus(404);
    }

    public function testCreatePost()
    {
        $data = [
            'title' => 'Test Post',
            'content' => 'This is a test post',
        ];

        $response = $this->post('/api/posts', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', $data);
    }

    public function testUpdatePost()
    {
        $post = Post::factory()->create();

        $data = [
            'title' => 'Updated Post',
            'content' => 'This post has been updated',
        ];

        $response = $this->put('/api/posts/' . $post->id, $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', $data);
    }

    public function testDeletePost()
    {
        $post = Post::factory()->create();

        $response = $this->delete('/api/posts/' . $post->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
