<?php

require_once '../src/GoogleProfanity.php';

class GoogleProfanityTest extends PHPUnit_Framework_TestCase
{
    private $profanity;

    public function setUp()
    {
        $this->profanity = new joshtronic\GoogleProfanity();
    }

    /**
     * @dataProvider providerFormatPhoneNumber
     */
    public function testCheck($a, $b)
    {
        $this->assertEquals($b, $this->profanity->check($a));
    }

    public function providerFormatPhoneNumber()
    {
        return array(
            array('alpha',      false),
            array('beta',       false),
            array('joshtronic', false),
            array('god',        false),
            array('fck',        false),
            array('fuck',       true),
            array('shit',       true),
            array('cocksucker', true),
            array('cuntface',   false), // Unsure why not...
        );
    }

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Invalid response from API.
     */
    public function testInvalidResponse()
    {
        $file = SITE_PATH . 'null-';

        file_put_contents($file . 'test', null);

        $this->profanity->check('test', $file);
    }
}

