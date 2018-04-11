<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Exam\Category as ExamCategory;
use App\Models\Exam\Info as ExamModuleInfo;
use App\Models\Survey;

class Module extends Model
{
    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    *
    */
    protected $fillable = [
        "category_id",
        "name",
        "slug",
        "excerpt",
        "description",
        "order"
    ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = 'exam_modules';

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
    * A module has a category.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    *
    */
    public function category()
    {
        return $this->hasOne(ExamCategory::class, 'id', 'category_id');
    }

    /**
    * A module has some information.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    *
    */
    public function info()
    {
        return $this->hasOne(ExamModuleInfo::class, 'module_id', 'id');
    }

    public function getSurveyResult($module_id, $difficulty)
    {
        return Survey::where("module_id", $module_id)
            ->where("difficulty", $difficulty)
            ->count();
    }

    public function getSurveyTotal($module_id)
    {
        return Survey::where("module_id", $module_id)
            ->count();
    }

    public function getSurveyPercentage($result, $total)
    {
        if ($total != 0) {
            return number_format($result/$total*100, 2)."%";
        } else {
            return "N/A";
        }
    }
}
