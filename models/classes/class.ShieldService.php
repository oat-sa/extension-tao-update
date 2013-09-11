<?php
/**
 *
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
 *
 * @author "Lionel Lecaque, <lionel@taotesting.com>"
 * @license GPLv2
 * 
 */
class taoUpdate_models_classes_ShieldService extends tao_models_classes_Service{
    /**
     *
     * @access
     * @author "Lionel Lecaque, <lionel@taotesting.com>"
     * @return boolean
     */
    public function unShieldExtensions(){
        $extmanger = common_ext_ExtensionsManager::singleton();
        $extlists = $extmanger->getInstalledExtensions();
        $returnvalue = true;
        foreach (array_keys($extlists) as $ext){
            $returnvalue &= $this->unShield($ext);
        }
        return $returnvalue ;
    }
    
    /**
     *
     * @access
     * @author "Lionel Lecaque, <lionel@taotesting.com>"
     * @return boolean
     */
    public function shieldExtensions(){
        $extmanger = common_ext_ExtensionsManager::singleton();
        $extlists = $extmanger->getInstalledExtensions();
        $returnvalue = true;
        foreach (array_keys($extlists) as $ext){
            $returnvalue &= $this->shield($ext);
        }
        return $returnvalue;
    }
    
    /**
     *
     * @access
     * @author "Lionel Lecaque, <lionel@taotesting.com>"
     * @param unknown $ext
     * @return boolean
     */
    public function shield($ext , $destination){
        $extFolder = ROOT_PATH . DIRECTORY_SEPARATOR . $ext;
    
        helpers_File::copy($extFolder . '/.htaccess', $extFolder . '/htaccess.bak',true,false);
        if(is_file($extFolder . '/htaccess.bak')){
            file_put_contents($extFolder . '/.htaccess', "Options +FollowSymLinks\n"
                . "<IfModule mod_rewrite.c>\n"
                    . "RewriteEngine On\n"
                        . "RewriteCond %{REQUEST_URI} !/" .$destination ." [NC]\n"
                            . "RewriteRule ^.*$ " . ROOT_URL .$destination . " [L]\n"
                                . "</IfModule>");
                                return true;
        }
        else {
            return false;
        }
    }
    
    /**
     *
     * @access
     * @author "Lionel Lecaque, <lionel@taotesting.com>"
     * @param unknown $ext
     * @return boolean
     */
    public function unShield($ext){
        $extFolder = ROOT_PATH . DIRECTORY_SEPARATOR . $ext;
         
        if(unlink($extFolder.'/.htaccess')){
            return helpers_File::copy($extFolder.'/htaccess.bak', $extFolder.'/.htaccess',true,false);
        }
        else {
            common_Logger::e('Fail to remove htaccess in ' . $ext . ' . You may copy by hand file htaccess.bak');
            return false;
        }
    }
}