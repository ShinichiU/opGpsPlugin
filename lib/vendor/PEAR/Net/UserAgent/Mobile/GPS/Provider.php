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
 * @version   CVS: $Id: Provider.php,v 1.1 2008/06/30 15:18:23 kei Exp $
 * @link      http://mgps.org
 */

/**
 * Net_UserAgent_Mobile_GPS_Provider
 *
 * This class defines methods for provider class.
 *
 * @category  Net
 * @package   Net_UserAgent_Mobile_GPS
 * @author    Kei Horikita <gps4mobile@gmail.com>
 * @copyright 2008 Kei Horikita
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version   Release: 0.0.1
 * @link      http://mgps.org
 */
abstract class Net_UserAgent_Mobile_GPS_Provider
{
    /**
     * Get Link for GPS
     * This method return html <a>tag and url in array.
     * You should put <a>tag or <form>tag with the url from this return
     * on your web page.
     * When a user clicked the link or button,
     * it changes on the page that you appointed as 'callback_url'
     * with GPS information.
     *
     * @param string $callback_url url to get GPS information and return
     * @param string $str          string for link <a href=''>string</a>
     *
     * @return array array with the following items: (string)url, (string)tag
     */
    public function getGPSLink($callback_url, $str = null)
    {
    }

    /**
     * Parse Response from GPS
     *
     * @return array array with the following items:
     *               (string)longitude, (string)latitude
     */
    public function getGPSResponse()
    {
    }
}

?>
