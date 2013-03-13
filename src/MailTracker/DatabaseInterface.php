<?php namespace MailTracker;

interface DatabaseInterface {

	/**
	 * Find information by the tracking ID.
	 *
	 * @access public
	 * @param  string   $tracking_code
	 */
	public function find($tracking_code);

	/**
	 * Store a transaction and retrieve tracking ID.
	 *
	 * @access public
	 * @return string $tracking_code
	 */
	public function store();
}