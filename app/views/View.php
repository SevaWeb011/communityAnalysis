<?php
class View
{
    public function render($pageTemplate, $pageData)
    {
        include ROOT. $pageTemplate;
    }
}
?>