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
		$dbMock->shouldReceive('create')->with(array())
			->once()->andReturn('arandomtrackingcode');
		$stub = new \MailTracker\Service($dbMock);

		$trackingCode = $stub->generate();

		$this->assertEquals('arandomtrackingcode', $trackingCode);
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
		$dbMock = \Mockery::mock('\MailTracker\DatabaseInterface');
		$dbMock->shouldReceive('find')->with('arandomtrackingcode')->once()->andReturn(false);
		$stub = new \MailTracker\Service($dbMock);

		$this->assertFalse($stub->check('arandomtrackingcode'));
	}

	/**
	 * Test image can properly be served.
	 *
	 * @test
	 */
	public function testImageCanPropertlyBeServed()
	{
		$dbMock = \Mockery::mock('\MailTracker\DatabaseInterface');
		$stub   = new \MailTracker\Service($dbMock);

		$serve  = $stub->serve();

		$this->assertEquals('image/gif', $serve->contentType);
		$this->assertEquals("data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==",
			$serve->data);
	}
}