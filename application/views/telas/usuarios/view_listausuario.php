
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de Usuários
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li><i class="fa fa-user"></i> Usuários</li>
        <li class="active">Lista de Usuários</li>
      </ol>
    </section>

    
    <section class="content"><!-- Main content -->
     
      <div class="row"> <!-- Info boxes -->
        <div class="col-xs-12 col-sm-12 col-lg-12">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Usuários cadastrados</h3>
              <br>
              <?php
                if(isset($msg) && isset($msg_tipo)){
                  set_msg($msg,$msg_tipo);
                }
              ?>
              <?php echo validation_errors();?>
            </div><!-- /.box-header -->            
            <div class="box-body">
              <!--<?php $attributes = array('class' => 'form-horizontal'); ?>
                  <?php echo form_open('home/cadastra_usuario',$attributes); ?>
               -->
                <div class="box">
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Código</th>
                          <th>Nome do Usuário</th>
                          <th>Login</th>
                          <th>E-mail</th>
                          <th>Data de Cadastro</th>
                          <th>Perfil</th>
                          <th>status</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(isset($resultadoUsuarios)){
                          foreach($resultadoUsuarios as $usuario){ ?>

                            <tr>
                              <td><?php echo $usuario->id ?></td>
                              <td><?php echo $usuario->nome ?></td>
                              <td><?php echo $usuario->login ?></td>
                              <td><?php echo $usuario->email ?></td>
                              <td><?php echo formata_data($usuario->datacadastro) ?></td>
                              <td><?php echo formata_perfil_id($usuario->perfilid) ?></td>
                              <td><?php echo formata_status($usuario->status) ?></td>
                              <td><a href="consulta_usuario?id=<?php echo $usuario->id; ?>" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a></td>                             
                            </tr>
                          <?php }
                        }?>
                      </tbody>
                      <!--<tfoot>
                      <tr>
                        <th>Nome do Usuário</th>
                        <th>Login</th>
                        <th>E-mail</th>
                        <th>Data de Cadastro</th>
                        <th>Perfil</th>
                        <th>status</th>
                      </tr>
                      </tfoot> -->
                    </table>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              <!--<?php echo form_close(); ?> -->
            </div><!-- ./box-body -->
          </div><!-- ./box box-warning -->
        </div><!-- ./col-xs-12 col-sm-6 col-lg-3 -->  
      </div><!-- /.row -->
    </section><!-- /.content -->


    
    <!-- jQuery 3 -->
    <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
    
    <!-- Meus scripts -->
    <script>
      var base_url = '<?php echo base_url() ?>'

      $(document).ready(function(){

      })

      $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false
        })
      })
    </script>
