<?php

class Behavior extends Eloquent {

    protected $table = 'behavior';

    protected  $guarded = array('id');
    
    public function morphology(){
        return $this->belongsTo('Morphology','code','morphology_id');
    }

}

