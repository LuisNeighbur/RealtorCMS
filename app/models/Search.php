<?php
class Search extends Eloquent{
	protected $table='places';
	static public function SearchProperty($term){
		$output = array();
		if(preg_match('/([0-9]+)((\s)?|(\s)+)(cuarto(s)|dormitor(y|ies|io(s)?)|(bed(room|chamber)?)s?)/i', $term, $matches)){
			//campo dormitorios LIKE %$buscar%
			$arr = Place::where('dormitorios', 'like', '%'.$matches[1].'%')->get();
			$output['data'] = $arr->toArray();
			return dd($output);
			return $output; 

		}else if(preg_match("/(([0-9])+)((\s)?|(\s)+)((half)?)((\s)?|(\s)+)(baño|toilet|bath(room)?)s?/i", $term, $matches)){
			//campo banios LIKE %$buscar%
			$arr = Place::where('banios', 'like', '%'.$matches[1].'%')->get();
			$output['data'] = $arr->toArray();
			return dd($output);
			return $output; 

		}else if(preg_match("/((swimming((\s)?|(\s)+))?((pool)(s)?)|piscina(s)?|pileta(s)?)/i", $term, $matches)){
			//buscar en campo piscina = "Yes"
			$arr = Place::where('piscina', 'like', '%Yes%')->get();
			$output['data'] = $arr->toArray();
			return dd($output);
			return $output; 
		}else {
			$arr = Place::where('direccion', 'like', '%'.$term.'%')
                    ->orWhere('area', 'like', '%'.$term.'%')
                    ->orWhere('descripcion', 'like', '%'.$term.'%')
                    ->orWhere('descripcionEs', 'like', '%'.$term.'%')->get();
			$output['data'] = $arr->toArray();
			return dd($output);
			return $output; 
		}
	}
}