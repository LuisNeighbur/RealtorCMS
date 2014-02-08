<?php
class Image extends Eloquent {
    public function place(){
        return $this->belongsTo('Place');
    }

}