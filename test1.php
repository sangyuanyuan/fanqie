<?php
  //   Create   a   new   document   fragment   to   hold   the   new   <parent>   node   
  $parent   =   new   DomDocument;   
  $parent_node   =   $parent ->createElement('item');   
    
  //   Add   some   children   
  $parent_node->appendChild($parent->createElement('image','somevalue'));   
  $parent_node->appendChild($parent->createElement('smallimage','anothervalue'));   
    
  //   Add   the   keywordset   into   the   new   document   
  //   The   $parent   variable   now   holds   the   new   node   as   a   document   fragment   
  $parent->appendChild($parent_node);
  //   Load   the   XML   
  $dom   =   new   DomDocument;   
  $dom->loadXML('lvindex.xml');   
    
  //   Locate   the   old   parent   node   
  $xpath   =   new   DOMXpath($dom);   
  $nodelist   =   $xpath->query('/document/item');   
  $oldnode   =   $nodelist->item(0);
  //   Load   the   $parent   document   fragment   into   the   current   document   
  $newnode   =   $dom->importNode($parent->documentElement,   true);   
    
  //   Replace   
  $oldnode->parentNode->replaceChild($newnode,$oldnode);   
    
  //   Display   
  echo   $dom->saveXML();   
    
?>