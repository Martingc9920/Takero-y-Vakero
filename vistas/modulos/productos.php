<!-- php
  if($_SESSION["administrador"] == 0){
    echo '<script>
      window.location = "inicio";
    </script>';
    return;
  }
?> -->
<div class="content-wrapper">
  <section class="content-header">

    <h1>Administrar productos</h1>

    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>    
      <li class="active">Administrar productos</li>    
    </ol>

  </section>

   <section class="content">
    <div class="box">

      <div class="box-header with-border">  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">          
          Agregar producto
        </button>
      </div>
      <div class="box-body">        

       <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">         
       
       <thead>         
         <tr>
           
           <th style="width:10px">#</th>           
           <th>Nombre</th>
           <th>Descripción</th>
           <th>Categoría</th>
           <th>Stock</th>
           <th>Precio</th>           
           <th>Estado</th>           
           <th>Acciones</th>         

         </tr> 


          <!-- MOSTRAR PRODUCTOS -->
          <tbody>         
          <?php
            $item = null;
            $valor = null;
            $productos = ControladorProductos::ctrMostrarProductos($item, $valor);                        
             //var_dump($productos); 
            foreach ($productos as $key => $value) {
              echo  '<tr>
                      <td>'.($key+1).'</td>
                      <td class="text-uppercase">'.$value["nombre_producto"].'</td>
                      <td class="text-uppercase">'.$value["descripcion"].'</td>
                      <td class="text-uppercase">'.$value["nombre_categoria"].'</td>
                      ';
                      if(is_null($value["almacen"])){
                        echo '<td class="text-uppercase">N/A</td>';
                      }else{
                        echo '<td class="text-uppercase">'.$value["almacen"].'</td>';
                      }
                      echo'                      
                      <td class="text-uppercase">'.$value["precio"].'</td>
                      ';
                      if($value["estado_producto"]==1){
                        echo '<td class="text-uppercase">Disponible</td>';
                      }else{
                        echo '<td class="text-uppercase">No disponible</td>';
                      }
                      echo'
                      <td>
                        <div class="btn-group">                            
                          <button class="btn btn-warning btnEditarProducto" idProducto="'.$value["id_producto"].'" data-toggle="modal" data-target="#modalEditarProducto"><i class="fa fa-pencil"></i></button>
                          
                      ';
                          if($_SESSION["administrador"] == 1){
                            echo '<button class="btn btn-danger btnEliminarProducto" idProducto="'.$value["id_producto"].'"><i class="fa fa-times"></i></button>';  
                          }
                        echo '</div>  
                      </td>
                    </tr>';
            }
          ?>          
        </tbody>
       </table>
              <!-- <input type="hidden" value="<?php echo $_SESSION['administrador']; ?>" id="perfilOculto"> -->
      </div>
    </div>
  </section>  
</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar producto</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">              
              <div class="input-group">            
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>                  
                  <option value="">Selecionar categoría</option>
                  <?php
                    $item = null;
                    $valor = null;
                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                    foreach ($categorias as $key => $value) {                    
                      echo '<option value="'.$value["id_categoria"].'">'.$value["nombre_categoria"].'</option>';
                    }
                  ?>  
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                <input type="text" class="form-control input-lg" id="nuevoNombre" name="nuevoNombre" placeholder="Ingresar Nombre" required>
              </div>
            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>
              </div>
            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 
                <input type="number" class="form-control input-lg" name=
                "nuevoStock"  placeholder='Stock ("Opcional")'>
              </div>
            </div>

             <!-- ENTRADA PARA PRECIO -->

             <div class="form-group row">
                <div class="col-xs-6">                
                  <div class="input-group">                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                    <input type="number" class="form-control input-lg" id="nuevoPrecio" name="nuevoPrecio" step="any" min="0" placeholder="Precio" required>
                  </div>
                </div>                                    
              </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar producto</button>
        </div>

      </form>

        <?php

          $crearProducto = new ControladorProductos();
          $crearProducto -> ctrCrearProducto();

        ?>  

    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">  
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar producto</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-align-center"></i></span> 
                <input type="text" class="form-control input-lg" id="editarCategoria" name="editarCategoria"  required readonly>                
              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre"  required>
                <input type="hidden" name="idProducto" id="idProducto" required>                                
              </div>
            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 
                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>
              </div>
            </div>

            <!-- ENTRADA PARA STOCK -->

            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 
                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>
              </div>
            </div>

            <!-- ENTRADA PARA PRECIO -->

            <div class="form-group row">
              <div class="col-xs-6">                
                <div class="input-group">                  
                  <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 
                  <input type="number" class="form-control input-lg" id="editarPrecio" name="editarPrecio" step="any" min="0" required>
                </div>                
              </div>                
            </div>

          </div>           
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

        <?php

          $editarProducto = new ControladorProductos();
          $editarProducto -> ctrEditarProducto();

        ?>      

    </div>

  </div>

</div>

<?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();

?>      



