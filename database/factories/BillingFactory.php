<?php

namespace Database\Factories;

use App\Models\Billing;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Billing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subscription_id' => Subscription::factory(),
            'period' => $this->faker->date($format = 'Y-m-d', $max = now()),
            'state' => $this->faker->randomElement(['pending', 'paid', 'expired']),
            'amount' => $this->faker->randomDigitNotNull
        ];
    }
}
