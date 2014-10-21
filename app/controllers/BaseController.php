<?php

use Illuminate\Support\Facades\View;
use Laracasts\Commander\CommanderTrait;

class BaseController extends Controller {

    use CommanderTrait;

    /**
     * Initializer.
     *
     * @access   public
     * @return \BaseController
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

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
        View::share('localuser', Auth::user());
//        View::share('google_resources', GCalSvc::calservice();
	}

}