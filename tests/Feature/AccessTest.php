<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;

class AccessTest extends TestCase
{
    /** @test */
    function it_shows_welcome_message_to_guest_users()
    {
        $this->get('/')
             ->assertOk()
             ->assertSee('Iniciar');
    }

    /** @test */
    function guest_user_cannot_access_to_users_list()
    {
        $this->get(route('home'))
             ->assertRedirect(route('login'));
    }

    /** @test */
    function guest_user_cannot_access_to_user_posts()
    {
        $user = factory(User::class)->create();

        $this->get(route('users.posts', $user->id))
             ->assertRedirect(route('login'));
    }

    /** @test */
    function guest_cannot_see_create_post_form()
    {
        $this->get(route('posts.create'))
             ->assertRedirect(route('login'));
    }

    /** @test */
    function guest_cannot_see_edit_post_form()
    {
        $post = factory(Post::class)->create();

        $this->get(route('posts.edit', $post->id))
             ->assertRedirect(route('login'));
    }

    /** @test */
    function registered_user_can_access_to_users_list()
    {
        $user_1 = factory(User::class)->create();

        $user_2 = factory(User::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->get(route('home'))
             ->assertOk()
             ->assertViewHas('users', function ($users) use ($user_1, $user_2) {
                 return $users->contains($user_1) and $users->contains($user_2);
             });

    }

    /** @test */
    function registered_user_can_access_to_user_posts()
    {
        $post_1 = factory(Post::class)->make();

        $post_2 = factory(Post::class)->make();

        $user_1 = factory(User::class)->create();

        $user_1->posts()->saveMany([$post_1, $post_2]);

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->get(route('users.posts', $user_1->id))
             ->assertOk()
             ->assertViewHas('posts', function ($posts) use ($post_1, $post_2) {
                 return $posts->contains($post_1) and $posts->contains($post_2);
             });
    }
}
