<?php

class Bet_Model extends MY_Model {
	public $primary_key = 'bet_id';
	public $belongs_to = array('outcome');
}
