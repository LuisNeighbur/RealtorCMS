<form class="form-signin" role="form" method="post">
   	 <h2 class="form-signin-heading">Log-In</h2>
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input id="user" name="user" type="text" class="form-control" placeholder="Usuario" autofocus=""/>
    <input id="pass" name="pass" type="password" class="form-control" placeholder="Contraseña"/>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Acceder</button>
</form>
