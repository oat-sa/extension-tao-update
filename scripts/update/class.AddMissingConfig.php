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
 * Copyright (c) 2014 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 *
 * @author lionel
 * @license GPLv2
 * @package package_name
 * @subpackage 
 *
 */

class taoUpdate_scripts_update_AddMissingConfig extends tao_scripts_Runner {

    public function run() {
        taoUpdate_helpers_ExtensionConfigUpdater::update('taoQtiTest', ROOT_PATH .'taoQtiTest/includes/config.php' );
        taoUpdate_helpers_ExtensionConfigUpdater::update('taoItems', ROOT_PATH .'taoItems/includes/config.php' );
        taoUpdate_helpers_ExtensionConfigUpdater::update('tao', ROOT_PATH .'tao/includes/config.php' );
        taoQtiTest_models_classes_QtiTestService::singleton()->setQtiTestAcceptableLatency('PT5S');
    }
    
}