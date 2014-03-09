<?php

class Events extends CI_Controller 
{
	public function index()
	{
		$this->load->model('Event_Model');
		$data['events'] = $this->Event_Model->with('outcomes')->get_all();
        $this->load->view('events', $data);
	}
}

/* End of file events.php */
/* Location: ./application/controllers/events.php */
