<?php

class Bootstrap {

	function __construct() {

		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode('/', $url);
        
		//print_r($url);exit;
        //IF THE FIRST URL PART IS EMPTY////
		if (empty($url[0])) {
			require 'controllers/index.php';
			$controller = new Index();
			$controller->index();
			return false;
		}
        /////// ELSE IF THE FIRST URL IS NOT EMPTY
        else{
        $file = 'controllers/' . $url[0] . '.php';  
        ///// IF THE CONTROLLER FILE EXIST    
        if (file_exists($file)) {
        require $file;  
		}
        /////ELSE IF THE FIRST URL PART IS NUMERIC, IT SHOULD GO TO REGISTER PAGE    
		elseif (is_numeric($url[0])) {
            header('location: ./register?ref='.$url[0]);
		}
        /////// ELSE IT SHOULD CALL THE ARTIST METHOD
		else {
        $this->error();
        return false;
        //$this->error();

		} 
            
        $controller = new $url[0];
		$controller->loadModel($url[0]);   
          
        ///////IF THE URL ONE IS NOT EMPTY    
        if (isset($url[1])) {
        //echo "reach here last"; exit;    
        if (method_exists($controller, $url[1])) {
        	//print_r($url);exit;
            $controller->{$url[1]}();
        }
        elseif (method_exists($controller, 'index')) {  
        $controller->index();
        }  
        else {
            $this->error();
        }   
            
            
        }else{
            //echo "reach here first";exit;
         //if (($url[0]=='community')||($url[0]=='cinema')||($url[0]=='userdashboard')||($url[0]=='passage')||($url[0]=='genre')||($url[0]=='library')||($url[0]=='preview')||($url[0]=='userlogin')) {
            
        
            if(method_exists($controller, 'index')){
            ///// IF THE URL IS NUMERIC, IT SHOULD USE THE INDEX OF THE EXISTING CONTROLLER////
            $controller->index();
            }
            
            elseif (method_exists($controller, $url[0])) {
				$controller->{$url[0]}($url[1]);
            }
            
          else{

            $this->error();
            }   
        }
            
            
        }

        
        /*
		$file = 'controllers/' . $url[0] . '.php';

		if (file_exists($file)) {
           
			require $file;

		}


		elseif (is_numeric($url[0])) {
            header('location: ./register?ref='.$url[0]);
		}

		else {
        require 'controllers/index.php';
        $controller = new Index();
        $controller->artist();
        return false;
        //$this->error();

		}
        

		$controller = new $url[0];
		$controller->loadModel($url[0]);
		//echo $url[0];
		// calling methods

		if (isset($url[1])) {

            if (($url[0]=='community')||($url[0]=='cinema')||($url[0]=='userdashboard')||($url[0]=='passage')||($url[0]=='genre')||($url[0]=='library')||($url[0]=='hub')||($url[0]=='search')) {
                    
                        ///// IF THE URL IS NUMERIC, IT SHOULD USE THE INDEX OF THE EXISTING CONTROLLER////
                        $controller->index();

		              }else{
			if (method_exists($controller, $url[1])) {
				$controller->{$url[1]}($url[2]);
			} else {
				$this->error();
			}
            }
		} else {

			if (isset($url[0])) {
				if (method_exists($controller, $url[1])) {
					$controller->{$url[1]}();
				} else {

                    if (($url[0]=='community')||($url[0]=='cinema')||($url[0]=='userdashboard')||($url[0]=='passage')||($url[0]=='genre')||($url[0]=='library')||($url[0]=='preview')||($url[0]=='userlogin')) {

                        if(($url[0]=='community')||($url[0]=='genre')||($url[0]=='cinema')){
                         $controller->$url[0]();
                        }else{
                        ///// IF THE URL IS NUMERIC, IT SHOULD USE THE INDEX OF THE EXISTING CONTROLLER////
                        $controller->index();
                        }
		              }else{

					$this->error();
                    }
				}
			} else {

				$controller->index();
			}
		}
*/

	}

	function error() {
		echo "INVALID LINK";
		/*
		require 'controllers/error.php';
		$controller = new Error();
		$controller->index();
		*/
		return false;
	}

}
