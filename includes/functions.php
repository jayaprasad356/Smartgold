<?php
include_once('crud.php');
/*
-----------------
Functions 
-----------------
1. get_system_configs() 
2. get_random_string($valid_chars, $length)
3. sanitize($string) 
4. check_integer($which)
5. get_current_page()
6. doPages($page_size, $thepage, $query_string, $total=0, $keyword)
7. slugify($text)
8. registerDevice($user_id,$token)
9. isDeviceRegistered($user_id)
10. getAllTokens()
11. getTokenByEmail($email)
12. getAllDevices()

*/
class functions
{
    protected $db;
    function __construct()
    {
        $this->db = new Database();
        $this->db->connect();
        date_default_timezone_set('Asia/Kolkata');
    }
    function get_random_string($valid_chars, $length)
    {

        // start with an empty random string
        $random_string = "";

        // count the number of chars in the valid chars string so we know how many choices we have
        $num_valid_chars = strlen($valid_chars);

        // repeat the steps until we've created a string of the right length
        for ($i = 0; $i < $length; $i++) {
            // pick a random number from 1 up to the number of valid chars
            $random_pick = mt_rand(1, $num_valid_chars);

            // take the random character out of the string of valid chars
            // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
            $random_char = $valid_chars[$random_pick - 1];

            // add the randomly-chosen char onto the end of our string so far
            $random_string .= $random_char;
        }

        // return our finished random string
        return $random_string;
    } // end of get_random_string()

   
}
