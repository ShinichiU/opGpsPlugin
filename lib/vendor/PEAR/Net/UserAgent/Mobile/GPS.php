<?php
/**
 * +----------------------------------------------------------------------+
 * | PEAR :: Net :: UserAgent :: Mobile :: GPS                            |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2008 Kei Horikita                                      |
 * +----------------------------------------------------------------------+
 * | All rights reserved.                                                 |
 * |                                                                      |
 * | Redistribution and use in source and binary forms, with or without   |
 * | modification, are permitted provided that the following conditions   |
 * | are met:                                                             |
 * |                                                                      |
 * | * Redistributions of source code must retain the above copyright     |
 * |   notice, this list of conditions and the following disclaimer.      |
 * | * Redistributions in binary form must reproduce the above copyright  |
 * |   notice, this list of conditions and the following disclaimer in    |
 * |   the documentation and/or other materials provided with the         |
 * |   distribution.                                                      |
 * | * The names of its contributors may be used to endorse or promote    |
 * |   products derived from this software without specific prior written |
 * |   permission.                                                        |
 * |                                                                      |
 * | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS  |
 * | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT    |
 * | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS    |
 * | FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE       |
 * | COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,  |
 * | INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, |
 * | BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;     |
 * | LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER     |
 * | CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT   |
 * | LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN    |
 * | ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE      |
 * | POSSIBILITY OF SUCH DAMAGE.                                          |
 * +----------------------------------------------------------------------+
 *
 * PHP versions 5
 *
 * @category  Net
 * @package   Net_UserAgent_Mobile_GPS
 * @author    Kei Horikita <gps4mobile@gmail.com>
 * @copyright 2008 Kei Horikita
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version   CVS: $Id: GPS.php,v 1.1 2008/06/30 15:17:45 kei Exp $
 * @link      http://mgps.org
 */

require_once 'Net/UserAgent/Mobile/GPS/Exception.php';

/**
 * GPS class
 *
 * This class provides a method to judge the device type
 * and create the object for provicder
 *
 * @category  Net
 * @package   Net_UserAgent_Mobile_GPS
 * @author    Kei Horikita <gps4mobile@gmail.com>
 * @copyright 2008 Kei Horikita
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version   Release: 0.0.1
 * @link      http://mgps.org
 */
abstract class Net_UserAgent_Mobile_GPS
{
    /**
     * constructor to prevent instantiation.
     */
    private final function __construct()
    {
    }

    /**
     * To judge the divice type
     *
     * @param object &$agent Net_UserAgent_Mobile object
     *
     * @return device type
     *
     * @throws Net_UserAgent_Mobile_GPS_Exception
     */
    static public function factory( &$agent = null )
    {
        if ( $agent === null ) {
            include_once 'Net/UserAgent/Mobile.php';
            $agent = Net_UserAgent_Mobile::singleton();
        }

        switch ( true ) {
        case $agent->isDoCoMo() :
            $_class = 'Docomo';
            break;
        case $agent->isSoftBank() :
            $_class = 'Softbank';
            break;
        case $agent->isEzweb() :
            $_class = 'Ezweb';
            break;
        case $agent->isWillcom() :
            $_class = 'Willcom';
            break;
        default :
            throw new Net_UserAgent_Mobile_GPS_Exception('Cannot detect device. 
                                         Please try me with mobile device');
            break;
        }

        $classfile = 'GPS/' . $_class . '.php';
        if ( !@fclose(@fopen($classfile, 'r', true)) ) {
            throw new Net_UserAgent_Mobile_GPS_Exception('No driver for ' . $_class);
        }

        include_once $classfile;
        $classname = 'Net_UserAgent_Mobile_GPS_' . $_class;

        if ( class_exists($classname) === false ) {
            throw new Net_UserAgent_Mobile_GPS_Exception('The driver does not hvae '
                                         . $classname);
        }

        return new $classname($agent);
    }

}

?>
