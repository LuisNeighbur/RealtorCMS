<?php

class PanelController extends BaseController {
	protected $layout = 'panel.master';
	public function login(){
		$this->layout->content = View::make('panel.login');
	}
	public function loginProcess(){
		$rules = array(
			'user'=>'required|regex:/^[a-zA-Z-_]+$/',
			'pass'=>'required|alpha_num|min:6',
 		);
 		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails()) 
			return "Username/Password combination incorrect.<br/>" . link_to('/login','Try again !');
			
		if( Auth::attempt( array('name' => Input::get('user'), 'password' => Input::get('pass') ) ) ){
			return Redirect::to('/admin');
		}
		return "Username/Password combination incorrect.<br/>" . link_to('/login','Try again !');
	}
	public function showAdd(){
		$this->layout->content = View::make('panel.add');
	}
	public function showDel(){
		$this->layout->content = View::make('panel.del');
	}
	public function uploadImage(){
		if(!Input::hasFile('myfile'))
			return Response::json(array('status_code' => 403));
		$rules = array(
				'myfile' => 'required|image|mimes:jpeg,png'
			);
		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
			return Response::json(array('status_code' => 401));
		$file = Input::file('myfile');
		if($file->getSize() > 12 * 1024 * 1024)
			return Response::json(array('status_code' => 413));
		$filename =  Str::quickRandom(26) . ".jpg";
		$file->move(public_path() . '/gallery/' , $filename);
		return Response::json(array('status_code' => 200,'url' => URL::to('/gallery') . '/' . $filename));
	}
	public function add(){
		if(!Input::has('postData'))
			return Response::json(array('status_code' => 400));
		$ob = json_decode(Input::get('postData'));
		$exits = Place::where('url_referencia',$ob->ref_url)->get();
		if(count($exits)>0)
			return Response::json(array('status_code' => 304));
		$house = new Place;
		$house->descripcion = $ob->description;
		$house->descripcionEs = $ob->descriptionEs;
		$house->front_image = $ob->imgs->{0};
		$house->direccion = $ob->address;
		$house->dimensionesFeet = $ob->ft;
		$house->dimensionesMeter = $ob->m2;
		$house->area = $ob->mrkt_area;
		$house->dormitorios = $ob->bedrooms;
		$house->banios = $ob->baths;
		$house->garage = $ob->garage;
		$house->contruida_anio = $ob->year_built;
		$house->piscina = $ob->swimming_pool;
		$house->distritoEscolar = $ob->district;
		$house->escuelaKinder = $ob->elementaryl;
		$house->escuelaPrimaria = $ob->middle;
		$house->escuelaSecundaria = $ob->high;
		$house->url_referencia = $ob->ref_url;
		$house->precio = $ob->price;
		$house->permLink = $ob->permlink;
		$house->save();
		
		foreach($ob->imgs as $url){
			$article = Place::find($house->id);
			$img = new Image;
			$img->url = $url;
			$article->images()->save($img);
		}
		return Response::json(array('status_code' => 200));
	}
	public function delete(){
		$place = Place::find(Input::get('id'));
		$e = $place->delete();
		if(!$place)
			return Response::json(array('status_code' => 404));
		//code update o noseq softDelete
		return Response::json(array('status_code' => 200,$e));
	}
	public function patch(){

	}
}