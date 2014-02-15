<?php
class SearchController extends BaseController{
	protected $layout = 'layouts.master';//'layouts.search';
	
	public function search(){
		if(Input::has('q')){
		$terms = Input::get('q');
		$articles = Search::SearchProperty($terms);
		$this->layout->content = View::make('layouts.search')->with('articles', $articles);//articleSearch
		}else{
			return Redirect::to('/');
		}
	}
}