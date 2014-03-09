<?php

class Events extends CI_Controller 
{
	public function index()
	{
		$data['checked'] = $this->ion_auth->logged_in();
        $this->load->view('events', $data);
	}
}

/* End of file events.php */
/* Location: ./application/controllers/events.php */
