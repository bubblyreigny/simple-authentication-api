<?php 

declare(strict_types=1);

namespace App\DataTransferObjects;

class UserData
{
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly string $username,
        public readonly string $address,
        public readonly string $password,
        public readonly string $postcode
    ) {

    }
}