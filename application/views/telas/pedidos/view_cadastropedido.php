
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cadastro de Pedidos
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li><i class="fa fa-user"></i> Pedidos</li>
        <li class="active">Cadastro de Pedidos</li>
      </ol>
    </section>

    
    <section class="content"><!-- Main content -->
     
      <div class="row"> <!-- Info boxes -->
        <div class="col-xs-12 col-sm-12 col-lg-12">
          <div class="box box-warning">
            <div class="box-header with-border">
              <!--<h3 class="box-title">Informe os dados do novo pedido</h3>-->
              <br>
              <?php
                if(isset($msg) && isset($msg_tipo)){
                  set_msg($msg,$msg_tipo);
                }
              ?>
              <?php echo validation_errors();?>
            </div><!-- /.box-header -->            
            <div class="box-body">
              <?php $attributes = array('class' => 'form-horizontal'); ?>
              <?php echo form_open('produto/cadastra_pedido',$attributes); ?>
                <div class="box-body">

                   <div class="form-group">
                  <label for="clienteId" class="col-sm-2 control-label">ID do Cliente</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="clienteId" name="clienteId" placeholder="Informe o ID do cliente" value="<?php echo set_value('clienteId')?>">
                  </div>
                  <div class="col-sm-6"></div>
                </div><!-- ./ form-group -->

                <div class="form-group">
                  <label for="cliente" class="col-sm-2 control-label">Cliente</label>
                  <div class="col-sm-4">
                    <select class="form-control" id="cliente" name="cliente">
                      <option value="">Selecione...</option>
                      <?php
                        if(isset($clientes)){
                          foreach($cliente as $cliente){
                            $desc = retira_acentos("{$cliente->nome}");
                            $desc = strtoupper($desc);
                            echo "<option value='$cliente->id'>$desc</option>";
                          }
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-sm-6"></div>
                </div><!-- ./ form-group -->

                <div class="form-group">
                  <label for="codigoPedido" class="col-sm-2 control-label">Código do Pedido</label>
                  <div class="col-sm-4">
                    <?php
                      $codigoPedido = ("YmdHis");
                    ?>
                    <input type="text" class="form-control" id="precoVenda" name="codigoPedido" value="<?php echo set_value('codigoPedido',$codigoPedido)?>">
                  </div>
                  <div class="col-sm-6"></div>
                </div><!-- ./ form-group -->

                <div class="form-group">
                  <label for="valorBruto" class="col-sm-2 control-label">Valor Bruto - R$</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="valorBruto" name="valorBruto" placeholder="R$ 0.00" value="<?php echo set_value('valorBruto')?>">
                  </div>
                  <div class="col-sm-6"></div>
                </div><!-- ./ form-group -->

                <div class="form-group">
                  <label for="valorLiquido" class="col-sm-2 control-label">Valor Líquido - R$</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="valorLiquido" name="valorLiquido" placeholder="R$ 0.00" value="<?php echo set_value('valorBruto')?>">
                  </div>
                  <div class="col-sm-6"></div>
                </div><!-- ./ form-group -->       

                 

                </div><!-- ./box-body -->
                <div class="d-flex justify-content-center">
                  <div class="col-sm-6">&nbsp;</div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary" style="width:50%">Cadastrar</button>
                  </div>
                </div>
              <?php echo form_close(); ?>
            </div><!-- ./box-body -->
          </div><!-- ./box box-warning -->
        </div><!-- ./col-xs-12 col-sm-6 col-lg-3 -->  
      </div><!-- /.row -->










       <div class="row"> <!-- Info boxes -->
        <div class="col-xs-12 col-sm-12 col-lg-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Lista de Pedidos</h3>
              <br>
            </div><!-- /.box-header -->            
            <div class="box-body">
              <!--<?php $attributes = array('class' => 'form-horizontal'); ?>
                  <?php echo form_open('home/cadastra_usuario',$attributes); ?>
               -->
                <div class="box">
                  <div class="box-body">
                    <div class="table-responsive">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Cód.Produto</th>
                            <th>Descrição</th>
                            <th>Valor Mercadoria</th>
                            <th>Valor Venda</th>
                            <th>Qtd.Estoque</th>
                            <th>Desconto</th>
                            <th>&nbsp;</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(isset($resultadoProdutos)){
                            foreach($resultadoProdutos as $produtos){ ?>

                              <tr>
                                <td><?php echo $produtos->id ?></td>
                                <td><?php echo $produtos->descricao ?></td>
                                <td><?php echo $produtos->precocusto ?></td>
                                <td><?php echo $produtos->precovenda ?></td>
                                <td><?php echo $produtos->qtdestoque ?></td>

                                <td><?php
                                      if($produtos->descontopermitido > 0){ ?>
                                        <input type='text' name="desconto<?php echo $produtos->id;?>" id="desconto<?php echo $produtos->id;?>" value="0"> <?php
                                      } else { ?>
                                        <input type='text' name="desconto<?php echo $produtos->id;?>" id="desconto<?php echo $produtos->id;?>" value="0" readonly="readonly"> <?php
                                      }                                        
                                    ?>  
                                </td>
                                <td>
                                  <input type="hidden" name="produtoId<?php echo $produtos->id;?>" id="produtoId<?php echo $produtos->id;?>" value="<?php echo set_value('produtoId{$produtos->id}')?>">
                                  <a href="consulta_pedido?id=<?php echo $produtos->id; ?>" title="Editar"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                  </td>                             
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
                    </div><!-- ./table-responsive -->
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
    <script>
      var base_url = '<?php echo base_url() ?>'
      $(document).ready(function(){

      });

      function buscaInfo(idPerfil){
        var idPerfil = idPerfil
        var url = base_url + 'home/buscausuarioperfil'
        $.post(url,{
          idPerfil: idPerfil
        }, function(data){
          $('#resultado').html(data);
        });
      }


    </script>

    <!-- DataTables -->
    <script>
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
