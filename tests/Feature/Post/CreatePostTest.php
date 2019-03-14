<?php

namespace Tests\Feature\Post;

use App\User;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    /** @test */
    function user_can_see_form_for_create_post()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->get(route('posts.create'))
             ->assertSee('Título')
             ->assertSee('Descripción');
    }

    /** @test */
    function user_can_create_post_and_its_redirected_to_user_posts()
    {
        $user = factory(User::class)->create();

        $this->assertSame(0, $user->posts()->count());

        $this->actingAs($user);

        $response = $this->from(route('posts.create'))
                         ->post(route('posts.store', [
                             'title' => 'Un titulo',
                             'body' => 'Un cuerpo de post de mas de 20 caracteres',
                         ]));

        $response->assertSessionHas('status', 'Post creado!')
                 ->assertRedirect(route('users.posts', $user->id));

        $this->assertDatabaseHas('posts', [
            'title' => 'Un titulo',
            'body' => 'Un cuerpo de post de mas de 20 caracteres',
            'user_id' => $user->id,
        ]);

        $this->assertSame(1, $user->posts()->count());
    }

    /** @test */
    function the_body_of_post_must_have_at_least_20_chars()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->from(route('posts.create'))
                         ->post(route('posts.store', [
                             'title' => 'Un titulo',
                             'body' => 'Un cuerpo',
                         ]));

        $response->assertSessionMissing('status')
                 ->assertSessionHasErrors(['body']);

        $this->assertDatabaseMissing('posts', [
            'title' => 'Un titulo',
            'body' => 'Un cuerpo',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    function for_post_create_its_handles_form_validation()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->from(route('posts.create'))
                         ->post(route('posts.store', [
                             'title' => '',
                             'body' => '',
                         ]));

        $response->assertSessionMissing('status')
                 ->assertSessionHasErrors(['title', 'body']);

        $this->assertDatabaseMissing('posts', [
            'title' => '',
            'body' => '',
            'user_id' => $user->id,
        ]);
    }
}
