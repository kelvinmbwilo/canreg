<?php

class Examination extends Eloquent {

    protected $table = 'examination';

    protected  $guarded = array('id');
    public function patient(){
        return $this->belongsTo('Patient','id','patient_id');
    }
}