
<?php
class Search extends Eloquent{
	static public function SearchProperty($term){
		$Search = array();
		$patronBed ="/(([0-9]+)((\s)?|(\s)+)(cuarto(s)?|dormitor(y|ies|io(s)?)|(bed(room|chamber)?)(s)?)?((\s)?|(\s)+)(o(r)?)?((\s)?|(\s)+))*([0-9]+)((\s)?|(\s)+)(cuarto(s)?|dormitor(y|ies|io(s)?)|(bed(room|chamber)?)s?)/i";
		$patronBath="/((([0-9])+)(\s)*(((half|full)?)(\s)*((ba(n|ñ)o|to(ilet|cador(e)?)|bath(room)?)s?)?)(\s)*(o(r)?)?(\s)*)*(([0-9])+)(\s)*((half|full)?)(\s)*((ba(n|ñ)o|to(ilet|cador(e)?)|bath(room)?)s?)/i";// echo our string
		$patronPool="/((swimming((\s)?|(\s)+))?((pool)(s)?)|piscina(s)?|pileta(s)?)/i";
		$result = array(
		'bath' => null,
		'bed' => null,
		'pool' => false
			);

		if (preg_match_all($patronBath,$term , $matches)){
			$result['bath'] = self::GetIntFromStr($matches[0]);
			$Search['data'] = Place::where('banios', 'like', "%{$result['bath'][0]}%")->get()->toArray();
		}
		if (preg_match_all($patronBed,$term , $matches)){
			$result['bed'] = self::GetIntFromStr($matches[0]);
			$Search['data'] = Place::where('dormitorios', 'like', "%{$result['bed'][0]}%")->get()->toArray();
		}
		$result['pool'] = preg_match($patronPool,$term) ? 'Yes' : false;//'No';
		if($result['pool']=='Yes'){
			$Search['data']  = Place::where('piscina', 'like', "%{$result['pool'][0]}%")->get()->toArray();
		}
				
		if( ($result['bed'] == null)  && ($result['pool'] == false) && ($result['bath'] == null) ){
			$arr = Place::where('direccion', 'like', "%{$term}%")
                    ->orWhere('area', 'like', "%{$term}%")
                    ->orWhere('descripcion', 'like', "%{$term}%")
                    ->orWhere('descripcionEs', 'like', "%{$term}%")->get();
			$Search['data'] = $arr->toArray();
		}

		return $Search;
	}

	static private function GetIntFromStr($data){
		$arr = array();
		$agroup = false;
		$ac = "";
		foreach ($data as $d){
			for($i =0;$i<strlen($d);$i++){
				$val = $d[$i];
				if(is_numeric($val)){
					if($agroup==false){ $agroup = true;	}
					$ac = $ac . $val;
				}else{
					if($agroup==true){
						$agroup=false;
						$arr[]=$ac;
					}
					$ac="";
				}
			}
		}
		return $arr;
	}
}