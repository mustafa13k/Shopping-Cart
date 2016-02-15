<?php
/**
 * Created by PhpStorm.
 * User: MustafaHusain
 * Date: 6/13/14
 * Time: 3:40 PM
 */
class Paging{

    private $_records;
    private $_numb_of_records;
    private $_numb_of_pages;
    private $_max_per_page;
    private $_current;
    private $_offset = 0;
    private $_last;
    private static $_key = 'pg';
    private $_url;

    public function __construct($records,$max_per_page=3){
        $this->_records = $records;
        $this->_numb_of_records = count($this->_records);
        $this->_max_per_page = $max_per_page;
        $this->_url = Url::getCurrentUrl(self::$_key);
        $current = Url::getParams(self::$_key);
        $this->_current = !empty($current)? $current : 1;
        $this->numberOfPages();
        $this->getOffset();

    }

    public function numberOfPages(){
        $this->_numb_of_pages = ceil($this->_numb_of_records/$this->_max_per_page);
    }

    public function getOffset(){
        $this->_offset = ($this->_current - 1) * $this->_max_per_page;
    }

    public function getRecords(){
        $records = array();
        if($this->_numb_of_pages > 1){
            $last = ($this->_offset + $this->_max_per_page);
            for($i = $this->_offset; $i < $last; ++$i){
                if($i < $this->_numb_of_records){
                    $records[] = $this->_records[$i];
                }
            }
        }else{
            $records = $this->_records;
        }
        return $records;
    }

    private function getLinks(){
        if($this->_numb_of_pages > 1){
            $out = array();

            // first page
            if($this->_current > 1){
                $out[] = "<a href='{$this->_url}'>First</a>";
            }
            else{
                $out[] = "<span>First</span>";
            }



            //Previous Page
            if($this->_current > 1 ){
                //Previous Page number
                $prev = ($this->_current - 1);
                // if previous page number is more than one pass url with parameters else just url
                $url = $prev > 1 ? $this->_url."&amp;".self::$_key."=".$prev:$this->_url;
                $out[] = "<a href='{$url}'>Previous</a>";
            }
            else{
                $out[] = "<span>Previous</span>";
            }

            // Next Page
            if($this->_current!=$this->_numb_of_pages){
                $next = $this->_current + 1;
                $url = $this->_url."&amp;".self::$_key."=".$next;
                $out[] = "<a href='{$url}'>Next</a>";
            }
            else{
                $out[] = "<span>Next</span>";
            }

            //last page
            if($this->_current != $this->_numb_of_pages){
                $url = $this->_url."&amp;".self::$_key."=".$this->_numb_of_pages;
                $out[] = "<a href='{$url}'>Last</a>";
            }
            else{
                $out[] = "<span>Last</span>";
            }

            return "<li>".implode("</li><li>", $out)."</li>";
        }

    }

    public function getPaging(){
        $links = $this->getLinks();
        if (!empty($links)) {
            $out  = "<ul class=\"paging\">";
            $out .= $links;
            $out .= "</ul>";
            return $out;
        }
    }


}