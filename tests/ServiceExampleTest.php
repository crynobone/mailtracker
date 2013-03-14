<?php

class ServiceExampleTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * Service instance.
	 *
	 * @var MailTracker\Service
	 */
	private $stub;

	/**
	 * Setup the test environment.
	 */
	public function setUp()
	{
		$this->stub = new MailTracker\Service(
			new DatabaseStub
		);
	}

	/**
	 * Test storing and checking from DatabaseInterface.
	 */
	public function testStoringAndCheckingFromDatabaseInterface()
	{
		$trackingCode = $this->stub->generate();

		$this->assertTrue(is_string($trackingCode));
		$this->assertTrue(strlen($trackingCode) === 36);
		$this->assertTrue($this->stub->check($trackingCode));
	}


}

class DatabaseStub implements MailTracker\DatabaseInterface {

	private $mockTrackingCode;

	public function find($trackingCode)
	{
		return ($this->mockTrackingCode === $trackingCode);
	}

	public function store()
	{
		return $this->mockTrackingCode = (string) Rhumsaa\Uuid\Uuid::uuid1();
	}
}