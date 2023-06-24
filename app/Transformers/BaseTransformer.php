<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

abstract class BaseTransformer extends TransformerAbstract
{
    /**
     * Set the identifier of 
     * the transformer collection.
     * 
     * @return string
     */
    abstract public static function getResourceKey(): string;

    /**
     * @param mixed $data
     * @param callable|\League\Fractal\TransformerAbstract $transformer
     * @param null $resourceKey
     * 
     * @return \League\Fractal\Resource\Collection
     */
    protected function makeCollection($data, $transformer, $resourceKey = null) 
    {
        $transformer = $this->checkTransformer($transformer);
        return parent::collection($data, $transformer, $resourceKey ?: $transformer->getResourceKey());
    }

    /**
     * @param mixed $data
     * @param callable|\League\Fractal\TransformerAbstract $transformer
     * @param null $resourceKey
     * 
     * @return \League\Fractal\Resource\Item
     */
    protected function makeItem($data, $transformer, $resourceKey = null)
    {
        $transformer = $this->checkTransformer($transformer);
        return parent::item($data, $transformer, $resourceKey ?: $transformer->getResourceKey());
    }

    /**
     * Get transformer class
     * 
     * @param mixed $transformer
     * 
     * @return self
     */
    private static function checkTransformer($transformer): self
    {
        if (is_string($transformer)) {
            $transformer = app ($transformer);
        }

        return $transformer;
    }
}