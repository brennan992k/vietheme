<?php

namespace Modules\Systemsetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Systemsetting\Entities\InfixDateFormat;
// use Modules\Systemsetting\Entities\InfixGeneralSetting;

class InfixGeneralSetting extends Model
{
    protected $table = 'infix_general_settings';
    protected $primaryKey = 'id';
    protected $fillable = [];
    
    public static function DateConvater($input_date)
    {
        $generalSetting = InfixGeneralSetting::find(1);
        $system_date_foramt = InfixDateFormat::find($generalSetting->date_format_id);
        $DATE_FORMAT =  $system_date_foramt->format;
        echo date_format(date_create($input_date), $DATE_FORMAT);
    }
}
