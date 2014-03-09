<?php

class Event_Model extends MY_Model {
	public $primary_key = 'event_id';
	public $has_many = array('outcomes');
}
