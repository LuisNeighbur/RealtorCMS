<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
    public function __construct()
    {
        $this -> configureLocale();
    }

    /**
     * Action used to set the application locale.
     * 
     */
    public function setLocale()
    {
        $mLocale = Request::segment( 2, Config::get( 'app.locale' ) ); // Get parameter from URL.
        if ( in_array( $mLocale , Config::get( 'app.locales' ) ) )
        {
           App::setLocale( $mLocale );
           Session::put( 'locale', $mLocale );
           Cookie::forever( 'locale', $mLocale );
        }
        return Redirect::back();
    }

    /**
     * Detect and set application localization environment (language).
     * NOTE: Don't foreget to ADD/SET/UPDATE the locales array in app/config/app.php!
     *
     */
    private function configureLocale(){
        // Set default locale.
        $mLocale = Config::get( 'app.locale' );

        // Has a session locale already been set?
        if ( !Session::has( 'locale' ) ){
            // No, a session locale hasn't been set.
            // Was there a cookie set from a previous visit?
            $mFromCookie = Cookie::get( 'locale', null );
            if ( $mFromCookie != null && in_array( $mFromCookie, Config::get( 'app.locales' ) ) ){
                // Cookie was previously set and it's a supported locale.
                $mLocale = $mFromCookie;
            }
            

            Session::put( 'locale', $mLocale );
            Cookie::forever( 'locale', $mLocale );
        } // Session?
        else
        {
            // session locale is available, use it.
            $mLocale = Session::get( 'locale' );
        } // Session?

        // set application locale for current session.
        App::setLocale( $mLocale );

    }
}