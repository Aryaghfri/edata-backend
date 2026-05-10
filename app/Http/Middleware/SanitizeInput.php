<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class SanitizeInput extends Middleware
{
    /**
     * Field yang tidak akan di-strip_tags (misalnya untuk content HTML).
     */
    protected $except = [
        //'content', 
    ];

    protected function transform($key, $value)
    {
        if (is_string($value) && !in_array($key, $this->except)) {
            return trim(strip_tags($value));
        }

        return $value;
    }

    public function handle($request, \Closure $next)
    {
        $input = $request->all();

        foreach ($input as $key => $value) {
            $input[$key] = $this->transform($key, $value);
        }

        $request->merge($input);

        return $next($request);
    }
}
