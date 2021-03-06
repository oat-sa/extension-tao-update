<?php
/*  
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * 
 * Copyright (c) 2002-2008 (original work) Public Research Centre Henri Tudor & University of Luxembourg (under the project TAO & TAO2);
 *               2008-2010 (update and modification) Deutsche Institut für Internationale Pädagogische Forschung (under the project TAO-TRANSFER);
 *               2009-2012 (update and modification) Public Research Centre Henri Tudor (under the project TAO-SUSTAIN & TAO-DEV);
 * 
 */

namespace OatBox\Common\Log;

/**
 * Short description of class common_log_Dispatcher
 *
 * @access public
 * @author Joel Bout, <joel.bout@tudor.lu>
 * @package common
 * @subpackage log
 */
class Dispatcher
        implements Appender
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Short description of attribute appenders
     *
     * @access private
     * @var array
     */
    private $appenders = array();

    /**
     * Short description of attribute minLevel
     *
     * @access private
     * @var int
     */
    private $minLevel = null;

    /**
     * Short description of attribute instance
     *
     * @access private
     * @var Dispatcher
     */
    private static $instance = null;

    // --- OPERATIONS ---

    /**
     * Short description of method log
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Item item
     * @return mixed
     */
    public function log( Item $item)
    {
        // section 127-0-1-1--5509896f:133feddcac3:-8000:000000000000435D begin
        foreach ($this->appenders as $appender)
        	$appender->log($item);
        // section 127-0-1-1--5509896f:133feddcac3:-8000:000000000000435D end
    }

    /**
     * Short description of method getLogThreshold
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @return int
     */
    public function getLogThreshold()
    {
        $returnValue = (int) 0;

        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:00000000000017C6 begin
        $returnValue = $this->minLevel;
        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:00000000000017C6 end

        return (int) $returnValue;
    }

    /**
     * Short description of method init
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  array configuration
     * @return boolean
     */
    public function init($configuration)
    {
        $returnValue = (bool) false;

        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:000000000000183B begin
    	$this->appenders = array();
    	$this->minLevel = null;
    	foreach ($configuration as $appenderConfig) {
    		if (isset($appenderConfig['class'])) {
    			$classname = '\OatBox\Common\Log\\'. $appenderConfig['class'];
    			if (!class_exists($classname)){
    				$classname =  $classname;
                }
    			if (class_exists($classname) && is_subclass_of($classname, '\OatBox\Common\Log\Appender')) {
    				$appender = new $classname();
    				if (!is_null($appender) && $appender->init($appenderConfig)) {
    					$this->addAppender($appender);
    				}
    			}
    		}
    	}
    	$returnValue = (count($this->appenders) > 0);
        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:000000000000183B end

        return (bool) $returnValue;
    }

    /**
     * Short description of method singleton
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @return common_log_Dispatcher
     */
    public static function singleton()
    {
        $returnValue = null;

        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:000000000000182B begin
        if (is_null(self::$instance)) {
        	self::$instance = new Dispatcher();
        }
        $returnValue = self::$instance;
        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:000000000000182B end

        return $returnValue;
    }

    /**
     * Short description of method __construct
     *
     * @access private
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @return mixed
     */
    private function __construct()
    {
        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:0000000000001829 begin
    	if (isset($GLOBALS['COMMON_LOGGER_CONFIG'])) {
    		$this->init($GLOBALS['COMMON_LOGGER_CONFIG']);
    	} else {
        	$this->init(array());
        }
        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:0000000000001829 end
    }

    /**
     * Short description of method addAppender
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Appender appender
     * @return mixed
     */
    public function addAppender( Appender $appender)
    {
        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:0000000000001820 begin
        $this->appenders[] = $appender;
        if (is_null($this->minLevel) || $this->minLevel > $appender->getLogThreshold()) {
        	$this->minLevel = $appender->getLogThreshold();
        }
        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:0000000000001820 end
    }

} /* end of class common_log_Dispatcher */

?>