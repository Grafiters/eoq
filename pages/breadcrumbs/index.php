<?php
  $first = array_filter(explode('/', $_SERVER['REQUEST_URI']));
  $second = array_splice($first, 2);
  $convToAssoc = function($value) {
    $temp = array_filter(explode('/', $_SERVER['REQUEST_URI']));
    $foo = array_filter($temp , function($val){
      if (strpos($val, '?')===false) {
        return $val;
      }
    }); 
    $idx = array_search($value, $foo);
    $url = "/".implode('/', array_splice($temp, 0, $idx));
    $title = strpos($value, '.php') === false ? $value : explode('.php', $value)[0];
    return array('title' => ucwords($title), 'url' => $url);
  };
  $paths = array_map($convToAssoc, $second);
?>
<ol class="breadcrumb float-sm-right">
  <?php foreach ($paths as $id => $path): ?>
    <?php if ($id < sizeof($paths) -1): ?>
      <li class="breadcrumb-item">
        <a href="<?= $path['url'] ?>">
          <?= $path['title'] ?>
        </a>
      </li>
    <?php else: ?>
      <li class="breadcrumb-item active">
      <?= $path['title'] ?>
      </li>
    <?php endif; ?>
  <?php endforeach; ?>
</ol>
