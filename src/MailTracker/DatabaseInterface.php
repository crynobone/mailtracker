<?php namespace MailTracker;

interface DatabaseInterface {

	/**
	 * Find information by the tracking ID.
	 *
	 * @access public
	 * @param  string   $trackingCode
	 */
	public function find($trackingCode);

	/**
	 * Store a transaction and retrieve tracking ID.
	 *
	 * @access public
	 * @param  array    $data
	 * @return string   $trackingCode
	 */
	public function create($data = array());
}