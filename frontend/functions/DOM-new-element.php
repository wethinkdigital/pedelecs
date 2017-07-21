<?php
function getHTMLById($id)
{
    $xpath = new DOMXPath($this->domDocument);
    return $xpath->query("//*[@id='$id']")->item(0);
}?>