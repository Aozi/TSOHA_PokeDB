<html>
    <head>
        
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/Search.css" rel="stylesheet">
        <title>Pokemon List</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <table class="table table-hover table-condensed table-striped" style="margin-top: 50px; background: #f7fbfc;">
    <thead>
        <tr>
            <th>Pokemon ID</th>
            <th>Pokemon Name</th>
            <th>Height</th>
            <th>Weight</th>
            <th>HP</th>
            <th>ATK</th>
            <th>DEF</th>
            <th>SP ATK</th>
            <th>SP DEF</th>
            <th>SPD</th>
            <th>EV Yield</th>
            <th>Type</th>
            <th>Move List</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data->Pokemonit as $poke) : ?>
        
        <tr>
            <td><?php echo $poke->getPoke_id(); ?></td>
            <td><?php echo $poke->getPoke_name(); ?></td>
            <td><?php echo $poke->getHeight(); ?></td>
            <td><?php echo $poke->getWeight(); ?></td>
            <td><?php echo $poke->getHP(); ?></td>
            <td><?php echo $poke->getAttack(); ?></td>
            <td><?php echo $poke->getDefense(); ?></td>
            <td><?php echo $poke->getSp_atk(); ?></td>
            <td><?php echo $poke->getSp_def(); ?></td>
            <td><?php echo $poke->getSpeed(); ?></td>
            <td><?php echo $poke->getEv_yield(); ?></td>
            <td><?php echo $poke->getType();?></td>
            <td><button type="submit" value="<?php echo $poke->getPoke_id(); ?>" class="btn collapse-data-btn btn-xs btn-default" data-toggle="collapse" href="#moves<?php echo $poke->getPoke_id(); ?>"><span class="glyphicon glyphicon-chevron-down"></span>Moves</button></td>"
            <?php if (isUserLogged() == 1) : ?>
                <form method="post" action="Search.php">
                    <td><button type="submit" value="<?php echo $poke->getPoke_id(); ?>" name="idToAdd" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-ok"></span> Add</button></td>
                </form>
            <?php endif;?>
        
        <?php endforeach; ?>
    </tbody>
</table> 
    Yhteensä <?php echo $data->maara; ?> Pokemonia. 
    Olet sivulla <?php echo $data->sivu; ?>/<?php echo $data->sivuja; ?>.
    <div></div>
    <?php if ($data->sivuja > 1): ?>
    <a href="Search.php?sivu=<?php echo $data->sivu - 1; ?>">Edellinen sivu</a>
    <?php endif; ?>
    <?php if ($data->sivu < $data->sivuja): ?>
    <a href="Search.php?sivu=<?php echo $data->sivu + 1; ?>">Seuraava sivu</a>
    <?php endif; ?>
    </body>
</html>