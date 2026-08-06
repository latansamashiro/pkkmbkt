<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventBackHistory
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Cegah browser nyimpen cache halaman
        $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        // Sisipin script pageshow biar force reload kalau halaman
        // muncul dari bfcache (misal gara-gara klik tombol back)
        $content = $response->getContent();

        if (is_string($content) && str_contains($content, '</body>')) {
            $script = <<<'HTML'
               $script = <<<'HTML'
    <script>
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                var url = new URL(window.location.href);
                url.searchParams.set('_ts', Date.now());
                window.location.replace(url.toString());
            }
        });
    </script>
    </body>
    HTML;

            $content = str_replace('</body>', $script, $content);
            $response->setContent($content);
        }

        return $response;
    }
}