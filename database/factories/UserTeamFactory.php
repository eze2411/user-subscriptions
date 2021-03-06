<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Team;
use App\Models\UserTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserTeam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'team_id' => Team::factory(),
        ];
    }
}
