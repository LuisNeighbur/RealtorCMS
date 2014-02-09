<?php
class Place extends Eloquent {
	public function images(){
		return $this->hasMany('Image');
	}
	static public function getAll(){
		$art = Place::all();
		$b = array();
		foreach($art->toArray() as $a){
			/*
				Recorremos el array con todas las propiedades, y agregamos una descripcion de 30 palabras
				en base a la descripcion original y almacenamos todos los registros en un nuevo array
			*/
			$a['descripcion_short'] = Str::words($a['descripcion'], 30, '...');
			$a['descripcionEs_short'] = Str::words($a['descripcionEs'], 30, '...');
			$b[] = $a;
		}
		return $b;
	}
	public function delete(){
		/*SoftDelete actualiza la fecha de borrado del objeto y lo guarda*/
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
				$return['data']['descripcion_short'] = Str::words($n1['descripcion'], 30, '...');
				$return['data']['descripcionEs_short'] = Str::words($n1['descripcionEs'], 30, '...');
				$return['data']['imgs'] = $n2->toArray();
			}else{
				$return['status_code'] = 404;
			}	
		}catch(ErrorException  $e){
			$return['status_code'] = 404;
		}
		return $return;
	}
}