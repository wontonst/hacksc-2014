<?php
require(APPPATH.'libraries/REST_Controller.php');

class API extends REST_Controller 
{
	public function index_get()
	{
		$this->response('RESTful API root');
	}

	public function events_get()
	{
		$this->load->model('Event_Model');
		$events = $this->Event_Model->with('outcomes')->get_all();
		$this->response($events);
	}

	public function events_post()
	{
		$this->load->model('Event_Model');
		$array = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description') ?: ''
		);
		$this->Event_Model->insert($array);
		$this->response($array, 301);
	}

	public function outcomes_get()
	{
		$this->load->model('Outcome_Model');
		$outcomes = $this->Outcome_Model->get_all();
		$this->response($outcomes);
	}

	public function outcomes_post()
	{
		$this->load->model('Outcome_Model');
		$array = array(
			'event_id' => $this->input->post('event_id'),
			'name' => $this->input->post('name')
		);
		$this->Outcome_Model->insert($array);
		$this->response($array, 301);
	}

	public function bets_get()
	{
		$this->load->model('Bet_Model');
		$bets = $this->Bet_Model->get_all();
		$this->response($bets);
	}

	public function bets_post()
	{
		if ($this->session->userdata('user_id')) {
			$this->session->userdata(''); $id || 
			$this->load->model('Bet_Model');
			$array = array(
				'outcome_id' => $this->input->post('outcome_id'),
				'user_id' => $id = $this->session->userdata('user_id'),
				'amount' => $this->input->post('name')
			);
			$this->Bet_Model->insert($array);
			$this->response($array, 301);
		} else {
			$this->response('', 403);
		}
	}
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */
