<?php
class SearchController extends BaseController{
	protected $layout = 'layouts.master';//'layouts.search';
	
	public function search($terms){
		
		$terms = urldecode($terms);
		
		$articles = Search::SearchProperty($terms);
		$this->layout->content = View::make('layouts.search')->with('articles', $articles);//articleSearch
	}
}