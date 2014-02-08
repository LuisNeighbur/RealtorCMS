<?php
class Search extends Eloquent{
	protected $table='places';
	public function Search($term){
		if ((strrpos($terms,'dormitory') >= 0) || (strrpos($terms,'bedroom') >= 0) || (strrpos($terms,'bedrooms') >= 0) || (strrpos($terms,'dormitories') >= 0)){
			$buscar = str_replace('bedrooms', '', $terms);
			$buscar = str_replace('bedroom', '', $buscar);
			$buscar = str_replace('dormitory', '', $buscar);
			$buscar = str_replace('dormitories', '', $buscar);
			$buscar = str_replace('  ', ' ', $buscar);
			$buscar = trim($buscar);
			//campo dormitorios LIKE %$buscar%
			$arr = self::where('dormitorios', 'like', '%'+$buscar+'%')->toArray();
			return $arr;

		}else if ((strrpos($terms,'bath') >= 0) || (strrpos($terms,'bathroom') >= 0) || (strrpos($terms,'bathrooms') >= 0) || (strrpos($terms,'toilet') >= 0) || (strrpos($terms,'toilets') >= 0)){
			$buscar = str_replace('bath', '', $terms);
			$buscar = str_replace('bathroom', '', $buscar);
			$buscar = str_replace('bathrooms', '', $buscar);
			$buscar = str_replace('toilet', '', $buscar);
			$buscar = str_replace('toilets', '', $buscar);
			$buscar = str_replace('  ', ' ', $buscar);
			$buscar = trim($buscar);
			//campo banios LIKE %$buscar%
			$arr = self::where('banios', 'like', '%'+$buscar+'%')->toArray();
			return $arr;
		}else if ((strrpos($terms,'pool') >= 0) || (strrpos($terms,'swimming pool') >= 0) || (strrpos($terms,'swimmingpool') >= 0)){
			//buscar en campo piscina = "Yes"
			$arr = self::where('piscina', 'like', '%Yes%')->toArray();
			return $arr;
		}else {

		}
	}
}