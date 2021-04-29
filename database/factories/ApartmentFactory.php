<?php

namespace Database\Factories;

use App\Models\Apartment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

class ApartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Apartment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    private array $categories;

    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);
        $this->categories = Category::all()->pluck('id')->toArray();
    }

    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'category_id' => $this->faker->randomElement($this->categories),
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'quantity' => rand(0, 150)
        ];
    }
}
