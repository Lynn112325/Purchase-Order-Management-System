<?php

class Controller {
    private $viewname;
    private $viewData;

    public function __construct($viewname, $viewData = null) {
        $this->viewname = $viewname;
        $this->viewData = $viewData;
    }

    public function setViewData($viewData) {
        $this->viewData = $viewData;
        var_dump($this->viewData);
    }
    
    public function render($role="") {
        // View::render($this->viewname, $this->data);
        View::render($role.$this->viewname, $this->viewData);
    }
}

?>