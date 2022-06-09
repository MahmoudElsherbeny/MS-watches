<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name', 'value'];

    //get product main image
    static public function getSettingValue($name) {
        $setting = Self::Where('name',$name)->first();
        if($setting) {
            return $setting->value;
        }
    }
}
