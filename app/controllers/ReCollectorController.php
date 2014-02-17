<?php
use Sunra\PhpSimple\HtmlDomParser;
class ReCollectorController extends BaseController{
	/*
		Este metodo no es definitivo, es la version compactada del colector de datos,
		aun falta hacer la descarga de las imagenes del servidor,
		tambien falta grabar estos datos en la base de datos, 
		te encargo que termines el diseño de la parte del add donde se verian estos datos,
		pero dejame la visualizacion de los mismos a mi, te encargo especial cuidado de este archivo y de panel.add.js
	*/
	public function getProperty(){
		$displacement = 1;
		$gen = 2;
		$url = Input::all();
		$rules = array(
			'har_url'=>'required|url',
 		);
 		$validation = Validator::make($url, $rules);
		if($validation->fails()) 
			return Response::json(array('status_code' => 404)); 
		
		try{
			$asd = HtmlDomParser::file_get_html($url['har_url']);
			if($asd->find('title',0)->plaintext == "We're Sorry, but we couldn't find the page you were looking for." || $asd->find('div[id=body_content]/div/div/table/tr/td/div',0)->plaintext=='An Error Occurred') 
			return Response::json(array('status_code' => 404));
		} catch(ErrorException $e){
			return Response::json(array('status_code' => 400));
		}
		try{
			$smtext = 'tr/td[class=smText]';
			$smTextBold = 'tr/td[class="smTextBold gray"]';
			$property = array('status_code' => 200);
			$property['data']['title'] = $asd->find('div[id=body_content]/div/div/div[class=lgBlue fl]',0)->plaintext;
			$property['data']['permlink'] = url(preg_replace('/[^a-zA-Z0-9\/_|+-]/', '-', Str::lower($property['data']['title'])));
			$property['data']['description'] = $asd->find('div[id=prpDetail]/div/div[class=smText]',0)->plaintext;
			$property['data']['ref_url'] = $url['har_url'];
			$property['data']['price'] = $asd->find('div[id=prpDetail]/div/table/tr/td/div/div/table/tr/td/span',0)->plaintext;
			$table =  $asd->find('div[id=prpDetail]/div/table/tr/td/div/div/table', 0);
			if($table->find('tr/td[class=smText]/strong',0))
				$property['data']['address'] = trim($table->find('tr/td[class=smText]/strong', 0)->plaintext);
			for ($displacement = 1, $gen = 2; $table->find($smTextBold, $gen) && $table->find($smtext, $displacement); $displacement++, $gen++) { ;
				if($table->find($smTextBold, $gen) && $table->find($smTextBold, $gen)->plaintext == 'City ')
					$property['data']['city'] =  trim($table->find($smtext, $displacement)->plaintext);
				if($table->find($smTextBold, $gen) && $table->find($smTextBold, $gen)->plaintext == 'Zip Code:')
					$property['data']['zip'] = trim($table->find($smtext, $displacement)->plaintext);
				if($table->find($smTextBold, $gen) && $table->find($smTextBold, $gen)->plaintext == 'Subdivision:')
					$property['data']['subdivision'] =  trim($table->find($smtext, $displacement)->plaintext);
				if($table->find($smTextBold, $gen) && $table->find($smTextBold, $gen)->plaintext == 'Property Type:')
					$property['data']['property_type'] =  trim($table->find($smtext, $displacement)->plaintext);
				if($table->find($smTextBold, $gen) && $table->find($smTextBold, $gen)->plaintext == 'Status:')
					$property['data']['status'] = trim($table->find($smtext, $displacement)->plaintext);
				if($table->find($smTextBold, $gen) && $table->find($smTextBold, $gen)->plaintext == 'Bedrooms:')
					$property['data']['bedrooms'] =  trim($table->find($smtext, $displacement)->plaintext);
				if($table->find($smTextBold, $gen) && $table->find($smTextBold, $gen)->plaintext == 'Baths:')
					$property['data']['baths'] =  trim($table->find($smtext, $displacement)->plaintext);		
				if($table->find($smTextBold, $gen) && $table->find($smTextBold, $gen)->plaintext == 'Garage:')
					$property['data']['garage'] =  trim($table->find($smtext, $displacement)->plaintext);
				if($table->find($smTextBold, $gen) && $table->find($smTextBold, $gen)->plaintext == 'Stories:')
					$property['data']['stories'] = trim($table->find($smtext, $displacement)->plaintext);
				if($table->find($smTextBold,  $gen) && $table->find($smTextBold, $gen)->plaintext == 'Style:')
					$property['data']['style'] =  trim($table->find($smtext,  $displacement)->plaintext);
				if($table->find($smTextBold, $gen) && $table->find($smTextBold, $gen)->plaintext == 'Year Built:')
					$property['data']['year_built'] =  trim($table->find($smtext, $displacement)->plaintext);
				if($table->find($smTextBold,  $gen) && $table->find($smTextBold, $gen)->plaintext == 'Bldg. Type:')
					$property['data']['building_type']= trim($table->find($smtext,  $displacement)->plaintext);	
				if($table->find($smTextBold,  $gen) && $table->find($smTextBold, $gen)->plaintext == 'Maintenance Fee:')
					$property['data']['maintenance_fee'] =  trim($table->find($smtext,  $displacement)->plaintext);
				if($table->find($smTextBold,  $gen) && $table->find($smTextBold, $gen)->plaintext == 'Mrkt Area:')
					$property['data']['mrkt_area'] =  trim($table->find($smtext,  $displacement)->plaintext);
				if($table->find($smTextBold,  $gen) && $table->find($smTextBold, $gen)->plaintext == 'Key Map® :')
					$property['data']['key_map'] =  trim($table->find($smtext,  $displacement)->plaintext);
				if($table->find($smTextBold,  $gen) && $table->find($smTextBold, $gen)->plaintext == 'MLS# /  Area:')
					$property['data']['mls_area'] =  trim($table->find($smtext,  $displacement)->plaintext);
			}
			
			if($asd->find($smTextBold,  $gen) && $asd->find('tr[id=building_1]/td[class="smTextBold gray"]', 0)->plaintext == 'Building Sqft:')
				$property['data']['building_sqft']['ft'] = trim($asd->find('tr[id=building_1]/td[class=smText]',  0)->plaintext);
			if($asd->find($smTextBold,  $gen) && $asd->find('tr[id=building_2]/td[class="smTextBold gray"]', 0)->plaintext == 'Building Sqft:')
				$property['data']['building_sqft']['m2'] = trim($asd->find('tr[id=building_2]/td[class=smText]',  0)->plaintext);
			if($asd->find($smTextBold,  $gen) && $asd->find('tr[id=lot_1]/td[class="smTextBold gray"]', 0)->plaintext == 'Lotsize:')
				$property['data']['lotsize']['ft'] = trim($asd->find('tr[id=lot_1]/td[class=smText]',  0)->plaintext);
			if($asd->find($smTextBold,  $gen) && $asd->find('tr[id=lot_1]/td[class="smTextBold gray"]', 0)->plaintext == 'Lotsize:')
				$property['data']['lotsize']['m2'] = trim($asd->find('tr[id=lot_2]/td[class=smText]', 0)->plaintext);
			$gen = 0;
			foreach($asd->find('div[class=column2]/table/tr') as $column2){
				//$property['data']['swimming_pool'][]=@$column2->find('td[class="smTextBold gray"]', 0)->plaintext;
				if(@$column2->find('td[class="smTextBold gray"]', 0)->plaintext == 'Private Pool: ')
					$property['data']['swimming_pool'] = $column2->find('td[class=smText]', 0)->plaintext;
				if(@$column2->find('td[class="smTextBold gray"]', 0)->plaintext == 'School District:')
					$property['data']['school']['district'] = trim($column2->find('td[class=smText]', 0)->plaintext);
				if(@$column2->find('td[class="smTextBold gray"]', 0)->plaintext == 'Elementary Sch:')
					$property['data']['school']['elementaryl'] = trim($column2->find('td[class=smText]', 0)->plaintext);
				if(@$column2->find('td[class="smTextBold gray"]', 0)->plaintext == 'Middle Sch:')
					$property['data']['school']['middle'] = trim($column2->find('td[class=smText]', 0)->plaintext);
				if(@$column2->find('td[class="smTextBold gray"]', 0)->plaintext == 'High Sch:')
					$property['data']['school']['high'] = trim($column2->find('td[class=smText]', 0)->plaintext);
				$gen++;
			}		
			
				//Private Pool: 
			
			foreach($asd->find('div[class=slider_item]')as $g){
				$tmp_gallery = array();
				if($g->find('img',0)){
					$tmp_gallery['url'] = $g->find('img',0)->src;
					//if($g->find('span',0))
						//$tmp_gallery['description'] =  $g->find('span',0)->plaintext;
					$property['data']['gallery'][] = $tmp_gallery;
				}else{
					$tmp_gallery['url'] = $g->find('a',0)->href;
					//if($g->find('span',0))
						//$tmp_gallery['description'] =  $g->find('span',0)->plaintext;
					$property['data']['gallery'][] = $tmp_gallery;
				}
			}
		}catch(ErrorException $e){
				return Response::json(array('status_code' => 400));
		}

		return Response::json($property);
	}
	public function parse(){

	}
}