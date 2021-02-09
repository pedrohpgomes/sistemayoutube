
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Requisição Ajax</li>
      </ol>
    </section>

    
    <section class="content"><!-- Main content -->
     
      <div class="row"> <!-- Info boxes -->
        <div class="col-xs-12 col-sm-6 col-lg-3">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Perfil</h3>
            </div><!-- /.box-header -->            
            <div class="box-body">
              <form role="form">
                <div class="form-group"><!-- select -->
                  <select class="form-control" onchange="buscaInfo(this.value)">
                    <option>Selecione...</option>
                    <?php
                      if(isset($resultadoPerfil)){
                        foreach($resultadoPerfil as $perfil){
                          echo "<option value='$perfil->id'>$perfil->descricao</option>";
                        }
                      }
                    ?>
                  </select>
                </div><!-- ./select -->
              </form>
            </div><!-- ./box-body -->
          </div><!-- ./box box-warning -->
        </div><!-- ./col-xs-12 col-sm-6 col-lg-3 -->
        <div class="col-xs-12 col-sm-6 col-lg-3">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Resultado AJAX</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <form role="form">
                <div class="form-group"><!-- textarea -->
                  <label>Textarea</label>
                  <textarea class="form-control" rows="3" id="resultado" name="resultado" placeholder="Selecione o perfil para mais informãções"></textarea>
                </div><!-- ./form-group textarea -->                
              </form>
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
