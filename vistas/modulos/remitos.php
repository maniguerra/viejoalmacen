<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper h-100">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Remitos<small> - Viejo Almacén</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><i class="far fa-id-card"></i></li>
                        <li class="breadcrumb-item active">Remitos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card" >
           
            <div class="card-body">
				<form action="">
					<div class="row">
						<div class="col-6">


							<!-- Select de Cliente -->
							<div class="row">
								<div class="col-12 mb-5">
									<div class="input-group">

										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i
													class="fa fa-user"></i></span>
										</div>
										
										<select class="form-control" name="select-cliente" id="select-cliente" idCliente required >
											<option value="">Seleccionar Cliente</option>
											
											
										<?php 
																
											$item = null;
											$valor = null;
											$clientes = ControladorClientes::ctrMostrarClientes($item,$valor);

											foreach ($clientes as $key => $value){
													echo '<option value="'.$value["id"].'">'.$value["establecimiento"].' - Municipalidad de '.$value["municipio"].' - Partido de '.$value["partido"].'</option>';
											}

											
											?>

										</select>
										
									</div>
								</div>
                			</div>
               

							<!-- Datos Comedor -->				
							<div class="row">
									<!-- Checkbox comedor -->
									<div class="col-3 form-group">
											<div class="icheck-success">
												<input  type="checkbox" id="check-comedor" name="check-comedor">
												<label  class="text-dark" for="check-comedor">&nbsp;Comedor</label>
											</div>
									</div>
									
									<!-- Select Menu Comedor-->
									<div class="col-6">
										<div class="input-group">

											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1"><i class="fas fa-hamburger"></i></span>
											</div>
											<select class="form-control ml-2" name="select-comedor" id="select-comedor" disabled>
												<option value="">Seleccionar Menu Comedor</option>
											</select>

										</div>	
									</div>

									<!-- Input cupos Comedor-->
									<div class="col-3">
											<input class="form-control" type="number" placeholder="0" id="cupos-comedor" readonly>
											<span class="small text-muted">Cupos Comedor</span>
									</div>
							</div>
				
							<!-- Datos DMC -->
							<div class="row mt-4">
										<!-- Checkbox DMC-->
									<div class="col-3 form-group">
											<div class="icheck-danger">
												<input  type="checkbox" id="check-dmc" name="check-dmc">
												<label  class="text-dark" for="check-dmc">&nbsp;DMC</label>
											</div>
									</div>

									<!-- Select Menu DMC-->
									<div class="col-6">
										<div class="input-group">

												<div class="input-group-prepend">
													<span class="input-group-text" id="basic-addon1"><i class="fas fa-hotdog"></i></span>
												</div>
												<select class="form-control ml-2" name="select-dmc" id="select-dmc" disabled>
													<option value="">Seleccionar Menu DMC</option>
												</select>
										</div>
									</div>

									<!-- Input cupos DMC-->
									<div class="col-3">
											<input class="form-control" type="number" placeholder="0" id="cupos-dmc" readonly>
											<span class="small text-muted">Cupos DMC</span>
									</div>
							</div>

							<!-- Selecionar Fecha -->
							<div class="row">
								<div class="col-4 mt-4">

									
									<div class="input-group">

										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="far fa-calendar-alt"></i></span>
										</div>
										<input type="date" class="form-control" id="datePicker">
										<input type="hidden" id="dia">
										<input type="hidden" id="mes">
										<input type="hidden" id="ano">
										
									</div>
									<span class="small text-muted">Seleccione la fecha del remito</span>
								</div>
							</div>
							
						</div>
						</form>		

						<!-- ACA VAN LOS DATOS DEL REMITO -->
						<div class="col-6 contenidoRemito">

								<div id="encabezado">
									<div class="row">
										<div class="col-4">
											<div id="partido"></div>
										</div>

										<div class="col-4">
											<div id="municipio"></div>
										</div>

										<div class="col-4">
											<div id="organo"></div>
										</div>
									</div>

									<div class="row">
										<div class="col-4">
											<div id="establecimiento"></div>
										</div>
										<div class="col-4">
											<div id="cuit"></div>
										</div>
										<div class="col-4">
											<div id="tipo"></div>
										</div>
									</div>
									<hr>
									
									<div class="row">
										<div class="col-3">
											<div id="cuposComedor"></div>
										</div>
										<div class="col-3">
											<div id="cuposDmc"></div>
										</div>
										<div class="col-3">
											
										</div>
										<div class="col-3">
											<div id="fecha"></div>
										</div>
									</div>
									<hr>

								</div>

								<div id="remito">
											
								</div>

								
						</div>
						

					</div>
            <!-- /.card-body -->
			</div>

			<div class="card-footer">
			
					<div class="row">
						<div class="col-6">
							<!-- BOTON PARA CARGAR LOS DATOS DEL REMITO -->
							<button type="button" class="btn btn-lg btn-success float-right btnCrearRemito"><i class="fas fa-file-upload mr-2"></i>Cargar Remito</button>
						</div>

						<div class="col-6">
							<!-- BOTON PARA IMPRIMIR REMITO -->
							<button type="button" class="btn btn-lg btn-danger float-right  btnImprimirRemito"><i class="fa fa-print mr-2"></i>Imprimir Remito</button>
						</div>

					</div>
								
			</div>
					

				
         
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>