<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StrictFileUploads
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $dangerousExtensions = ['php', 'php3', 'php4', 'php5', 'phtml', 'exe', 'sh', 'bat', 'cmd', 'ps1', 'vbs', 'jar', 'jsp', 'pl', 'py', 'cgi'];

        foreach ($request->allFiles() as $fileOrArray) {
            $files = is_array($fileOrArray) ? $fileOrArray : [$fileOrArray];
            foreach ($files as $file) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $extension = strtolower($file->getClientOriginalExtension());
                    if (in_array($extension, $dangerousExtensions)) {
                        abort(403, 'Tipe file yang diunggah dilarang oleh administrator keamanan.');
                    }
                }
            }
        }

        return $next($request);
    }
}
