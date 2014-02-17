<?php
class SearchController extends BaseController{
	protected $layout = 'layouts.master';//'layouts.search';
	
	public function search(){
		if(Input::has('q')){
		$terms = Input::get('q');
		$articles = Search::SearchProperty($terms);
		if(!$articles)
			return View::make('layouts.search_none');
		$this->layout->content = View::make('layouts.search')->with('articles', $articles);	
		}else{
			return Redirect::to('/');
		}
	}
}