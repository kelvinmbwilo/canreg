<?php

class Patient extends Eloquent {

    protected $table = 'patients';
    protected $guarded = array('id');

    public function source(){
        return $this->hasMany('Source','patient_id','id');
    }
    
    public function tumor(){
        return $this->hasMany('Tumor','patient_id','id');
    }
    
    public function examination(){
        return $this->hasMany('Examination','patient_id','id');
    }
    
     public function followup(){
        return $this->hasMany('Followup','patient_id','id');
    }

    public function hiv(){
        return $this->hasMany('HivStatus','patient_id','id');
    }
    public function treatment(){
        return $this->hasMany('Treatment','patient_id','id');
    }
    public function region(){
        return $this->BelongsTo('Region','id','region');
    }
    public function district(){
        return $this->BelongsTo('District','id','district');
    }
}


