<?php
/**
 *读取map列表,将文件名与接口名称存入数组,以api文件名排序
 *
 *试图从_GET中取apiFileName的值，如果没有传这个文件名，那么就给文件名定义为null，如果传了，就把文件名取出来
 *当没有传文件名，页面解析的api内容为全局错误表示法，否则按照文件名读取文件，把md文档中的内容以markdown的形式拿出来保存到apiFileContent
 *
 */

$apiRootPath = './api/api-admin/'; //api文件目录
$apiMapUrl = './api/api-admin.map'; //map文件地址


/**读取map,将map中文件名与接口名称以键值对的形式存储在$mapArray数组中,并按照api文件名排序**/
$mapList = file('./api/api-admin.map');
$mapArray = array();
foreach ($mapList as $key => $value) {
  $mapArray[explode(' ',$value)[0]] = explode(' ',$value)[1];
}
ksort($mapArray);


/**读取api文件内容**/
$apiFileName = !empty($_GET['apiFileName']) ? $_GET['apiFileName'] : null;//从_GET中取出文件名,取不到就赋值null
$apiFileContent = '';//保存文件内容的变量

if($apiFileName === null){
  $apiFileContent = '全局错误码表示法';//无文件就显示全局错误表示法
}

$apiFileContent = file_get_contents($apiRootPath.$apiFileName, 'rb');//取出文件内容

?>
<!doctype html>
<html lang="cn">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="嗨球项目api文档">

  <title>api文档</title>

  <link rel="stylesheet" href="//cdn.bootcss.com/uikit/2.25.0/css/uikit.css"/>
  <link rel="stylesheet" href="./css/uikit.docs.min.css">
  <script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/uikit/2.25.0/js/uikit.js"></script>
  <script src="./js/sticky.js"></script>
  <script>

  </script>
</head>

<body>
<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
  <nav class="uk-navbar uk-margin-large-bottom">
    <a class="uk-navbar-brand uk-hidden-small" href="">文档模块</a>
    <ul class="uk-navbar-nav uk-hidden-small">
      <li class="uk-active">
        <a href="index-api.php">admin模块文档</a>
      </li>
    </ul>
    <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
    <div class="uk-navbar-brand uk-navbar-center uk-visible-small">文档模块</div>
  </nav>



  <div class="uk-grid" data-uk-grid-margin>

    <div class="uk-width-medium-1-4">

      <div class="uk-panel uk-panel-box" data-uk-sticky="{top:35}">
        <ul class="uk-nav uk-nav-side" data-uk-scrollspy-nav="{closest:'li', smoothscroll:true}">
          <li class="uk-nav-header">文档列表</li>

          <?php
          foreach($mapArray as $key => $value){
            $listDOM = $apiFileName === $key ? '<li class="uk-active"><a href="./index-api.php?apiFileName='.$key.'">'.$value.'<small style="color: white">'.$key.'</small></a></li>' :'<li><a href="./index-api.php?apiFileName='.$key.'">'.$value.'<small class="uk-text-muted">'.$key.'</small></a></li>';
            echo $listDOM;
          }
          ?>
        </ul>
      </div>

    </div>

    <div class="uk-width-medium-3-4">

      <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-1-1">
          <h1 class="uk-heading-large"><?php echo empty($mapArray[$apiFileName])?'接口说明':$mapArray[$apiFileName]; ?></h1>
          <p class="uk-text-large"><?php echo $apiFileName; ?></p>
        </div>
      </div>

      <!--文档内容-->
      <?php
      /**
       *将markdown转换为html
       */
      require_once("./lib/Parser.php");
      $apiFileContent = '';
      //$apiFileName = '';
      if(empty($_GET['apiFileName'])){
        $apiFileContent = "
                        这里写阅读本文档的一些说明性的文字
                        ";
      }else{
        $apiFileName = $_GET['apiFileName'];
        $apiFileContent = file_get_contents('./api/api-admin/'.$apiFileName, 'rb');
      }



      $parser = new HyperDown\Parser;
      //$htmlFileContent = "## 你好\n\n **hello**\n";
      echo $parser->makeHtml($apiFileContent);

      unset($apiFileContent);
      ?>

      <!--文档内容-->

    </div>



  </div>
</div>

<div id="offcanvas" class="uk-offcanvas">
  <div class="uk-offcanvas-bar">
    <ul class="uk-nav uk-nav-offcanvas">
      <li  class="uk-active">
        <a href="api-admin.php">admin模块文档</a>
      </li>
      <li>
        <a href="">home模块文档</a>
      </li>

    </ul>
  </div>
</div>
</body>
<script>
  $('table').addClass('uk-table uk-table-striped');
</script>
</html>
