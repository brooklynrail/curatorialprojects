<?php

namespace Curatorial;

/**
 * Section
 * @author Dave M. Giglio <dave.m.giglio@gmail.com>
 */
 
class Section
{
    
    public $page_permalink;
    public $index;
    
    public $title;
    public $tplfile;
    public $data;
    
    public function __construct($page_permalink = false, $index = false){
        
        if($page_permalink === false)
            throw new \Exception('You can not get a section without a page name.');
        $this->page_permalink = $page_permalink;
        
        if($index === false)
            throw new \Exception('You can not get a section without an index.');        
        $this->index = $index;
        
        if(!file_exists($this->pageDir()))
            return false;
        
        if(!file_exists($this->dataFile())){
            touch($this->dataFile());
            file_put_contents($this->dataFile(), "{}");   
        }
        
        $data = json_decode(file_get_contents($this->dataFile()));
        
        $this->merge($data);
        
        if($this->data == null) $this->data = new \stdClass;      
    }

    public function merge($merge_data){
        foreach($merge_data as $property => $data){
            $this->$property = $data;
        }
    }
    
    public function save(){
        $did_save = file_put_contents($this->dataFile(), json_encode($this));
        if($did_save) self::success($this);
        else          self::failure("Could not save section data because of a server problem.");
    }

    /**
     * success/failure
     */

    private static function success($data){
        $result = new \stdClass;
        $result->success = true;
        $result->data    = $data;
        die(json_encode($result));
    }

    private static function failure($message){
        $result = new \stdClass;
        $result->success = false;
        $result->message = $message;
        die(json_encode($result));
    }
     
    /**
     * directory and file paths
     */
    private function pagesDir(){
        return HOMEPATH . PAGES;
    }

    private function pageDir(){
        return HOMEPATH . PAGES . $this->page_permalink . '/';
    }
    
    private function dataFile(){
        return HOMEPATH . PAGES . $this->page_permalink . '/' . "section.{$this->index}.json";
    } 

}