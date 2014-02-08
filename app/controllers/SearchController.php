<?php
class SearchController extends BaseController{
	protected $layout = 'layouts.search';
	
	public function search($terms){
		
		$terms = urldecode($terms);
		
		$articles = Search::Search($terms);

		$this->layout->content = View::make('layouts.articleSearch')->with(array('articles'=>$articles->toArray()));
	}
}