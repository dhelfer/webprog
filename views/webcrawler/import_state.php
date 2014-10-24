<table border="1">
<?php foreach ($states as $feedId => $feedState): ?>
    <?php foreach ($feedState as $art => $artState): ?>
    <tr>
        <td>
            webcrawler-id: <?php echo $feedId; ?>
        </td>
        <td>
            <?php echo '<font color="'. ($artState ? 'green' : 'red') . '">article-id: ' . $art . '</font>'; ?>
        </td>
    </tr>
    <?php endforeach; ?>
<?php endforeach; ?>
</table>
<br><br><br>
<?= yii\helpers\Html::a('Artikel veröffentlichen', 'index.php?r=webcrawler/confirm'); ?>