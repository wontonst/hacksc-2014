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
		$name = $this->input->post('name'),
		$description 'description' => $this->input->post('description');
		$image_url => $this->input->post('image');

		$array = array(
			'name' => $name,
		);
		if ($description) $array['description'] = $description;
		if ($image_url) $array['image_url'] = $image_url;

		$this->load->model('Event_Model');
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
		$event_id = $this->input->post('event_id');
		$name = $this->input->post('name');

		$array = array(
			'event_id' => $event_id,
			'name' => $name
		);

		$this->load->model('Outcome_Model');
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
		// Only logged-in users can create bets
		if ($this->session->userdata('user_id')) {
			$outcome_id = $this->input->post('outcome_id'),
			$user_id = $id = $this->session->userdata('user_id'),
			$amount = $this->input->post('amount')

			$array = array(
				'outcome_id' => $outcome_id,
				'user_id' => $user_id,
				'amount' => $amount
			);

			$this->load->model('Bet_Model');
			$this->Bet_Model->insert($array);

			$this->response($array, 301);
		} else {
			$this->response('', 403);
		}
	}
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */
