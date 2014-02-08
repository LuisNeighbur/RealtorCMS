public function AlterSendEmail(){
		$rules = array(
			'name'=>'required|regex:/^[a-zA-Z-\s]+$/',
			'email'=>'required|email',
			'choice'=>'required|regex:/^[a-zA-Z-\s]+$/',
			'content'=>'required|regex:/^[a-zA-Z-\s]+$/'
 		);
 		$validation = Validator::make(Input::all(), $rules);
 		if ( $validation->fails() ){
 			$response = array('clase' => 'danger', 'texto' => 'You must complete all fields and place a valid email address.', 'debug' => $validation->messages()->all(), 'holy_shit' => Input::all());
 		}else{
 			$response = array('clase' => 'success', 'texto' => 'Your request were sent, you will hear shortly from Franco.');
 		}
 		return Response::json($response);
	}