
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
              <?php echo form_open('produto/consulta_produto',$attributes); ?>
                <div class="box-body">

                  <div class="form-group">
                    <label for="id" class="col-sm-2 control-label">Código</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="id" name="id" placeholder="Informe um código para consulta" value="<?php echo set_value('id')?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="descricao" class="col-sm-2 control-label">Descrição</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Informa a descrição" value="<?php echo set_value('descricao')?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="unidade" class="col-sm-2 control-label">Unidade</label>
                    <div class="col-sm-4">
                      <select class="form-control" id="unidade" name="unidade">
                        <option value="">Selecione...</option>
                        <?php
                          if(isset($unidade)){
                            foreach($unidade as $item){
                              $desc = retira_acentos("{$item->nome} - {$item->descricao}");
                              $desc = strtoupper($desc);
                              echo "<option value='$item->id'>$desc</option>";
                            }
                          }
                        ?>
                      </select>
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
