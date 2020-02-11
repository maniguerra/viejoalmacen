<div id="back">

</div>

<div class="login-box" id="body-login">
    
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Ingresar al Sistema</p>

            <form method="post">

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-info btn-block btn-flat">Ingresar</button>
                    </div>
                    <!-- /.col -->
                </div>

                <?php

                    $login = new ControladorUsuarios();
                    $login -> ctrIngresoUsuario();


                 ?>


            </form>


        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->