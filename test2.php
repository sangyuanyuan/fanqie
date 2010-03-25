<?

$doc=new DOMDocument("1.0","gb2312");  #声明文档类型   
$doc->formatOutput=true;               #设置可以输出操作   
  
#声明根节点，最好一个XML文件有个跟节点   
$root=$doc->createElement("URL");    #创建节点对象实体    
$root=$doc->appendChild($root);      #把节点添加进来   
     
   # for($i=1;$i<100;$i++){  //循环生成节点，如果数据库调用出来就改这里
   
     
   $info=$doc->createElement("Image_Information");  #创建节点对象实体   
   $info=$root->appendChild($info);    #把节点添加到root节点的子节点   
            
        $name=$doc->createElement("img_name");    #创建节点对象实体          
        $name=$info->appendChild($name);   
          
        $sex=$doc->createElement("img_link");   
        $sex=$info->appendChild($sex);
        
        $thumb=$doc->createElement("thumb_image");   
        $thumb=$info->appendChild($thumb); 
          
        $name->appendChild($doc->createTextNode("adevy001"));  #createTextNode创建内容的子节点，然后把内容添加到节点中来      
        $sex->appendChild($doc->createTextNode("http://www.163.com"));
        $thumb->appendChild($doc->createTextNode("images/newscenter.jpg")); 
  # }      
   $doc->save("/subject/sxxx2/imglink.xml"); #保存路径eg d:/temp   
?>