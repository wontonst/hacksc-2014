<?php

class Outcome_Model extends MY_Model {
	public $primary_key = 'outcome_id';
	public $belongs_to = array('event');
	public $has_many = array('bets');
}
