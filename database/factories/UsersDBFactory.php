<?php

namespace Database\Factories;

use App\Models\UsersDB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersDBFactory extends Factory
{

    protected $tablename = 'users_d_b_s';
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UsersDB::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => "",
            'secondname' => "",
            'surname' => ""
        ];
    }

    public function countItems()
    {
        return DB::table($this->tablename)->count();
    }

    public function find($id)
    {
        return DB::table($this->tablename)->find($id);
    }

    public function findById($id,$limit)
    {
        return DB::table($this->tablename)
            ->where("id", ">=", $id)
            ->limit($limit)
            ->get();
    }

    public function findByText($searchtext, $id, $limit)
    {
        return DB::table($this->tablename)
            ->where("id", ">=", $id)
            ->whereRaw('MATCH(`firstname`, `secondname`, `surname`) AGAINST( ? IN BOOLEAN MODE)', ['*'.$searchtext.'*'])
            ->limit($limit)
            ->get();
    }


}
