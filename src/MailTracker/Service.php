<?php namespace MailTracker;

class Service {

	/**
	 * Database instance.
	 *
	 * @var MailTracker\DatabaseInterface
	 */
	protected $db;

	/**
	 * Construct a new service.
	 *
	 * @access public
	 * @param  DatabaseInterface    $db
	 * @return void
	 */
	public function __construct(DatabaseInterface $db)
	{
		$this->db = $db;
	}

	/**
	 * Generate a new tracking.
	 *
	 * @access public
	 * @param  array    $data
	 * @return string
	 */
	public function generate($data = array())
	{
		return $this->db->create($data);
	}

	/**
	 * Check/validate a tracking code.
	 *
	 * @access public
	 * @param  string   $trackingCode
	 * @return boolean
	 */
	public function check($trackingCode)
	{
		return $this->db->find($trackingCode);
	}

	/**
	 * Serve the tracking image, ideally this should be call from a 
	 * controller.
	 *
	 * @access public
	 * @return string
	 */
	public function serve()
	{
		return (object) array(
			"contentType" => "image/gif",
			"data"        => "data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==",
		);
	}
}