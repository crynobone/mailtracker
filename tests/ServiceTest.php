<?php

class ServiceTest extends PHPUnit_Framework_TestCase {

	/**
	 * Teardown the test environment.
	 */
	public function tearDown()
	{
		\Mockery::close();
	}

	/**
	 * Test constructing new MailTracker\Service.
	 *
	 * @test
	 */
	public function testConstructMethod()
	{
		$dbMock = \Mockery::mock('MailTracker\DatabaseInterface');
		$stub   = new \MailTracker\Service($dbMock);

		$refl   = new \ReflectionObject($stub);
		$db     = $refl->getProperty('db');

		$db->setAccessible(true);

		$this->assertInstanceOf('\MailTracker\Service', $stub);
		$this->assertInstanceOf('\MailTracker\DatabaseInterface', $db->getValue($stub));
	}

	/**
	 * Test generating a new tracking code.
	 *
	 * @test
	 */
	public function testGeneratingNewTrackingCode()
	{
		$dbMock = \Mockery::mock('MailTracker\DatabaseInterface');
		$dbMock->shouldReceive('store')->once()->andReturn('arandomtrackingcode');
		$stub = new \MailTracker\Service($dbMock);

		$result = $stub->generate();

		$this->assertEquals('arandomtrackingcode', $result->trackingCode);
	}

	/**
	 * Test given tracking code is valid.
	 *
	 * @test
	 */
	public function testGivenTrackingCodeIsValid()
	{
		$dbMock = \Mockery::mock('MailTracker\DatabaseInterface');
		$dbMock->shouldReceive('find')->with('arandomtrackingcode')->andReturn(true);
		$stub = new \MailTracker\Service($dbMock);

		$this->assertTrue($stub->check('arandomtrackingcode'));
	}

	/**
	 * Test given tracking code is not valid.
	 *
	 * @test
	 */
	public function testGivenTrackingCodeIsNotValid()
	{
		$dbMock = \Mockery::mock('MailTracker\DatabaseInterface');
		$dbMock->shouldReceive('find')->with('arandomtrackingcode')->andReturn(false);
		$stub = new \MailTracker\Service($dbMock);

		$this->assertFalse($stub->check('arandomtrackingcode'));
	}
}