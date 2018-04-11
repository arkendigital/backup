<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Exam\Module as ExamModule;

class Category extends Model
{
    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    *
    */
    protected $fillable = [
        "name",
        "slug"
    ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = 'exam_categories';

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    *
    */
    public $timestamps = true;

    /**
    * The attributes that should be cast to carbon instances.
    *
    * @var array
    *
    */
    protected $dates = ['deleted_at'];

    /**
    * Get a list of modules in this category.
    *
    */
    public function getModules()
    {
        return ExamModule::where("category_id", $this->attributes["id"])
            ->orderBy("order")
            ->get();
    }

    public function modules()
    {
        return $this->hasMany(Module::class, 'category_id', 'id');
    }
}
