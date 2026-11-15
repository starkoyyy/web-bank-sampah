<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request and attach cybersecurity HTTP headers.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // 1. Anti-Clickjacking: Mencegah halaman disematkan dalam <iframe> oleh website pihak ketiga
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // 2. Anti MIME-Sniffing: Memaksa browser mematuhi Content-Type yang dideklarasikan
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // 3. XSS Protection: Mengaktifkan filter XSS bawaan browser legacy
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // 4. Referrer Policy: Melindungi privasi URL referer saat berpindah domain
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 5. Permissions Policy: Menonaktifkan akses sensor & hardware sensitif yang tidak dibutuhkan
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), browsing-topics=()');

        // 6. Content Security Policy (CSP): Membatasi sumber skrip, gaya, dan aset eksternal
        // Dikonfigurasi agar tetap mendukung Bootstrap, SweetAlert2, Chart.js, dan Google Fonts
        $csp = "default-src 'self'; "
             . "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net; "
             . "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com; "
             . "font-src 'self' https://cdn.jsdelivr.net https://fonts.gstatic.com data:; "
             . "img-src 'self' data: https:; "
             . "connect-src 'self'; "
             . "frame-ancestors 'self'; "
             . "form-action 'self';";
        $response->headers->set('Content-Security-Policy', $csp);

        // 7. HSTS (HTTP Strict Transport Security): Hanya aktif saat koneksi HTTPS
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }
}
