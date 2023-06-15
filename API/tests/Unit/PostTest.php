<?php

namespace Tests\Unit;

    use Tests\TestCase;
    use App\Models\Post;

class PostTest extends TestCase
{
    public function testPostCreation()
    {
        $post = new Post();
        $post->title = 'Test Post';
        $post->content = 'This is a test post';
        $post->save();

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'content' => 'This is a test post',
        ]);
    }

    public function testPostUpdate()
    {
        $post = new Post();
        $post->title = 'Test Post';
        $post->content = 'This is a test post';
        $post->save();

        $post->title = 'Updated Post';
        $post->content = 'This post has been updated';
        $post->save();

        $this->assertDatabaseHas('posts', [
            'title' => 'Updated Post',
            'content' => 'This post has been updated',
        ]);
    }

    public function testPostDeletion()
    {
        $post = new Post();
        $post->title = 'Test Post';
        $post->content = 'This is a test post';
        $post->save();

        $post->delete();

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }


}
