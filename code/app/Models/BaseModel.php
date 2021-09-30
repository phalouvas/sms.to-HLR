<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Default connection of the model
     * 
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     * 
     * @var string
     */
    protected $connection = 'mysql';
}
