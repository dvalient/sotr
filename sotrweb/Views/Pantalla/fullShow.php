<div class="container-fluid"> 
<div class="row">    
    <div class="col-4">
        <div class="p-3 mb-2 bg-danger text-white" >    	

			<h4>Orden de Compra <a href="./?controller=ordencompra&&action=updateshow&&id_oc=<?php  echo $ordencompra->getId()?>" class="btn  btn-danger ml-5">Editar</a>
            <a href="./?controller=ordencompra&&action=califica&&id_oc=<?php  echo $ordencompra->getId()?>" class="btn  btn-danger ml-5">Calificar</a></h4>
            
 		</div>   
        <form>
            <div class="form-group row">
                <label for="text" class="col-sm-3 col-form-label">Número OC: </label>
                <div class="col-sm-8">
	                <input type="text" readonly name="oc_numero" id="oc_numero" class="form-control" value="<?php echo $ordencompra->oc_numero ;?>">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="id_proveedor" class="col-sm-3 col-form-label">Proveedor</label>
                <div class="col-sm-8">
	                <input type="text" readonly name="id_proveedor" id="id_proveedor" class="form-control" value="<?php $pv = oc\Proveedor::searchById($ordencompra->id_proveedor); echo  $pv->getRazonSocial() ;?>">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="pc_numbers" class="col-sm-3 col-form-label">PC Asoc.</label>
                <div class="col-sm-8">
	                <input type="text" readonly name="pc_numbers" id="pc_numbers" class="form-control" value="<?php	echo $listaPC; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="fechae" class="col-sm-3 col-form-label">Emisiòn</label>
                <div class="col-sm-8">
	                <input type="date" readonly name="fechae" id="fechae" class="form-control" value="<?php echo  $ordencompra->fecha_emision ;?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="fechav" class="col-sm-3 col-form-label">Vencimiento</label>
                <div class="col-sm-8">
	                <input type="date" readonly name="fechav" id="fechav" class="form-control" value="<?php echo  $ordencompra->fecha_vencimiento ;?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="gerencia" class="col-sm-3 col-form-label">Gerencia</label>
                <div class="col-sm-8">
	                <input type="text" readonly name="gerencia" id="gerencia" class="form-control" value="<?php $gcia = oc\Gerencia::searchById($ordencompra->id_gerencia); echo $gcia->getNombre() ;?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="sucursal" class="col-sm-3 col-form-label">Sucursal</label>
                <div class="col-sm-8">
	                <input type="text" readonly name="sucursal" id="sucursal" class="form-control" value="<?php $p = oc\Presupuesto::searchById($ordencompra->id_presupuesto); $suc = oc\Sucursal::searchById($p->id_sucursal); echo $suc->getNombres() ;?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="tipogasto" class="col-sm-3 col-form-label">Clase Gasto</label>
                <div class="col-sm-8">
	                <input type="text" readonly name="tipogasto" id="tipogasto" class="form-control" value="<?php $cg = oc\ClaseGasto::searchById($p->id_clasegasto); echo $cg->nombre_cg ;?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="centrocosto" class="col-sm-3 col-form-label">Centro de Costo</label>
                <div class="col-sm-8">
	                <input type="text" readonly name="centrocosto" id="centrocosto" class="form-control" value="<?php $cc = oc\CentroCosto::searchById($p->id_centrocosto); echo $cc->getNombre() ;?>">
                </div>
            </div>

        </form>
    </div>
    <div class="col-8">
    
        <div class="form-group row">
            <div class="col text-danger">

                <h4>Movimientos Asociados</h4>                
			</div>
            <div class="col-xs-4">
                <a class="btn btn-outline-danger" href="./?controller=ordencompra&&action=show">Volver</a>    
            </div>

        </div>
    
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
    <!--                    <th>Id</th> -->
                        <th>Tipo</th>
                        <th>Nro Mov.</th>
                        <th>Nro. Comp.</th>
                        <th>Fecha</th>
                        <th style="text-align: right" >Importe</th>
                        <th style="text-align: right" >Cambio</th>
<!--                        <th>Ac </th>  -->
                    </tr>
                </thead>
    
                <tbody>
                    <?php $sub_factura=0; $subpago=0; foreach ($listaFactCpaq as $factcpaq) {
					//	$factcpaq = oc\FactCpaq::searchByOC(oc\OrdenCompra::searchById($fcxoc->id_oc)->oc_numero);
					?>					
                    <tr style="font-weight:bold">
                        <td><?php echo $factcpaq->codmov; ?></td>
                        <td><?php echo $factcpaq->nromov; ?></td> 
                        <td><?php echo $factcpaq->nroint; ?></td> 
                        <td><?php  $f1 = new DateTime(substr($factcpaq->fchmov,0,12)); echo $f1->format('Y-m-d'); ?></td>
                        <td style="text-align: right"><?php echo number_format($factcpaq->import, 2, ',', '.'); ?></td>
                        <td style="text-align: right" ><?php $t_cambio = oc\FactCpaq::TCambio($factcpaq->codmov, $factcpaq->nromov); echo number_format(($factcpaq->import/ $t_cambio), 2, ',', '.'); ?></td>
                    </tr>
                    	
                    <?php $sub_factura+=($factcpaq->import/ $t_cambio);
						foreach(oc\FactCpaq::SearchByApl($factcpaq->codmov, $factcpaq->nromov) as $factapl){ ?>
						<tr>
							<td><?php echo $factapl->codmov; ?></td>
							<td><?php echo $factapl->nromov; ?></td> 
							<td><?php echo $factapl->nroint; ?></td> 
							<td><?php  $f1 = new DateTime(substr($factapl->fchmov,0,12)); echo $f1->format('Y-m-d'); ?></td>
							<td style="text-align: right" ><?php echo number_format($factapl->import, 2, ',', '.'); ?></td>
							<td><?php //echo $factapl->observ; ?></td>
						</tr>
							
					<?php 	$subpago+=($factapl->import / $t_cambio);}
					} ?>
                </tbody>
            </table>
        </div>

        <div class="input-group input-group-lg">

              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-lg">Monto OC: </span>
              </div>
              <input type="text" style="text-align: right" readonly class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="<?php  echo oc\Moneda::SearchById($ordencompra->id_moneda)->getNombres()." ".number_format($ordencompra->importe, 2, ',', '.');?>">
            </div>

            <div class="input-group input-group-lg">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-lg"><?php echo "Saldo a Facturar: "; ?></span>
              </div>
              <input type="text" style="text-align: right" readonly class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="<?php  echo number_format($ordencompra->importe - $sub_factura, 2, ',', '.');?>">
            </div>

            <div class="input-group input-group-lg">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-lg"><?php echo "Facturado a pagar: "; ?></span>
              </div>
              <input type="text" style="text-align: right" readonly class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="<?php  echo number_format($sub_factura + $subpago, 2, ',', '.');?>">
            </div>

    </div>
</div>    
</div>