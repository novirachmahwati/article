<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Article;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_article()
    {
        $articleData = [
            'author' => 'John Doe',
            'title' => 'Sample Article',
            'body' => 'This is a sample article body.',
        ];

        $response = $this->postJson('/api/articles', $articleData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('articles', $articleData);
    }

    /** @test */
    public function it_can_get_articles()
    {
        // Create sample articles
        Article::factory()->create([
            'author' => 'John Doe',
            'title' => 'First Article',
            'body' => 'This is the body of the first article.',
        ]);

        Article::factory()->create([
            'author' => 'Jane Doe',
            'title' => 'Second Article',
            'body' => 'This is the body of the second article.',
        ]);

        $response = $this->getJson('/api/articles');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => ['id', 'author', 'title', 'body', 'created_at', 'updated_at'],
                 ]);
    }

    /** @test */
    public function it_can_filter_articles_by_author()
    {
        // Create sample articles
        Article::factory()->create([
            'author' => 'John Doe',
            'title' => 'First Article',
            'body' => 'This is the body of the first article.',
        ]);

        Article::factory()->create([
            'author' => 'Jane Doe',
            'title' => 'Second Article',
            'body' => 'This is the body of the second article.',
        ]);

        $response = $this->getJson('/api/articles?author=John Doe');

        $response->assertStatus(200)
                 ->assertJsonCount(1)
                 ->assertJsonFragment(['author' => 'John Doe']);
    }

    /** @test */
    public function it_can_search_articles_by_query()
    {
        // Create sample articles
        Article::factory()->create([
            'author' => 'John Doe',
            'title' => 'Unique Title',
            'body' => 'This is a unique body.',
        ]);

        Article::factory()->create([
            'author' => 'Jane Doe',
            'title' => 'Another Title',
            'body' => 'This is another article body.',
        ]);

        $response = $this->getJson('/api/articles?query=unique');

        $response->assertStatus(200)
                 ->assertJsonCount(1)
                 ->assertJsonFragment(['title' => 'Unique Title']);
    }
}
