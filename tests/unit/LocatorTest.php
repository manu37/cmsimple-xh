<?php

/**
 * Testing the locator (breadcrumb menu).
 *
 * PHP version 5
 *
 * @category  Testing
 * @package   XH
 * @author    The CMSimple_XH developers <devs@cmsimple-xh.org>
 * @copyright 2015-2017 The CMSimple_XH developers <http://cmsimple-xh.org/?The_Team>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link      http://cmsimple-xh.org/
 */

require_once './vendor/autoload.php';
require_once './cmsimple/functions.php';
require_once './cmsimple/tplfuncs.php';

/**
 * A test case for the locator.
 *
 * @category Testing
 * @package  XH
 * @author   The CMSimple_XH developers <devs@cmsimple-xh.org>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://cmsimple-xh.org/
 * @since    1.7
 */
class LocatorTest extends PHPUnit_Framework_TestCase
{
    protected $aMock;

    protected $modelMock;

    public function setUp()
    {
        $this->aMock = new PHPUnit_Extensions_MockFunction('a', null);
        $this->aMock->expects($this->any())->willReturn('<a href="foo">');
        $this->modelMock = new PHPUnit_Extensions_MockFunction(
            'XH_getLocatorModel', null
        );
        $this->modelMock->expects($this->once())->willReturn(
            array(array('Home', '?foo'), array('Bar', '?bar'))
        );
    }

    public function tearDown()
    {
        $this->aMock->restore();
        $this->modelMock->restore();
    }

    public function testLocator()
    {
        $expected = '<span vocab="http://schema.org/" typeof="BreadcrumbList">'
            . '<span property="itemListElement" typeof="ListItem">'
            . '<a property="item" typeof="WebPage" href="?foo">'
            . '<span property="name">Home</span><meta property="position" content="1">'
            . '</a></span> &gt; <span property="itemListElement" typeof="ListItem">'
            . '<span property="name">Bar</span><meta property="position" content="2"></span></span>';
        $this->assertEquals($expected, locator());
    }
}

?>
