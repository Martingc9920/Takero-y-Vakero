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

    <h1>Administrar Insumos</h1>

    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>    
      <li class="active">Administrar Insumos</li>    
    </ol>

  </section>

   <section class="content">
    <div class="box">

      <div class="box-header with-border">  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarInsumo">          
          Agregar insumos
        </button>
      </div>
      <div class="box-body">        

        <!--Tabla-->
       <table class="table table-bordered table-striped dt-responsive tablaInsumos"  width="100%">         
        
       <thead>         
         <tr>
           
         <th style="width:10px">#</th>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Medición</th>
                  <th>Insumo Mínimo</th>                  
                  <th>Acciones</th>                  
                </tr>
                </thead>


          <!-- MOSTRAR INSUMOS -->
          <tbody>
          <?php
          $item= null;
          $valor= null;
          $insumos=ControladorInsumos::ctrMostrarInsumos($item, $valor);
          //var_dump($insumos);
          foreach ($insumos as $key => $value) {
            echo' <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["nombre_insumo"].'</td>
                    <td>'.$value["cantidad"].'</td>
                    <td>'.$value["nombre_medicion"].'</td>                                      
                    <td>'.$value["insumo_minimo"].'</td>
                    <td>
                        <div class="btn-group">                            
                          <button class="btn btn-warning btnEditarInsumo" idInsumo="'.$value["id_insumo"].'" data-toggle="modal" data-target="#modalEditarInsumo"><i class="fa fa-pencil"></i></button>                                               
                          <button class="btn btn-danger btnEliminarInsumo" idInsumo="'.$value["id_insumo"].'"><i class="fa fa-times"></i></button>                          
                        </div>  
                      </td>
                    </tr>';
            }
          ?>          
        </tbody>
       </table>
      </div>
    </div>
  </section>
</div>

<!--=====================================
MODAL AGREGAR INSUMO
======================================-->

<div id="modalAgregarInsumo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar insumo</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">
            
            <!-- ENTRADA PARA EL NOMBRE INSUMO-->
            
            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                <input type="text" class="form-control input-lg" id="nuevoNombre" name="nuevoNombre" placeholder="Ingresar Nombre Insumo" required>
              </div>
            </div>

            <!-- ENTRADA PARA CANTIDAD -->

            <div class="form-group row">
                <div class="col-xs-6">                
                  <div class="input-group">                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                    <input type="number" class="form-control input-lg" id="nuevaCantidad" name="nuevaCantidad" step="any" min="0" placeholder="Cantidad" required>
                  </div>
                </div>                                    
            </div>

              <!-- ENTRADA PARA SELECCIONAR MEDICIÓN-->

            <div class="form-group">              
              <div class="input-group">            
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <select class = "form-control input-lg" name="nuevaMedicion" id="nuevaMedicion">                  
                  <option value="">Selecionar Medicion</option>
                 <?php

                 $item = null;
                 $valor= null;
                 $mediciones = ControladorInsumos::ctrMostrarMediciones($item, $valor);
                    foreach ($mediciones as $key => $value) {                    
                      echo '<option value="'.$value["id_medicion"].'">'.$value["nombre_medicion"].'</option>';
                    }
                  ?>  
                </select>
              </div>
            </div>           

             <!-- ENTRADA PARA INSUMO MINIMO -->

             <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 
                <input type="number" class="form-control input-lg" name="nuevoMinimo" id="nuevoMinimo"  placeholder='Insumo minimo'>
              </div>
            </div>            

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar insumo</button>
        </div>

      </form>

        <?php

          $crearInsumos = new ControladorInsumos();
          $crearInsumos -> ctrCrearInsumos();

        ?>  

    </div>
  </div>
</div>







<!--=====================================
MODAL EDITAR INSUMO
======================================-->

<div id="modalEditarInsumo" class="modal fade" role="dialog">  

<div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar insumo</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">
            
            <!-- ENTRADA PARA EL NOMBRE INSUMO-->
            
            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre"  required>
              </div>
            </div>

            <!-- ENTRADA PARA CANTIDAD -->

            <div class="form-group row">
                <div class="col-xs-6">                
                  <div class="input-group">                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                    <input type="number" class="form-control input-lg" id="editarCantidad" name="editarCantidad" step="any" min="0" required>
                  </div>
                </div>                                    
            </div>

              <!-- ENTRADA PARA SELECCIONAR MEDICIÓN-->

            <div class="form-group">              
              <div class="input-group">            
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <select class = "form-control input-lg" name="editarMedicion" >                  
                  <option id="editarMedicion"></option>
                 <?php

                 $item = null;
                 $valor= null;
                 $mediciones = ControladorInsumos::ctrMostrarMediciones($item, $valor);
                    foreach ($mediciones as $key => $value) {                    
                      echo '<option value="'.$value["id_medicion"].'">'.$value["nombre_medicion"].'</option>';
                    }
                  ?>  
                </select>
              </div>
            </div>           

             <!-- ENTRADA PARA INSUMO MINIMO -->

             <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 
                <input type="number" class="form-control input-lg" name="editarMinimo" id="editarMinimo"  >
              </div>
            </div>            

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary" name="editarInsumo" id="editarInsumo" >Guardar insumo</button>
        </div>

      </form>

        <?php

    
          $editarInsumos = new ControladorInsumos();
          $editarInsumos -> ctrEditarInsumos();

        ?>      

    </div>

  </div>

</div>

<?php

  $eliminarInsumos = new ControladorInsumos();
  $eliminarInsumos -> ctrEliminarInsumos();

?> 