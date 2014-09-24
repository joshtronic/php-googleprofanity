<?php

/**
 * Google Profanity Wrapper File
 *
 * PHP version 5
 *
 * Licensed under The MIT License
 * Redistribution of these files must retain the above copyright notice.
 *
 * @author    Josh Sherman <josh@gravityblvd.com>
 * @copyright Copyright 2014, Josh Sherman
 * @license   http://www.opensource.org/licenses/mit-license.html
 * @link      https://github.com/joshtronic/php-googleprofanity
 */

namespace joshtronic;

/**
 * Google Profanity API Interface
 */
class GoogleProfanity
{
    /**
     * Check
     *
     * Checks if a word is considered profanity.
     *
     * @usage  GoogleProfanity::check('fuck'); // returns true
     * @param  string $word word to check
     * @param  string $endpoint the endpoint to call (helps testing)
     * @return boolean whether or not the word is profanity
     */
    public function check($word, $endpoint = 'http://www.wdyl.com/profanity?q=')
    {
        $response = json_decode(file_get_contents($endpoint . $word), true);

        if ($response == null || !isset($response['response'])
            || !in_array($response['response'], array('true', 'false')))
        {
            throw new \Exception('Invalid response from API.');
        }
        else
        {
            return $response['response'] == 'true';
        }
    }
}

