<?php

namespace Tests\Feature\Post;

use App\Post;
use App\User;
use Tests\TestCase;

class UpdatePostTest extends TestCase
{
    /** @test */
    function user_can_see_form_for_edit_post()
    {
        $user = factory(User::class)->create();

        $post = factory(Post::class)->create();

        $this->actingAs($user);

        $this->get(route('posts.edit', $post->id))
             ->assertSee('Título')
             ->assertSee('Descripción');
    }

    /** @test */
    function user_can_update_post_and_its_redirected_to_owner_user_posts_route()
    {
        $post = factory(Post::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->from(route('posts.edit', $post->id))
                         ->put(route('posts.update', $post->id), [
                             'title' => 'Otro titulo editado',
                             'body' => 'Otro cuerpo de post totalmente editado'
                         ]);

        $response->assertSessionHas('status', 'Post editado!')
                 ->assertRedirect(route('users.posts', $post->user->id));

        $this->assertDatabaseHas('posts', [
            'title' => 'Otro titulo editado',
            'body' => 'Otro cuerpo de post totalmente editado',
            'user_id' => $post->user->id
        ]);
    }

    /** @test */
    function for_post_update_its_handles_form_validation()
    {
        $post = factory(Post::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->from(route('posts.edit', $post->id))
                         ->put(route('posts.update', $post->id), [
                             'title' => '',
                             'body' => 'Otro cuerpo'
                         ]);

        $response->assertSessionMissing('status')
                 ->assertSessionHasErrors(['title', 'body']);

        $this->assertDatabaseMissing('posts', [
            'title' => '',
            'body' => 'Otro cuerpo',
            'user_id' => $post->user->id,
        ]);
    }
}
