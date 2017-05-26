<?php

use Illuminate\Support\Facades\Input;
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

	public function getIndex()
	{
	    if (Input::has('action')) {
    	    $rules = array(
                'link' => 'required',
                'vs' => 'required|integer',
                've' => 'required|integer',
                'username' => 'required',
                'password' => 'required',
            );
    	    
    	    $validator = Validator::make(Input::all(), $rules);
    	    
    	    if ($validator->fails()) {
    	        return Redirect::back()->withErrors($validator)->withInput();
    	    }
	    }
	    
	    //Dem code
	    $username = Input::get('username');
	    $password = Input::get('password');
	    $urlBase = '"' . Input::get('link') . '" --username '. $username . ' --password ' . $password;
	    $modelSvn = new Svn($urlBase, true);
	    $debug = array();
	    
	    if (Input::get('check_type') == 1) {
	        $aryLog = $modelSvn->exportRevisionLog(Input::get('vs'), Input::get('ve'));
	        $aryAccountFilter = array();
	         
	        if (Input::get('account')) {
	            $tmp = explode(';', Input::get('account'));
	             
	            if (count($tmp) > 0) {
	                $aryAccountFilter = $tmp;
	            }
	        }
	        
	        $countLoc = $modelSvn->svnDiffEachVersion($debug, $aryLog, $aryAccountFilter);
	    } else {
	        $countLoc = $modelSvn->svnDiff(Input::get('vs'), Input::get('ve'), $debug);
	    }
	    
	    Input::flash();
	    
		return View::make('home', compact('countLoc'));
	}

}
