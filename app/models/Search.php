<?php
class Search extends Eloquent{
	protected $table='places';
	static public function SearchProperty($term){
		if(preg_match('/([0-9]+)((\s)?|(\s)+)(cuarto(s)|dormitor(y|ies|io(s)?)|(bed(room|chamber)?)s?)/i', $term, $matches)){
			//campo dormitorios LIKE %$buscar%
			$arr = self::where('dormitorios', 'like', '%'.$matches[1].'%');
			return $arr->toArray();

		}else if(preg_match("/(([0-9])+)((\s)?|(\s)+)((half)?)((\s)?|(\s)+)(baño|toilet|bath(room)?)s?/i", $term, $matches)){
			//campo banios LIKE %$buscar%
			$arr = self::where('banios', 'like', '%'.$matches[1].'%');
			return $arr->toArray();

		}else if(preg_match("/((swimming((\s)?|(\s)+))?((pool)(s)?)|piscina(s)?|pileta(s)?)/i", $term, $matches)){
			//buscar en campo piscina = "Yes"
			$arr = self::where('piscina', 'like', '%Yes%');
			return $arr->toArray();

		}else {
			$arr = self::where('direccion', 'like', '%'.$term.'%')
                    ->orWhere('area', 'like', '%'.$term.'%')
                    ->orWhere('descripcion', 'like', '%'.$term.'%')
                    ->orWhere('descripcionEs', 'like', '%'.$term.'%');
			return $arr->toArray();
		}
	}
}