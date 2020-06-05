<?php

class Database extends MySQLiz
{
	
	public function __construct()
	{
		parent::__construct(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	}
	
	
}