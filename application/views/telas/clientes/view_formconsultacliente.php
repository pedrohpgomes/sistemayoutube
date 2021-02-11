
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li><i class="fa fa-user"></i> Produtos</li>
        <li class="active">Consulta de Produto</li>
      </ol>
    </section>

    
    <section class="content"><!-- Main content -->
     
      <div class="row"> <!-- Info boxes -->
        <div class="col-xs-12 col-sm-12 col-lg-12">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Consulta de Produto</h3><br>
              <?php
                if(isset($msg) && isset($msg_tipo)){
                  set_msg($msg,$msg_tipo);
                }
              ?>
              <?php echo validation_errors();?>
            </div><!-- /.box-header -->            
            <div class="box-body">
              <?php $attributes = array('class' => 'form-horizontal'); ?>
              <?php echo form_open('cliente/consulta_cliente',$attributes); ?>
                <div class="box-body">


                  <div class="form-group">
                    <label for="tipoCliente" class="col-sm-2 control-label">Tipo de Cliente</label>
                    <div class="col-sm-5">
                      <input type="radio" class="flat-red" id="pf" onclick="checked_cpf()">
                      <label for="pf" class="control-label">&nbsp;&nbsp;Pessoa Física</label>
                    </div>
                    <div class="col-sm-5">
                      <input type="radio" class="flat-red" id="pj" onclick="checked_cnpj()">
                      <label for="pj" class="control-label">&nbsp;&nbsp;Pessoa Jurídica</label>
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="id" class="col-sm-2 control-label">Código</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="id" name="id" placeholder="Informe um código para consulta" value="<?php echo set_value('id')?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="nome" class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome" value="<?php echo set_value('nome')?>" readonly="readonly">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="cpf" class="col-sm-2 control-label">CPF</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Ex:  999.999.999-99" value="<?php echo set_value('cnpj')?>" readonly="readonly">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="razaoSocial" class="col-sm-2 control-label">Razão Social</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="razaoSocial" name="razaoSocial" placeholder="Informe a Razão Social" value="<?php echo set_value('razaoSocial')?>">
                    </div>
                  </div><!-- ./ form-group -->
                  <div class="form-group">
                    <label for="nomeFantasia" class="col-sm-2 control-label">Nome Fantasia</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nomeFantasia" name="nomeFantasia" placeholder="Informe o nome fantasia do cliente" value="<?php echo set_value('nomeFantasia')?>">
                    </div>
                  </div><!-- ./ form-group -->                  

                  <div class="form-group">
                    <label for="cnpj" class="col-sm-2 control-label">CNPJ</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Ex: 18.888.888/0008-88" value="<?php echo set_value('cnpj')?>">
                    </div>
                  </div><!-- ./ form-group -->

                  

                </div><!-- ./box-body -->
                <div class="col-xs-12 col-sm-9 col-lg-9">
                  &nbsp;
                </div>
                <div class="col-xs-12 col-sm-3 col-lg-3">
                  <button type="submit" class="btn btn-primary" style="width:100%">Consultar</button>
                </div><!-- ./box-footer -->
              <?php echo form_close(); ?>
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
        var url = base_url + 'home/busca_usuario_perfil'
        $.post(url,{
          idPerfil: idPerfil
        }, function(data){
          $('#resultado').html(data);
        });
      }
    </script>
    <script>
      //script para habilitar/desabilitar campos para CNPJ ou CPF
      $(document).ready(function(){

      });
      document.getElementById('pj').checked = true;

      function checked_cnpj(){
        $("#pf").prop("checked", false);
        $("#cpf").prop("disabled", true);
        $("#cpf").prop("readonly", true);
        $("#nome").prop("disabled", true);
        $("#nome").prop("readonly", true);
        $("#cnpj").prop("disabled", false);
        $("#razaoSocial").prop("disabled", false);
        $("#nomeFantasia").prop("disabled", false);

      }

      function checked_cpf(){
        $("#pj").prop("checked", false);
        $("#cpf").prop("disabled", false);
        $("#cpf").prop("readonly", false);
        $("#nome").prop("disabled", false);
        $("#nome").prop("readonly", false);

        $("#razaoSocial").prop("disabled", true);
        $("#nomeFantasia").prop("disabled", true);
        $("#cnpj").prop("disabled", true);
      }

    </script>
