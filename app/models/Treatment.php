<?php

class Treatment extends Eloquent {

    protected $table = 'treatment';

    protected  $guarded = array('id');
    public function tumor(){
        return $this->belongsTo('Tumor','id','tumor_id');
    }
    
    public function patient(){
        return $this->belongsTo('Patient','id','patient_id');
    }
}
