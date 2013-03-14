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
	 * @return stdClass
	 */
	public function generate()
	{
		$trackingCode = $this->db->store();

		return (object) compact('trackingCode');
	}
}