<?php
/**  
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
 *               2013 (update and modification) Open Assessment Techonologies SA (under the project TAO-PRODUCT);
 * 
 */

namespace OatBox\Common\Log;
/**
 * Basic Appender that writes into a singel file
 * If the file exceeds maxFileSize the forst half is truncated
 *
 * @access public
 * @author Joel Bout, <joel.bout@tudor.lu>
 * @package common
 * @subpackage log
 */
class SingleFileAppender
    extends BaseAppender
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---

    /**
     * Short description of attribute filename
     *
     * @access protected
     * @var string
     */
    protected $filename = '';

    /**
     * Short description of attribute filehandle
     *
     * @access protected
     * @var resource
     */
    protected $filehandle = null;

    /**
     * %d datestring
     * %m description(message)
     * %s severity
     * %b backtrace
     * %r request
     * %f file from which the log was called
     * %l line from which the log was called
     * %t timestamp
     * %u user
     *
     * @access protected
     * @var string
     */
    protected $format = '%d [%s] \'%m\' %f %l';

    /**
     * maximum size of the logfile in bytes
     *
     * @access protected
     * @var int
     */
    protected $maxFileSize = 1048576;

    // --- OPERATIONS ---

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

        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:0000000000001855 begin
    	if (isset($configuration['file'])) {
    		$this->filename = $configuration['file'];
    	}
    	
    	if (isset($configuration['format'])) {
    		$this->format = $configuration['format'];
    	}
    	
    	if (isset($configuration['max_file_size'])) {
    		$this->maxFileSize = $configuration['max_file_size'];
    	}
    	
    	if (!empty($this->filename)){
    		$returnValue = parent::init($configuration);
        }
    	else{
    		$returnValue = false;
        }
        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:0000000000001855 end

        return (bool) $returnValue;
    }

    /**
     * initialisez the logfile, and checks whenever the file require prunning
     *
     * @access protected
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @return mixed
     */
    protected function initFile()
    {
        // section 127-0-1-1-56e04748:1341d1d0e41:-8000:0000000000001828 begin
        if ($this->maxFileSize > 0 && file_exists($this->filename) && filesize($this->filename) >= $this->maxFileSize) {
        	
        	// need to reduce the file size
        	$file = file($this->filename);
        	$file = array_splice($file, count($file) / 2);
        	$this->filehandle = @fopen($this->filename, 'w');
        	foreach ($file as $line) {
        		@fwrite($this->filehandle, $line);
        	}
        } else {
    		$this->filehandle = @fopen($this->filename, 'a');
        }
        // section 127-0-1-1-56e04748:1341d1d0e41:-8000:0000000000001828 end
    }

    /**
     * Short description of method dolog
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Item item
     * @return mixed
     */
    public function dolog( Item $item)
    {
        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:0000000000001852 begin
    	if (is_null($this->filehandle)) {
    		$this->initFile();
    	}
    	
    	if ($this->filehandle !== false) {
	    	$map = array(
	    			'%d' => date('Y-m-d H:i:s',$item->getDateTime()),
	    			'%m' => $item->getDescription(),
	    			'%s' => $item->getSeverityDescriptionString(),
	    			'%t' => $item->getDateTime(),
	    			'%r' => $item->getRequest(),
	    			'%f' => $item->getCallerFile(),
	    			'%l' => $item->getCallerLine()
	    	);
	    	
	    	if (strpos($this->format, '%b')) {
	    		$map['%b'] = 'Backtrace not yet supported';
	    	}
	    	
	    	$str = strtr($this->format, $map)."\n";
	    	
	    	@fwrite($this->filehandle, $str);
    	}
        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:0000000000001852 end
    }

    /**
     * Short description of method __destruct
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @return mixed
     */
    public function __destruct()
    {
        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:0000000000001850 begin
    	if (!is_null($this->filehandle) && $this->filehandle !== false) {
    		@fclose($this->filehandle);
    	}
        // section 127-0-1-1--13fe8a1d:134184f8bc0:-8000:0000000000001850 end
    }

}