<?php

/**
 * Pager class for creating page links
 * {code}
 * $pager = new Pager(1, 30, "page");
 * $sqlLimit = $pager->getLimit(); //use ful in query
 * echo $pager->getLinks(5000); //get a pagination links for 5000 total records
 * {/code}
 *
 * @author M. Shehzad
 * @since v2.2
 */
class Pager {
    private $pagevar;
    private $currentpage;
    private $perpage;
    private $totalPage;
    private $prevlabel;
    private $nextlabel;
    private $lastlabel;
    private $paginationclass;
    /**
     * create settings
     * @param int $page
     * @param int $perpage
     * @param string $pagevarname
     * @param string $pgclass 
     * @param string $prevlabel
     * @param string $nextlable
     * @param string $lastlable
     */
    function __construct($page=0, $perpage = 30, $pagevarname="page",
            $pgclass="pagination", 
            $prevlabel="&lsaquo; Prev", $nextlable="Next &rsaquo;", 
            $lastlable="Last &rsaquo;&rsaquo;") {
        if(strlen($pagevarname)==0)
            $this->pagevar = "page";
        else
            $this->pagevar = $pagevarname;
        $page = (int)$page;
        if($page<1) {
            $this->currentpage = 1;
        } else {
            $this->currentpage = $page;
        }
        $perpage = (int)$perpage;
        if($perpage<1) {
            $this->perpage = 30;
        } else {
            $this->perpage = $perpage;
        }
        $this->totalPage = 0;
        $this->prevlabel = $prevlabel;
        $this->nextlabel = $nextlable;
        $this->lastlabel = $lastlable;
        $this->paginationclass = $pgclass;
    }
    /**
     * get sql limit e.g.
     * Limit 100, 50
     * @return string
     */
    public function getLimit() {
        return " Limit ".(($this->currentpage-1)*$this->perpage).", ".$this->perpage;
    }
    /**
     * get start point of sql
     * you can use it like "Limit ".$pager->getStart().", 100";
     * @return int
     */
    public function getStart() {
        return ($this->currentpage-1)*$this->perpage;
    }
    /**
     * ceil($totalRec/$perpage)
     * @param int $totalRec
     * @return int 
     */
    public function getTotalPages($totalRec) {
        return ceil($totalRec/$this->perpage);
    }
    /**
     * get the pagination links in string.
     * @param int $totalRec
     * @param string $url if empty then use rebuild_qs method
     * @param string $curclass class of current active link
     * @return string 
     */
    function getLinks($totalRec, $url='', $curclass='active') {
        if(strlen($url)==0)
            $url = $this->rebuild_qs();
        $adjacents = "2";
        
        $prev = $this->currentpage - 1;                         
        $next = $this->currentpage + 1;

        $this->totalPage = ceil($totalRec/$this->perpage);

        $lpm1 = $this->totalPage - 1; // //last page minus 1

        $pagination = "";
        if($this->totalPage > 1){
            $pagination .= "<ul class='{$this->paginationclass}'>";
            //$pagination .= "<li class='page-info'><span>Page {$this->currentpage} of {$this->totalPage}</span></li>";

            if ($this->currentpage > 1) 
                $pagination.= "<li><a href='?{$this->pagevar}={$prev}{$url}'>{$this->prevlabel}</a></li>";

            if ($this->totalPage < 7 + ($adjacents * 2)){  
                for ($counter = 1; $counter <= $this->totalPage; $counter++){
                    if ($counter == $this->currentpage)
                        $pagination.= "<li><a class='".$curclass."'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='?{$this->pagevar}={$counter}{$url}'>{$counter}</a></li>";                   
                }

            } elseif($this->totalPage > 5 + ($adjacents * 2)){
                if($this->currentpage < 1 + ($adjacents * 2)) {

                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                        if ($counter == $this->currentpage)
                            $pagination.= "<li><a class='".$curclass."'>{$counter}</a></li>";
                        else
                            $pagination.= "<li><a href='?{$this->pagevar}={$counter}{$url}'>{$counter}</a></li>";                   
                    }
                    $pagination.= "<li class='dot'><span>...</span></li>";
                    $pagination.= "<li><a href='?{$this->pagevar}={$lpm1}{$url}'>{$lpm1}</a></li>";
                    $pagination.= "<li><a href='?{$this->pagevar}={$this->totalPage}{$url}'>{$this->totalPage}</a></li>"; 

                } elseif($this->totalPage - ($adjacents * 2) > $this->currentpage && $this->currentpage > ($adjacents * 2)) {

                    $pagination.= "<li><a href='?{$this->pagevar}=1{$url}'>1</a></li>";
                    $pagination.= "<li><a href='?{$this->pagevar}=2{$url}'>2</a></li>";
                    $pagination.= "<li class='dot'><span>...</span></li>";
                    for ($counter = $this->currentpage - $adjacents; $counter <= $this->currentpage + $adjacents; $counter++) {
                        if ($counter == $this->currentpage)
                            $pagination.= "<li><a class='".$curclass."'>{$counter}</a></li>";
                        else
                            $pagination.= "<li><a href='?{$this->pagevar}={$counter}{$url}'>{$counter}</a></li>";                   
                    }
                    $pagination.= "<li class='dot'><span>..</span></li>";
                    $pagination.= "<li><a href='?{$this->pagevar}={$lpm1}{$url}'>{$lpm1}</a></li>";
                    $pagination.= "<li><a href='?{$this->pagevar}={$this->totalPage}{$url}'>{$this->totalPage}</a></li>";     

                } else {

                    $pagination.= "<li><a href='?{$this->pagevar}=1{$url}'>1</a></li>";
                    $pagination.= "<li><a href='?{$this->pagevar}=2{$url}'>2</a></li>";
                    $pagination.= "<li class='dot'><span>..</span></li>";
                    for ($counter = $this->totalPage - (2 + ($adjacents * 2)); $counter <= $this->totalPage; $counter++) {
                        if ($counter == $this->currentpage)
                            $pagination.= "<li><a class='".$curclass."'>{$counter}</a></li>";
                        else
                            $pagination.= "<li><a href='?{$this->pagevar}={$counter}{$url}'>{$counter}</a></li>";                   
                    }
                }
            }

                if ($this->currentpage < $counter - 1) {
                    $pagination.= "<li><a href='?{$this->pagevar}={$next}{$url}'>{$this->nextlabel}</a></li>";
                    $pagination.= "<li><a href='?{$this->pagevar}={$this->totalPage}{$url}'>{$this->lastlabel}</a></li>";
                }

            $pagination.= "</ul>";       
        }

        return $pagination;
    }
    
    /**
     *build the query string by removing page var
     * @return string 
     */
    function rebuild_qs() {
        $qs = '';
        if (!empty($_SERVER['QUERY_STRING'])) {
            $parts = explode("&", $_SERVER['QUERY_STRING']);
            $newParts = array();
            foreach ($parts as $val) {
                if (stristr($val, $this->pagevar) == false)  {
                    array_push($newParts, $val);
                }
            }
            if (count($newParts) != 0) {
                $qs = "&".implode("&", $newParts); // this is your new created query string
            }  
        }
        return $qs; 
    } 

}

?>
