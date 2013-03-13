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
}