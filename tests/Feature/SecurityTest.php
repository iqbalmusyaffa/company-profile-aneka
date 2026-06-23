<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class SecurityTest extends TestCase
{
    public function test_security_headers_are_present(): void
    {
        $response = $this->get('/');

        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('X-XSS-Protection', '1; mode=block');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
    }

    public function test_strict_file_uploads_blocks_php(): void
    {
        $file = UploadedFile::fake()->create('virus.php', 100);

        // Send a request to an endpoint with the fake php file
        $response = $this->post('/admin/products', [
            'images' => [$file]
        ]);

        $response->assertStatus(403);
    }
}
