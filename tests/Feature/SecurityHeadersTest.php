<?php

namespace Tests\Feature;

use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    /**
     * Test whether essential cybersecurity HTTP headers are present in the response.
     */
    public function test_cybersecurity_headers_are_present(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);

        // 1. Anti Clickjacking
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');

        // 2. Anti MIME Sniffing
        $response->assertHeader('X-Content-Type-Options', 'nosniff');

        // 3. XSS Filter Protection
        $response->assertHeader('X-XSS-Protection', '1; mode=block');

        // 4. Referrer Policy
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 5. Permissions Policy
        $this->assertTrue($response->headers->has('Permissions-Policy'));

        // 6. Content Security Policy
        $this->assertTrue($response->headers->has('Content-Security-Policy'));
    }
}
