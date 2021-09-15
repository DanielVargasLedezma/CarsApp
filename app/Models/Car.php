<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'founded', 'description'];

    protected $hidden = ['created_at', 'edited_at'];

    protected  $visible = ['name', 'founded', 'description', 'id'];

    public  function carModels()
    {
        return $this->hasMany(CarModel::class);
    }

    public function engines()
    {
        return $this->hasManyThrough(
            Engine::class, 
            CarModel::class,
            'car_id',
            'model_id'
        );
    }

    public function productionDate()
    {
        return $this->hasOneThrough(
            CarProductionDate::class,
            CarModel::class,
            'car_id',
            'model_id'
        );
    }
}
