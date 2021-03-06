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

use OatBox\Common as Common;

abstract class BaseAppender
        implements Appender
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---

    /**
     * The message mask, where the least significant bit corresponds to the
     * important severity (trace)
     *
     * @access private
     * @var Integer
     */
    private $mask = null;

    /**
     * an array of tags of which one must be present
     * for the logItem to be logged
     *
     * @access public
     * @var array
     */
    public $tags = array();

    // --- OPERATIONS ---

    /**
     * decides whenever the Item should be logged by doLog
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Item item
     * @return mixed
     * @see doLog
     */
    public function log( Item $item)
    {
        // section 127-0-1-1--5509896f:133feddcac3:-8000:000000000000435D begin
    	if ((1<<$item->getSeverity() & $this->mask) > 0
    		&& (empty($this->tags) || count(array_intersect($item->getTags(), $this->tags))) > 0) {
        	$this->doLog($item);
    	}
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
        $threshold = 0;
        while (($this->mask & 1<<$threshold) == 0){
        	$threshold++;
        }
        $returnValue = $threshold;
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
    	if (isset($configuration['mask']) && is_numeric($configuration['mask'])) {
    		// take over the mask
    		$this->mask = intval($configuration['mask']);
    	} elseif (isset($configuration['threshold']) && is_numeric($configuration['threshold'])) {
    		// map the threshold to a mask
    		$this->mask = max(0,(1<<Common\Logger::FATAL_LEVEL +1) - (1<<$configuration['threshold']));
    	} else {
    		// log everything
    		$this->mask = (1<<Common\Logger::FATAL_LEVEL + 1) - 1;
    	}
    	
    	if (isset($configuration['tags'])) {
    		$this->tags = is_array($configuration['tags']) ? $configuration['tags'] : array($configuration['tags']);
    	}
    	$returnValue = true;
        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:000000000000183B end

        return (bool) $returnValue;
    }

    /**
     * Logs the item
     *
     * @abstract
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Item item
     * @return mixed
     */
    public abstract function doLog( Item $item);

} /* end of abstract class BaseAppender */

?>