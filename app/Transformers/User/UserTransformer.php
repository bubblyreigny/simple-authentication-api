<?php 

namespace App\Transformers\User;

use App\Models\User;
use App\Transformers\BaseTransformer;

class UserTransformer extends BaseTransformer
{
    /**
     * Set relation or data that can be 
     * optionally included in the response.
     * 
     * @var array
     */
    protected array $availableIncludes = [
        // 
    ];

    /**
     * Set relation or data that is 
     * automatically included in the response.
     *  
     * @var array
     */
    protected array $defaultIncludes = [

    ];

    /**
     * Set the identifier of 
     * the transformer collection.
     * 
     * @return string
     */
    public static function getResourceKey(): string
    {
        return 'users';
    }

    /**
     * Transform data into JSON API format.
     * 
     * @param User $user
     * 
     * @return array
     */
    public function transform(User $user): array
    {
        return array_merge(
            $user->toArray(),
            [
                
            ]
        );
    }
}