<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'number' => 'ORD-'.fake()->unique()->numerify('######'),
            'status' => fake()->randomElement(OrderStatus::cases()),
            'total' => fake()->randomFloat(2, 10, 2000),
            'shipping_address' => fake()->address(),
            'notes' => fake()->paragraphs(3, true),
            'meta' => [
                'items' => fake()->numberBetween(1, 8),
                'channel' => fake()->randomElement(['web', 'app', 'phone']),
                'coupon' => fake()->optional()->bothify('SAVE-##??'),
                'gift_message' => fake()->optional()->sentence(),
            ],
        ];
    }

    public function paid(): static
    {
        return $this->state(fn (): array => ['status' => OrderStatus::Paid]);
    }
}
