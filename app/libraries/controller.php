
<?php
/* Base Controller
 * Loads the Models and Views
 */

class Controller {
	// Load Model
	public function model ($model){
		// Require model files
		require_once '../app/models/' . $model . '.php';

		// Instantiate model
		return new $model;
	}

	// Load view
	public function View ($view, $data){

		if(file_exists('../app/views/'. $view .'.php')){
			require_once '../app/views/'. $view .'.php';
		} else {
			die('View does not exist');
		}


	}

}


?>