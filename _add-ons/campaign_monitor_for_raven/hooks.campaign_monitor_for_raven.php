<?php

class Hooks_campaign_monitor_for_raven extends Hooks
{

	public function raven__on_success($data)
	{
		$api_key = array_get($this->config, 'api_key');
		$list_id = array_get($this->config, 'list_id');

		$trigger_field = $this->config['trigger_field'];
		$trigger_value = $this->config['trigger_value'];
		$name_field    = $this->config['name_field'];

		$submission = $data['submission'];

		if (array_get($submission, $trigger_field) == $trigger_value) {

			$data = json_encode(array(
				'EmailAddress' => array_get($submission, $this->config['email_field']),
				'Name'         => array_get($submission, $this->config['name_field'], '')
			));

			$url = 'https://api.createsend.com/api/v3.1/subscribers/' . $list_id . '.json';
			$this->performRequest($url, $data, $api_key);

		}
	}


	private function performRequest($url, $data = null, $auth = null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		if ($auth)
			curl_setopt($ch, CURLOPT_USERPWD, $auth);
		if ($data)
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}

}