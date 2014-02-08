<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	protected $layout = 'layouts.master';
	public function showWelcome(){
		$articles = Place::getAll();
		$this->layout->content = View::make('layouts.article')->with(array('articles' => $articles));
	}
	public function showProperty($title,$id){
		$articles = Place::getWithImages($id);
		$this->layout->content = View::make('layouts.permlink')->with(array('articles' => $articles));
	}
	public function showKnowMe(){
		return View::make('knowme');
	}
	public function showBuy(){
		return View::make('buy');
	}
	public function showSupport(){
		return View::make('support');
	}
	public function showSell(){
		return View::make('sell');
	}
	public function showAdv(){
		return View::make('adv');
	}
	public function showCenter(){
		return View::make('center');
	}
	public function showContact(){
		return View::make('contact');
	}
	public function showJson($id){
		$data = Place::getWithImages($id);
		//return ($data) ? $data : Response::json(array('status_code' => 404));
		return Response::json($data);
	}
	public function SendEmail(){
		$rules = array(
			'name'=>'required|regex:/^[a-zA-Z-\.-\s]+$/',
			'email'=>'required|email',
			'choice'=>'required|regex:/^[a-zA-Z-\s]+$/',
			'content'=>'required|regex:/^[\w-\s-\n-\-\(\)\'\.?!¿¡]+$/'
 		);
 		$validation = Validator::make(Input::all(), $rules);
 		if ( $validation->fails() ){
 			$response = array(
 				'clase' => 'danger', 
 				'texto' => 'You must complete all fields and place a valid email address.',
 				'debug' => $validation->messages()->all()
 			);
 		}else{
 			Mail::send('mail', array('name'=>Input::get('name'),'email'=>Input::get('email'),'content'=>Input::get('content')), function($message){
      			$message
      				->to('texasusaagent@gmail.com','Franco Thoma')
      				->subject(Input::get('choice'));
   			});
 			$response = array(
 				'clase' => 'success', 
 				'texto' => 'Your request were sent, you will hear shortly from Franco.'
 			);
 		}
 		return Response::json($response);
	}
}