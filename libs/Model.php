<?php

class Model {

	function __construct() {
    $this->db = new Database();
    //$this->memcache = new Memcache();
    //$this->cacheAvailable = $this->memcache->addServer(constant("MEMCACHED_HOST"), constant("MEMCACHED_PORT"));

    //$this->memcache->flush();

	}
	
	function returnjson($result){
	//header('Content-type: application/json');	
	return json_encode($result);
	
	}

}