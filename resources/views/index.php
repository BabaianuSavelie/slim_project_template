

<?=$this->fetch('./partials/card.php', ["name" => $name])?>

<ul>
    <?php foreach ($models as $model):?>
    <li><?= $model->name?></li>
    <?php endforeach;?>
</ul>
