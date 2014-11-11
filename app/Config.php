<?php

namespace App;

/**
 * Holds the configuration of the app.
 *
 * @author maximaximal
 */
abstract class Config {
        static private $values = array();

        /**
         * Gets a value from the config.
         * @param type String - The identifier of the value.
         * @return Boolean
         */
        static function get($key)
        {
                return isset(self::$values[$key]) ? self::$values[$key] : false;
        }
        /**
         * Sets a value to the desired key.
         * @param type String that acts as key for $value.
         * @param type String that should be set to $key.
         */
        static function set($key, $value)
        {
                self::$values[$key] = $value;
        }
}
