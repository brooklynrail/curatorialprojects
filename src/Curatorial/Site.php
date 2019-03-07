<?php

namespace Curatorial;

/**
 * Site
 * @author Dave M. Giglio <dave.m.giglio@gmail.com>
 */

class Site
{
    public $data;
    public $pages = array();

    public function __construct(){

        if(!file_exists($this->dataFile())){
            touch($this->dataFile());
            file_put_contents($this->dataFile(), "[]");
        }
    }

    public function getPages(){

        $pages = array();

        $dirs  = array_filter(glob($this->pagesDir() . '*'), 'is_dir');
        $data  = $this->getSiteData();

        foreach($dirs as $dir){
            $dir     = basename($dir);
            $page    = new Page($dir);
            $pages[] = $page;
        }

        $this->pages = $pages;

        return $pages;
    }

    public function addPage($name, $description){

        if(!$name) return self::failure("You must give a name to the page.");

        $permalink = Helpers::slugify($name);

        $folder = $this->pagesDir() . $permalink;

        // check for pre-existing
        if(file_exists($folder))
            return self::failure("Page already exists! Input '{$name}' was converted to '{$permalink}' which already exists.");
        else{
            $made_dir = mkdir($folder, 0755);
            if(!$made_dir) return self::failure("Page could not be created because of a server error.");
        }

        $page = new Page($permalink);
        $page->name        = $name;
        $page->description = $description;
        $page_saved = $page->save();

        if($page_saved) $this->success($this->getPages());
        else            $this->failure("Could not save page. Server error.");
    }

    public function getSiteData(){
        $data = file_get_contents($this->dataFile());
        $data = json_decode($data);
        $this->data = $data;
        return $this->data;
    }

    public function getArchives(){
        $archives = array();
        $pages = $this->getPages();
        foreach($pages as $k => $page){
            $page_meta = $page->getPageMeta();
            if($page_meta->short_name == "Test Shows") continue;
            if(@$page_meta->live){
                $archive = new \stdClass;
                $archive->page_permalink  = $page_meta->page_permalink;
                $archive->short_name = $page_meta->short_name;
                $archive->position = $page_meta->position;
                $archives[] = $archive;
            }
        }
        $archives = $this->sortArchives($archives);
        return $archives;
    }

    public function sortArchives($archives){
        usort($archives, function($a, $b){
                if ($a->position == $b->position) return 0;
                return ($a->position < $b->position) ? -1 : 1;
            });
        return $archives;
    }

    public function getHomePermalink(){
        $max_position   = 0;
        $home_permalink = 0;
        $pages = $this->getPages();
        foreach($pages as $k => $page){
            $page_meta = $page->getPageMeta();
            if(@$page_meta->live){
                if($max_position < $page_meta->position){
                    $max_position   = $page_meta->position;
                    $home_permalink = $page_meta->page_permalink;
                }
            }
        }
        return $home_permalink;
    }

    /**
     * return results
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
    private static function pagesDir(){
        return HOMEPATH . PAGES;
    }

    private static function dataFile(){
        return HOMEPATH . PAGES . DATAFILE;
    }

}
