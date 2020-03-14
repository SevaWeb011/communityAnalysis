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


    public function render($pageData) 
    {
        $pathTemp = $this->pageTemplate;
		if (file_exists($pathTemp)) {
            ob_start();
			require $pathTemp;
			$content = ob_get_clean();
			require TEMPLATE_LAYOUT . $this->layout.'.tpl.php';
		}
    }
}
?>