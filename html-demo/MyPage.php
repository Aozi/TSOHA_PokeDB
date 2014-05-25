<!DOCTYPE html>
<html>
    <head>
        <?php 
            include '../resources/Header.php'; 
        ?>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
        <title>My Pokemon</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div class="leftcontainer">
            <h1>Pokémon-list</h1>
            <div class="scrollist">
            <table id="pokemonit" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Remove from Team</th>
                        <th>Modify</th>
                        <th>Info</th>                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Bulbasaur</td>
                        <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-ok"></span> Remove</button></td>
                        <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-edit"></span Modify</button></td>
                        <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-info-sign"></span> </button></td>

                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Ivysaur</td>
                        <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-ok"></span> Remove</button></td>
                        <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-edit"></span Modify</button></td>
                        <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-info-sign"></span> </button></td>

                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Venusaur</td>
                        <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-ok"></span> Remove</button></td>
                        <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-edit"></span Modify</button></td>
                        <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-info-sign"></span> </button></td>

                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </body>
</html>