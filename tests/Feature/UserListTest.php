<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;

class UserListTest extends TestCase
{
    /** @test */
    function it_paginate_users()
    {
        $first_user = factory(User::class)->create();

        factory(User::class, 14)->create();

        $last_user = factory(User::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get(route('home'));

        $response->assertOk()
                 ->assertViewHas('users', function ($users) use ($first_user, $last_user) {
                     return $users->contains($first_user) and !$users->contains($last_user);
                 });

        $response = $this->get(route('home', [
            'page' => '2'
        ]));

        $response->assertOk()
                 ->assertViewHas('users', function ($users) use ($first_user, $last_user) {
                     return !$users->contains($first_user) and $users->contains($last_user);
                 });
    }

    /** @test */
    function if_user_not_have_posts_not_show_button_to_view_their_posts()
    {
        factory(User::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->get(route('home'))
             ->assertDontSee('Ver Posts');
    }

    /** @test */
    function if_user_have_posts_it_show_button_to_view_their_posts()
    {
        $post_1 = factory(Post::class)->make();

        $post_2 = factory(Post::class)->make();

        $user_1 = factory(User::class)->create();

        $user_1->posts()->saveMany([$post_1, $post_2]);

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->get(route('home'))
             ->assertSee('Ver Posts');
    }
}
