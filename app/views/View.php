<?php
class View
{
    private $pageTemplate;
    private $layout;

    public function __construct($pageTemplate, $layout = "default")
    {
        $this->pageTemplate = $pageTemplate;
        $this->layout = $layout;
    } 

 
    public function render($pageData = []):void
    {
        $pathTemp = $this->pageTemplate;
        
		if (file_exists($pathTemp)) {
            ob_start();
			require $pathTemp;
            $content = ob_get_clean();
			require LAYOUT_PATH . $this->layout.'.tpl.php';
		}
    }
} 
?>