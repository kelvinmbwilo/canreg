<?php

class Tumor extends Eloquent {

    protected $table = 'tumor';

    protected  $guarded = array('id');
    public function source(){
        return $this->hasMany('Source','tumor_id','id');
    }
    
    public function patient(){
        return $this->belongsTo('Patient','id','patient_id');
    }

    public function hiv(){
        return $this->hasMany('HivStatus','tumor_id','id');
    }
}

