<?php

class AdminDashboardController extends AdminController {

	/**
	 * Admin dashboard
	 *
	 */
	public function getIndex()
	{
        Debugbar::info("AdminDashboardController.");
        return View::make('admin/dashboard');
	}

}