<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $minCreditTerm = 3*30*24*60*60;

        return [
            'dealer_name' => $this->faker->company,
            'dealer_contact_name' => $this->faker->name,
            'credit_amount' => $this->faker->randomFloat(
                8,
                0.01,
                99999999.99
            ),
            'credit_term' => rand($minCreditTerm, 2147483647),
            'loan_interest_rate' => $this->faker->randomFloat(
                8,
                0.00000001,
                99999999.99999999
            ),
            'loan_motivation' => $this->faker->text(rand(1000, 65535)),
            'status' => rand(0,3),
            'bank_id' => rand(1,1000),
        ];
    }
}
