
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de Clientes
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li><i class="fa fa-user"></i> Clientes</li>
        <li class="active">Lista de CLientes</li>
      </ol>
    </section>

    
    <section class="content"><!-- Main content -->
     
      <div class="row"> <!-- Info boxes -->
        <div class="col-xs-12 col-sm-12 col-lg-12">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Clientes cadastrados</h3>
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
                  <?php echo form_open('cliente/cadastra_cliente',$attributes); ?>
               -->
                <div class="box">
                  <div class="box-body">
                    <div class="table-responsive">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Código</th>
                            <th>CPF</th>
                            <th>Nome</th>
                            <th>CNPJ</th>
                            <th>Razão Social</th>
                            <th>Nome Fantasia</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                            <th>E-mail</th>
                            <th>CEP</th>
                            <th>Bairro</th>
                            <th>Cidade</th>
                            <th>UF</th>
                            <th>Data de Cadastro</th>
                            <th>status</th>
                            <th>&nbsp;</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(isset($resultadoClientes)){
                            foreach($resultadoClientes as $cliente){ ?>

                              <tr>
                                <td><?php echo $cliente->id ?></td>
                                <td><?php echo $cliente->cpf ?></td>
                                <td><?php echo $cliente->nome ?></td>
                                <td><?php echo $cliente->cnpj ?></td>
                                <td><?php echo $cliente->razaoSocial ?></td>
                                <td><?php echo $cliente->nomeFantasia ?></td>
                                <td><?php echo $cliente->telefone ?></td>
                                <td><?php echo $cliente->celular ?></td>
                                <td><?php echo $cliente->email ?></td>
                                <td><?php echo $cliente->cep ?></td>
                                <td><?php echo $cliente->bairro ?></td>
                                <td><?php echo $cliente->cidade ?></td>
                                <td><?php echo $cliente->uf ?></td>
                                <td><?php echo formata_data($cliente->datacadastro) ?></td>
                                <td><?php echo formata_status($cliente->status) ?></td>
                                <td><a href="consulta_cliente?id=<?php echo $cliente->id; ?>" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a></td>                       
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
                    </div><!-- ./ table-responsive -->
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
