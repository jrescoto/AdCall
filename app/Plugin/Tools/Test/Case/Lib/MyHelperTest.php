<?php

App::uses('MyHelper', 'Tools.Lib');
App::uses('View', 'View');
App::uses('MyCakeTestCase', 'Tools.TestSuite');

class MyHelperTest extends MyCakeTestCase {

	public $MyHelper;

	public function setUp() {
		$this->MyHelper = new MyHelper(new View(null));
	}

	public function testObject() {
		$this->assertTrue(is_object($this->MyHelper));
		$this->assertIsA($this->MyHelper, 'MyHelper');
	}

	//TODO
}