<?php
/* @var $this yii\web\View */
?>
<h1>webcrawler/index</h1>

<br>
<br>

<table class='webcrawlerTable'>
    <thead><tr><th width='200px'>Link</th><th>Kategorie</th></tr></thead>
    <?php foreach ($links as $l): ?>
    <tr><td><?php echo $l->link; ?></td><td><?php echo $l->category->name ?></td></tr>
    <?php endforeach; ?>
</table>

<br>
<br>
<br>

<a href='<?php echo $_SERVER["PHP_SELF"] ?>?r=webcrawler/import'><button>Starte Import</button></a>
