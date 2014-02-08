<?php
class Place extends Eloquent {
	public function images(){
		return $this->hasMany('Image');
	}
	static public function getAll(){
		$art = Place::all();
		$b = array();
		foreach($art->toArray() as $a){
			$a['descripcion_short'] = Str::words($a['descripcion'], 20, '...');
			$a['descripcionEs_short'] = Str::words($a['descripcionEs'], 20, '...');
			$b[] = $a;
		}
		return $b;
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
				$return['data']['descripcion_short'] = Str::words($n1['descripcion'], 50, '...');
				$return['data']['descripcionEs_short'] = Str::words($n1['descripcionEs'], 50, '...');
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