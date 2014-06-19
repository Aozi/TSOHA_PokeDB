<!DOCTYPE html>
<html>
    <head>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
        <title>My Pokemon</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div class="leftcontainer" style="size: auto;">
            <h1>Pokémon-list</h1>
            <div class="scrollist">
            <table id="pokemonit" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Delete</th>
                        <th>Modify</th>   
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data->Pokemonit as $poke) : ?>
                    <tr>
                        <form method="post" action="AdminPage.php">
                            <td><?php echo $poke->getPoke_id(); ?></td>
                            <td><?php echo $poke->getPoke_name(); ?></td>
                            <td><button type="submit" value="<?php echo $poke->getPoke_id(); ?>" name="idToDelete" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-ok"></span>Remove</button></td>
                            <td><button type="submit" value="<?php echo $poke->getPoke_id(); ?>" class="btn collapse-data-btn btn-xs btn-default" data-toggle="collapse" href="#details<?php echo $poke->getPoke_id(); ?>"><span class="glyphicon glyphicon-chevron-down"></span>Info</button></td>
                    <tr>
                        <td>
                        <div id="details<?php echo $poke->getPoke_id(); ?>" class="collapse">
                            <div class="col-xs-8">
                                <br>Pokemon name: <input type="text" class="form-control" name="<?php echo $poke->getPoke_id(); ?>[]" placeholder="<?php echo $poke->getPoke_name(); ?>">
                            </div>
                            <div class="col-xs-8">
                                <br>Height: <input type="number" min="0" class="form-control" name="<?php echo $poke->getPoke_id(); ?>[]" placeholder="<?php echo $poke->getHeight(); ?>"> 
                            </div>
                            <div class="col-xs-8">
                                <br>Weight: <input type="number" min="0" class="form-control" name="<?php echo $poke->getPoke_id(); ?>[]" placeholder="<?php echo $poke->getWeight(); ?>">
                            </div>
                            <div class="col-xs-8">
                                <br>HP: <input type="number" min="0" class="form-control" name="<?php echo $poke->getPoke_id(); ?>[]" placeholder="<?php echo $poke->getHP(); ?>">
                            </div>
                            <div class="col-xs-8">
                                <br>Attack: <input type="number" min="0" class="form-control" name="<?php echo $poke->getPoke_id(); ?>[]" placeholder="<?php echo $poke->getAttack(); ?>">
                            </div>
                            <div class="col-xs-8">
                                <br>Defense: <input type="number" min="0" class="form-control" name="<?php echo $poke->getPoke_id(); ?>[]" placeholder="<?php echo $poke->getDefense(); ?>">
                            </div>
                            <div class="col-xs-8">
                                <br>SP ATK: <input type="number" min="0" class="form-control" name="<?php echo $poke->getPoke_id(); ?>[]" placeholder="<?php echo $poke->getSp_atk(); ?>">
                            </div>
                            <div class="col-xs-8">
                                <br>SP DEF: <input type="number" min="0" class="form-control" name="<?php echo $poke->getPoke_id(); ?>[]" placeholder="<?php echo $poke->getSp_def(); ?>">
                            </div>
                            <div class="col-xs-8">
                                <br>Speed: <input type="number" min="0" class="form-control" name="<?php echo $poke->getPoke_id(); ?>[]" placeholder="<?php echo $poke->getSpeed(); ?>">
                            </div>
                            <div class="col-xs-8">
                                <br>EV Yield: <input type="number" min="0" class="form-control" name="<?php echo $poke->getPoke_id(); ?>[]" placeholder="<?php echo $poke->getEv_yield(); ?>">
                            </div>
                            <div>
                                <br><button class= "btn btn-lg btn-primary btn-block" name="Save" value="<?php echo $poke->getPoke_id(); ?>" type="submit">Save all!</button>
                            </div>
                            </td>
                    </tr>
                    </tbody>
                    <?php endforeach; ?>
                
            </table>
            </div>
        </div>
        Yhteensä <?php echo $data->maara; ?> Pokemonia. 
        Olet sivulla <?php echo $data->sivu; ?>/<?php echo $data->sivuja; ?>.
        <div></div>
        <?php if ($data->sivuja > 1): ?>
        <a href="AdminPage.php?sivu=<?php echo $data->sivu - 1; ?>">Edellinen sivu</a>
        <?php endif; ?>
        <?php if ($data->sivu < $data->sivuja): ?>
        <a href="AdminPage.php?sivu=<?php echo $data->sivu + 1; ?>">Seuraava sivu</a>
        <?php endif; ?>
    </body>
</html>