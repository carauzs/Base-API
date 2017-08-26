<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Dingo\Api\Routing\Helpers;

class Controller extends BaseController
{
    use Helpers, AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function success($message = 'success', $status_code = 200, $metadata = null)
    {
        $data = [
            'message' => $message,
            'status_code' => $status_code
        ];
        if ($metadata) {
            $data['meta'] = $metadata;
        }
        return response()->json($data, $status_code);
    }

    protected function item($resource, $transformer, $includes = [], $meta = [])
    {
        return $this->response->item($resource, $transformer, [], function($resource, $fractal) use ($includes) {
            $fractal->parseIncludes($includes);
        })->setMeta($meta);
    }

    protected function collection($resource, $transformer, $includes = [], $meta = [])
    {
        if (!isset($meta['count'])) {
            $meta['count'] = count($resource);
        }
        return $this->response->collection($resource, $transformer, [], function($resource, $fractal) use ($includes) {
            $fractal->parseIncludes($includes);
        })->setMeta($meta);
    }
}
