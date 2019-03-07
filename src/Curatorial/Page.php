<?php

namespace Curatorial;

/**
 * Page
 * @author Dave M. Giglio <dave.m.giglio@gmail.com>
 */
 
class Page
{
    public $permalink;
    public $name;
    public $keywords;
    public $description;
    public $sections = array();
        
    public function __construct($permalink = false, $live_only = false){
 
        $this->permalink = $permalink;
        
        if($live_only){
            $page_meta = $this->getPageMeta();
            if(!$page_meta || @!$page_meta->live)
                header("Location: http://curatorialprojects.brooklynrail.org/");
        }
        
        if(!$this->permalink){
            $site            = new Site;
            $this->permalink = $site->getHomePermalink();
        }
                
        if(!file_exists($this->thisDir())){
            $site            = new Site;
            $this->permalink = $site->getHomePermalink();        
        }
        
        if(!file_exists($this->dataFile())){
            touch($this->dataFile());
            file_put_contents($this->dataFile(), "{}");   
        }
        
        $data = $this->getPageData();
        
        $this->name        = $data->name; 
        $this->description = $data->description; 
        $this->keywords    = $data->keywords; 
        $this->sections    = $this->getSections();         
    } 

    public function getPageMeta(){
        $section = new Section($this->permalink, 7);        
        return $section;
    }

    public function getSections(){
        
        $sections = array();
        
        
        $sections[0] = new Section($this->permalink, 0);
        $sections[1] = new Section($this->permalink, 1);
        $sections[2] = new Section($this->permalink, 2);
        $sections[3] = new Section($this->permalink, 3);
        $sections[4] = new Section($this->permalink, 4);
        $sections[5] = new Section($this->permalink, 5);
        $sections[6] = new Section($this->permalink, 6);        
        
        $sections[7] = new Section($this->permalink, 7);   
        
        return $sections;
    }
    
    public function save(){
        $did_save = file_put_contents($this->dataFile(), json_encode($this));
        return $did_save;
    }

    public function getPageData(){
        try{
            $data = file_get_contents($this->dataFile());
        }catch(Exception $e){
            $did_save = false;
        } 
        $data = json_decode($data);
        $this->data = $data;
        return $this->data;
    }

    /**
     * directory and file paths
     */
    private function pagesDir(){
        return HOMEPATH . PAGES;
    }

    private function thisDir(){
        return HOMEPATH . PAGES . $this->permalink . '/';
    }
    
    private function dataFile(){
        return HOMEPATH . PAGES . $this->permalink . '/' . DATAFILE;
    } 

}