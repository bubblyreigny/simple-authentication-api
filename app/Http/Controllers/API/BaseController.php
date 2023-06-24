<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Transformers\BaseTransformer;
use League\Fractal\Serializer\JsonApiSerializer;
use Spatie\Fractal\Fractal;

class BaseController extends Controller
{
    /**
     * @param mixed $data
     * @param \App\Transformers\BaseTransformer $transformer
     * @param string $serializer
     * 
     * @return \Spatie\Fractal\Fractal
     */
    protected static function fractal(
        $data,
        BaseTransformer $transformer,
        string $serializer = JsonApiSerializer::class
    ): Fractal {
        return fractal($data, $transformer, $serializer)
            ->withResourceName($transformer->getResourceKey())
            ->addMeta(['include' => $transformer->getAvailableIncludes()]);
    }
}