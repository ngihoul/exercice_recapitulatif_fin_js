<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Exercice récapitulatif JS - 2021</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <main class="container">
            <h1>Locations</h1>         
            <table id="locations" class="table table-striped">            
            </table>
            <h2>Édition d'une location</h2>
            <form id="edit_location">                
                <div class="form-group">
                    <label for="id">Id</label>
                    <input type="text" id="id" name="id" class="form-control"
                           readonly/>
                </div>
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" id="title" name="title" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="length">Durée (min)</label>
                    <input type="text" id="length" name="length" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="year">Année</label>
                    <input type="text" id="year" name="year" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="user_id">Id Utilisateur</label>
                    <input type="text" id="user_id" name="user_id" class="form-control" />
                </div>
                <button class="btn btn-primary" id="submit_form" data-action="" disabled>Sauvegarder</button>
            </form>
            <form id="show_user">                
                <div class="form-group">
                    <label for="user_id">Id</label>
                    <input type="text" id="user_id" name="user_id" class="form-control"
                           readonly/>
                </div>
                <div class="form-group">
                    <label for="last_name">Nom</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" readonly />
                </div>
                <div class="form-group">
                    <label for="first_name">Prénom</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" readonly />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" readonly />
                </div>
                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" id="login" name="login" class="form-control" readonly />
                </div>
            </form>
        </main>
    </body>
    <!-- <script src="js/main.js" type="text/javascript"></script> -->
    <script src="js/main.js" type="text/javascript"></script>
</html>
