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
 * Copyright (c) 2013 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 *
 * @author "Lionel Lecaque, <lionel@taotesting.com>"
 * @license GPLv2
 * @package package_name
 * @subpackage 
 *
 */

namespace app\scripts;

use OatBox\Common\ScriptRunner;
use app\models\UpdateService;
use OatBox\Common\Helpers\File;
use OatBox\Common\Logger;

class OldVersionRestorer extends ScriptRunner {
    
    
    private function getOldRootPath(){
        $service = UpdateService::getInstance();
        $releaseManifest = $service->getReleaseManifest();
        return $releaseManifest['old_root_path'];
    }
    
    protected function preRun() {
        if(!is_writable($this->getOldRootPath())){
            $this->err('Could not restore former version, folder not writable, you may do it by hand',true);
        }
    }
    public function run(){
        $this->out('Move File back');
        File::move(DIR_DATA . 'old/', $this->getOldRootPath());
        mkdir(DIR_DATA . 'old/');
    }
}