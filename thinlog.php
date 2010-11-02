<?php

    class thinlog {
        
        protected static $config = array(
            "log" => array(
                "path" => "/var/log/log.log",
                "buckets" => array(
                    "default" => true,
                ),
            ),
            
            "info" => array(
                "path" => "/var/log/info.log",
                "buckets" => array(
                    "default" => true,
                ),
            ),
        );


        public function __call($functionName, $arguments = array("default")) {
            //now do something!
        }
    }










    /* 
    <looky here, full docs!>
  
      How to use thinlog.php
        - Modify the $config associative array
        - call functions like this:
          thinlog::log($something) or thinlog::info($something)
            - $something must be:
              - anything that can be cast to a string e.g. integer, float, or an object with a __toString() method
              - or
              - a simple object or an array that can be JSON encoded
  
      More about thinlog.php
        Each key in the $config associative array corresponds to a static function.
          The function isn't defined in code, but instead is dynamically created using the __call function.
            See http://php.net/manual/en/language.oop5.overloading.php for details of how this works.
  
        So, if you have defined:
          $config["log"] and $config["info"]
  
        Then you would write to those logs by calling, respectively:
          thinlog::log("Hello, world!") and thinlog::info("Sup witchu?")
          
         
        Each entry in $config needs to have a "path" string and  "buckets" array.
          "path"
            - This can be relative (just don't start it with a '/') or absolute (start it with a '/')

          "buckets"
            - A simple mapping between a bucket names and booleans.
            
            
     
      About Buckets
      thinlog.php function calls can optionally be sent a bucket name as a second parameter
        This is useful if you want in-depth logging while developing a feature.
            Once you're done developing it, you *could* delete all the thinlog calls...
            ...but that would be time-consuming
            ...and you may want those same log calls later, e.g. if you found a bug!
            Instead of deleting all the calls, you can just set the value of the bucket for that feature in question to 0.
            If you later run into bugs in that feature and wish to have visibility again, just set it back to 1
    
    </docs>
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