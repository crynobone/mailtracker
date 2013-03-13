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
}