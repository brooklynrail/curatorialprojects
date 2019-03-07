<?php

namespace Curatorial;

/**
 * Templates
 * @author Dave M. Giglio <dave.m.giglio@gmail.com>
 */
 
/**
 * Templates
 * templates consist of a name, 
 */
class Templates
{
    
    const TPLDIR   = '/templates/tplfiles/';
    const EDITNAME = 'edit';
    const DISPNAME = 'display';
    
    public static function getTemplates(){
        
        $templates = [
            self::makeTemplate('_none_'),
            self::makeTemplate('banner'),
            self::makeTemplate('exhibition'),
            self::makeTemplate('artists'),
            self::makeTemplate('visit'),
            self::makeTemplate('events'),   
            self::makeTemplate('partners'),
            self::makeTemplate('press'),
            self::makeTemplate('filelist'),
            self::makeTemplate('plain_html'),                                                       
        ];
        
        return $templates;
    }
        
     public static function makeTemplate($name){
        
        $template = new \stdClass;
        
        $template->name = $name;
        $template->edit_file    = self::TPLDIR . $name . '.' . self::EDITNAME . '.html';
        $template->display_file = self::TPLDIR . $name . '.' . self::DISPNAME . '.html';
        
        return $template;
    }   
    

}