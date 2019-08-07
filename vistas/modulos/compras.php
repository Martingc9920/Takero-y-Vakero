<div class="content-wrapper">
  <section class="content-header">   
    <h1>Compras </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>  
      <li class="active">Compras</li>    
    </ol>
  </section>
  <section class="content">
    <div class="box">
    <div class="box-body">        
    
       <table class="table table-bordered table-striped dt-responsive tablas " width="100%">         
        <thead>         
         <tr>           
           <th style="width:10px">#</th>
           <th>No. Cuenta</th>
           <th>No. Tienda</th>
           <th>Monto</th>
           <th>Estatus</th>
           <th>Fecha</th>
           <th>Concepto</th>
           <th>Plazo</th>
           <th>MSI</th>
         </tr> 
        </thead>

        <tbody>         
          <?php
            $item = null;
            $valor = null;
            $compras = ControladorCompras::ctrMostrarCompras($item, $valor);
            //var_dump($compras);
            foreach ($compras as $key => $value) {          
                echo  '<tr>
                        <td>'.$value["id_compra"].'</td>
                        <td class="text-uppercase">'.$value["id_cuenta"].'</td>
                        <td class="text-uppercase">'.$value["id_tienda"].'</td>
                        <td class="text-uppercase">'.$value["monto"].'</td>
                        <td class="text-uppercase">'.$value["estatus"].'</td>
                        <td class="text-uppercase">'.$value["fecha"].'</td>
                        <td class="text-uppercase">'.$value["concepto"].'</td>
                        <td class="text-uppercase">'.$value["plazo"].'</td>
                        <td class="text-uppercase">'.$value["msi"].'</td>                                                
                      </tr>';
              }        
            ?>       
        </tbody>
       </table>
      </div>
    </div>
  </section>
</div>




