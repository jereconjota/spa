<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Comment;
use App\User;
use App\Article;
use Illuminate\Support\Str;

class ArticleTest extends TestCase
{
    use RefreshDataBase;
    
    public function setUp(): void{
        parent::setUp();
        $this->user= factory(User::class)->create();
        $this->article= factory(Article::class)->create();
        //Autenticamos el usuario para que no nos de error cuando testeamos
        $this->actingAs($this->user);
    }

    /** @test */ 
    public function it_shows_a_collection_of_articles(){
        $this->json('GET', "/api/articles?api_token={$this->user->api_token}")
            ->assertStatus(200)
            ->assertJson([
                'data' => [[
                    'id' => $this->article->id,
                    'attributes' => [
                        'title' => $this->article->title,
                        'description' => $this->article->content,
                        'picture' => $this->article->thumbnail,
                        'created_at' => $this->article->created_at->diffForHumans()
                    ]
                ]]
            ]);
    }

    /** @test */ 
    public function it_shows_an_articles(){
        $this->json('GET', "/api/articles/{$this->article->slug}?api_token={$this->user->api_token}")
            ->assertStatus(200)
            ->assertJson([
                    'id' => $this->article->id,
                    'attributes' => [
                        'title' => $this->article->title,
                        'description' => $this->article->content,
                        'picture' => $this->article->thumbnail,
                        'created_at' => $this->article->created_at->diffForHumans()
                    ]   
            ]);
    }


    /** @test */ 
    public function it_creates_a_single_articles(){
        // $this->withoutExceptionHandling();
        $this->assertEquals(1,Article::count());
        $data = [
            'title' => 'lorem insu dolor',
            'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit',
            'thumbnail' => 'https://picsum.photos/250/500',
            'api_token' => $this->user->api_token,
        ];
        $this->json('POST',"/api/articles", $data)
            ->assertStatus(201);
        
        $this->assertEquals(2,Article::count());

    }

    /** @test */ 
    public function the_owner_can_delete_the_article_fails(){
        $user = factory(User::class)->create();
        $this->json('DELETE',"/api/articles/{$this->article->slug}",['api_token' => $user->api_token]) 
            ->assertStatus(403);

    }
    
    /** @test */ 
    // public function it_deletes_an_articles(){
        
    //     $this->json('DELETE',"/api/articles/{$this->article->slug}",['api_token' => $this->user->api_token])
    //         ->assertStatus(204);

    //     $this->assertNull(Article::find($this->article->slug));

    // }

}