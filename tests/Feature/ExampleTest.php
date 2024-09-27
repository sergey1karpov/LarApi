<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Interfaces\TicketSellerInterface;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function it_can_get_events()
    {
        $mockedApiResponse = [
            'response' => [
                ['id' => 1, 'name' => 'Show #1'],
                ['id' => 2, 'name' => 'Show #2'],
            ]
        ];

        Http::fake([
            'https://leadbook.ru/test-task-api/shows' => Http::response($mockedApiResponse, 200)
        ]);

        $response = $this->getJson(route('getEvents'));

        $response->assertStatus(200)
            ->assertJson($mockedApiResponse);
    }
}
