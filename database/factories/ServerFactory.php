<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Server>
 */
class ServerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->sentence(3),
            'slug' => str($name.'-'.Str::random(6))->slug(),
            'domain' => $this->faker->domainName(),
            'host' => $this->faker->ipv4(),
            'username' => $this->faker->userName(),
            'password' => $this->faker->password(),
            'port' => $this->faker->randomDigit(),
        ];
    }
}
