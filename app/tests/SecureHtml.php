<?php

class SecureHtml extends HTML{
	public function secureStyle($url){
		return "<link media='all' type='text/css' rel='stylesheet' href='" . URL::full() . $url . "' />";

	}
}