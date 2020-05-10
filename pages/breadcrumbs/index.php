<?php
  $first = array_filter(explode('/', $_SERVER['REQUEST_URI']));
  $second = array_splice($first, 2);
  $convToAssoc = function($value) {
    $temp = array_filter(explode('/', $_SERVER['REQUEST_URI']));
    $idx = array_search($value, $temp);
    $url = "/".implode('/', array_splice($temp, 0, $idx));
    return array('title' => ucwords($value), 'url' => $url);
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
