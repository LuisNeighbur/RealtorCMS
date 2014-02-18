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
                    <li><a href="/admin/newUser"><span class="glyphicon glyphicon-user"></span> Nuevo</a></li>
		            </ul>
		            <div class="navbar-form navbar-left">
					      	<div class="form-group">
					        	<input id="txtSearch" class="input-sm" type="text" class="form-control" placeholder="Buscar...">
					    	</div>
					     </div>
					<ul class="nav navbar-nav navbar-left">
		               	<li><a href="/logout"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
						</ul>
            	</div>
  			</div>
    	</div> 
      <script type="text/javascript">
    
      $('#txtSearch').on('keypress', function(e){
        if((e.which==13)&&($(this).val()!='')){
          window.location = '/search?q=' + encodeURI($(this).val());
        }
      });
    
      </script>
      @yield('panel')
  	</div>
</div>