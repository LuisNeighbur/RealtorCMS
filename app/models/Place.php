<?php
class Place extends Eloquent {
	public function images(){
		return $this->hasMany('Image');
	}
	public function delete(){
		$this->deleted_at = date('Y-m-d H:i:s');
		$this->save();
	}
	static public function getWithImages($id){
		$return = array('status_code' => 200);
		try{
			$n1 = Place::find($id);
			$n2 = Place::find($id)->images;
			if($n1 && $n2){
				$return['data'] = $n1->toArray();
				$return['data']['imgs'] = $n2->toArray();
			}else{
				$return['status_code'] = 404;
			}	
		}catch(ErrorException  $e){
			$return = array('status_code' => 404);
		}
		return $return;
	}
}