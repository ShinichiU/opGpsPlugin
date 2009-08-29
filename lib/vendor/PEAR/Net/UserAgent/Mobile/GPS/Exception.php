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
 * @version   CVS: $Id: Exception.php,v 1.1 2008/06/30 15:18:23 kei Exp $
 * @link      http://mgps.org
 */

require_once 'PEAR/Exception.php';

/**
 * Net_GPS_Exception class
 *
 * This class provides a exception for Net_GPS
 *
 * @category  Net
 * @package   Net_UserAgent_Mobile_GPS
 * @author    Kei Horikita <gps4mobile@gmail.com>
 * @copyright 2008 Kei Horikita
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version   Release: 0.0.1
 * @link      http://mgps.org
 */
class Net_UserAgent_Mobile_GPS_Exception extends PEAR_Exception
{
    /**
     * stack error message
     * @var array
     */
    protected $errors = array();
 
    /**
     * Add error message to the internal error stack
     *
     * @param string $error Error message
     *
     * @return void
     */
    public function addError($error)
    {
        $this->errors[] = $error;
    }

    /**
     * Add multiple error messages to the internal error stack
     *
     * @param array $errors Array of error messages
     *
     * @return void
     */
    public function addErrors($errors)
    {
        $this->errors = array_merge($this->errors, $errors);
    }

    /**
     * Determine if the exception contains error messages in the internal stack
     *
     * @return boolean True if the stack contains errors, false otherwise
     */
    public function hasErrors()
    {
        return (count($this->errors) > 0);
    }

    /**
     * Get list of error messages from the internal error stack
     *
     * This method may be used to generate a list of error messages
     * that have been returned from the Yahoo API.
     *
     * @return array List of error messages
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
