<?php
/* Prevent direct access */
defined('ABSPATH') or die("You can't access this file directly.");

/**
 * Class WD_ASL_Instances
 *
 * This class handles the data transfer between code and instance data
 *
 * @class         WD_ASL_Instances
 * @version       1.0
 * @package       AjaxSearchLite/Classes/Core
 * @category      Class
 * @author        Ernest Marcinko
 */
class WD_ASL_Instances {

    /**
     * Core singleton class
     * @var WD_ASL_Instances self
     */
    private static $_instance;

    /**
     * This holds the search instances
     *
     * @var array()
     */
    private $instances;

    /**
     * This holds the search instances without data
     *
     * @var array()
     */
    private $instancesNoData;

    /**
     * When updating, this variable sets to true, telling that instances need re-parsing
     *
     * @var bool
     */
    private $refresh = false;

    /**
     * Gets the search instance if exists
     *
     * @param int $id
     * @param bool $force_refresh
     * @return bool|array
     */
    public function get( $id = -1, $force_refresh = false ) {

        if ($this->refresh || $force_refresh) {
            $this->init();
            $this->refresh = false;
        }

        if ($id > -1)
            return isset($this->instances[$id]) ? $this->instances[$id] : array();

        return $this->instances;
    }

    /**
     * Gets the search instance if exists, without data
     *
     * @param int $id
     * @param bool $force_refresh
     * @return bool|array
     */
    public function getWithoutData( $id = -1, $force_refresh = false ) {

        if ($this->refresh || $force_refresh) {
            $this->init();
            $this->refresh = false;
        }

        if ($id > -1)
            return isset($this->instancesNoData[$id]) ? $this->instancesNoData[$id] : array();

        return $this->instancesNoData;
    }

    /**
     * Checks if the given search instance exists
     *
     * @param $id
     * @return bool
     */
    public function exists( $id ) {
        return isset($this->instances[$id]);
    }

    /**
     * Update the search data
     *
     * @param $id
     * @param $data
     * @return false|int
     */
    public function update( $id = 0, $data ) {

        $this->refresh = true;

        return update_option("asl_options", $data);
    }

    // ------------------------------------------------------------
    //       ---------------- PRIVATE --------------------
    // ------------------------------------------------------------

    /**
     * Just calls init
     */
    private function __construct() {
        $this->init();
    }

    /**
     * Fetches the search instances from the DB and stores them internally for future use
     */
    private function init() {
        // Reset both variables, so in case of deleting no remains are left
        $this->instances = array();
        $this->instancesNoData = array();

        $instances = array( 0 => get_option( 'asl_options', array() ));

        foreach ($instances as $k => $instance) {
            $this->instancesNoData[$k] = array(
                "id" => $k
            );

            $this->instances[$k]['id'] = $k;
            if ( is_array($instance) )
                $this->instances[$k]['data'] = array_merge(
                    wd_asl()->options['asl_defaults'],
                    $instance
                );
            else
                $this->instances[$k]['data'] = wd_asl()->options['asl_defaults'];
        }
    }

    // ------------------------------------------------------------
    //   ---------------- SINGLETON SPECIFIC --------------------
    // ------------------------------------------------------------

    /**
     * Get the instance of self
     *
     * @return self
     */
    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Cloning disabled
     */
    private function __clone() {
    }

    /**
     * Serialization disabled
     */
    private function __sleep() {
    }

    /**
     * De-serialization disabled
     */
    private function __wakeup() {
    }
}