<?php

    class thinlog {
        
        protected static $config = array(
            "path" => "/var/log/thinlog.log", // this can be relative (starts with a '/' or absolute)
            "tags" => array( // here you can turn logging on (true) or off (false) for each tag in your app
                "default" => true,  // this special tag is a catch-all for undefined tags.  i wouldn't remove it!
            ),
        );

        public static function log($input, $tagName = "default") {
            if (!isset(self::$config["tags"][$tagName])) {
                error_log("I thought you might want to know that you attempted to log to a tag named '{$tagName}', but you haven't configured that tag..");
                $tagName = "default";
            }
            
            $path = self::$config["path"];
            
            // don't do anything if the tag value is set to false
            if (!self::$config["tags"][$tagName]) return false;
            
            // serialize arrays
            if (is_array($input)) $input = json_encode($input);
            
            // construct the message
            $message = date('l H:i:s') . " [ {$tagName} ] {$input}\n";
            
            // create absolute path from relative path, if necessary
            if (substr($path, 0, 1) != '/') {
                $path = dirname(__FILE__) . "/" . $path;
            }
            
            //do the logging!
            if(!$attempt = error_log($message, 3, $path)) {
                throw new Exception("thinlog ran into this php error when trying to write to log:" . $php_errormsg );
            }
            
            return true;
        }
        
    }






/* 
<looky here, full docs!>

    How to use thinlog.php
        1. Modify the $config associative array to suit your fancy
        2. Log something in your app code, like this:  thinlog::log("Sup world!")
        3. In terminal, do "tail -f <pathToLogFile>" where <pathToLogFile> is replaced by the path you setup in $config["path"]

    "path"
        This can be relative (just don't start it with a '/') or absolute (start it with a '/')
    "tags"
        A simple mapping between tag names and booleans
        
    
    Example-based explanation of how TAGS work:
    
        If this were your $config:
        
            protected static $config = array(
                "path" => "/var/log/myLogFile.log",
                "tags" => array(
                    "default" => true,
                    "chunky" => true,
                    "bacon" => false,
                ),
            );
        
        
        Then a call to thinlog::log("Sup werld", "chunky") would actually write to the log,
            since you send the "chunky" tag name, and logging for that tag is turned on
        But a call to thinlog::log("Not much u?", "bacon") would not write to anything,
            because logging for the tag "bacon" is set to false.
        The "default" tag will take over if...
            ..you send a tag name that isn't listed
            ..you don't send a tag name at all! (the 2nd argument to log() is optional)
*/

/*    
    <license stuff>
    
    Hi there!
    Do you like to keep a clean, simple libs directory for outside code like this?
    Me too.
    To that end, I've stuck the license stuff here in comments, so you don't have to deal with more than one file.
    -kw

    thinlog.php is licensed under The MIT License

    Copyright (c) 2010 Kyle Wild (dorkitude) - available at http://github.com/dorkitude/thinlog.php

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    THE SOFTWARE.
    
    </license stuff>
*/