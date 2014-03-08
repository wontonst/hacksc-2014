<?php

class Bet extends CI_Model {
	private $id;
	private $created_at;
	private $updated_at;
	private $deleted_at;

	public function __construct($options = array()) {
		parent::__construct();
	}
}
