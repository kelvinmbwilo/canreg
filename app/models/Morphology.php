<?php


class Morphology extends Eloquent {

    protected $table = 'morphology';

    protected  $guarded = array('id');
    
     public function behavior(){
            return $this->hasMany('Behavior','morphology_id','code');
        }

}

