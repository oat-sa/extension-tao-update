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
require_once 'boot/bootstrap.php';

use OatBox\Controller\Request;
use OatBox\Controller\Controller;
use OatBox\Controller\FlowController;
use OatBox\Common\Uri;
use OatBox\Controller\ActionEnforcingException;

$request = new Request();
$controller = new Controller($request);
try {
    $controller->loadModule();
}
catch (ActionEnforcingException $e){
    $flowController = new FlowController();
    $flowController->redirect(ROOT_URL . Uri::url('error404','Error'));
}