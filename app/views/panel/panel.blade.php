<div class="navbar-wrapper">
   	<div>
		<div class="navbar-inverse navbar-static-top" style="background-color:CornflowerBlue;margin-bottom:5px;" role="navigation">
       		<div class="container">
       	     	<div class="navbar-header">
              		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              		<span class="sr-only">Toggle navigation</span>
                	<span class="icon-bar"></span>
                	<span class="icon-bar"></span>
                	<span class="icon-bar"></span>
              		</button>
              		<a class="navbar-brand" href="#">Admin Panel {{ Auth::user()->name }}</a>
            	</div>
            	<div class="navbar-collapse collapse">
              		<ul class="nav navbar-nav">
		                <li><a href="/admin/add"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a></li>
		                <li><a href="/admin/del"><span class="glyphicon glyphicon-remove-sign"></span> Eliminar</a></li>
                    <li><a href="/admin/edit"><span class="glyphicon glyphicon-pencil"></span> Editar</a></li>
		            </ul>
		            <form class="navbar-form navbar-left">
					      	<div class="form-group">
					        	<input class="input-sm" type="text" class="form-control" placeholder="Buscar...">
					    	</div>
					</form>
					<ul class="nav navbar-nav navbar-left">
		               	<li><a href="/logout"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
						</ul>
            	</div>
  			</div>
    	</div> 
      @yield('panel')
  	</div>
</div>