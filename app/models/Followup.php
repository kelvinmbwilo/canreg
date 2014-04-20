<?php

class Followup extends Eloquent {

    protected $table = 'followup';

    protected  $guarded = array('id');
    public function patient(){
        return $this->belongsTo('Patient','id','patient_id');
    }

}

