
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cadastro de Produto
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li><i class="fa fa-user"></i> Produtos</li>
        <li class="active">Cadastro de Produtos</li>
      </ol>
    </section>

    
    <section class="content"><!-- Main content -->
     
      <div class="row"> <!-- Info boxes -->
        <div class="col-xs-12 col-sm-12 col-lg-12">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Informe os dados do novo produto</h3><br>
              <?php
                if(isset($msg) && isset($msg_tipo)){
                  set_msg($msg,$msg_tipo);
                }
              ?>
              <?php echo validation_errors();?>
            </div><!-- /.box-header -->            
            <div class="box-body">
              <?php $attributes = array('class' => 'form-horizontal'); ?>
              <?php echo form_open('produto/cadastra_produto',$attributes); ?>
                <div class="box-body">

                  <div class="form-group">
                    <label for="descricaoProduto" class="col-sm-2 control-label">Descrição do Produto</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="descricaoProduto" name="descricaoProduto" placeholder="Informe a descrição do produto" value="<?php echo set_value('descricaoProduto')?>">
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


                  <div class="form-group">
                    <label for="precoCusto" class="col-sm-2 control-label">Preço de Custo - R$</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="precoCusto" name="precoCusto" placeholder="Informe o preço de custo da mercadoria" value="<?php echo set_value('precoCusto')?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="precoVenda" class="col-sm-2 control-label">Preço de Venda - R$</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="precoVenda" name="precoVenda" placeholder="Informe o preço de venda da mercadoria" value="<?php echo set_value('precoVenda')?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="qtdEstoque" class="col-sm-2 control-label">Quantidade em Estoque</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="qtdEstoque" name="qtdEstoque" placeholder="Informe a quantidade em estoque" value="<?php echo set_value('qtdEstoque')?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="descontoPermitido" class="col-sm-2 control-label">Desconto Máximo Permitido - %</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="descontoPermitido" name="descontoPermitido" placeholder="Informe a quantidade em estoque" value="<?php echo set_value('descontoPermitido')?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="alertaEstoque" class="col-sm-2 control-label">Estoque mínimo para alerta</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="alertaEstoque" name="alertaEstoque" placeholder="Informe a quantidade em estoque" value="<?php echo set_value('alertaEstoque')?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="qtdVendaMinima" class="col-sm-2 control-label">Quantidade mínima para venda</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="qtdVendaMinima" name="qtdVendaMinima" placeholder="Informe a quantidade mínima para venda" value="<?php echo set_value('qtdVendaMinima')?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="qtdValorMinimo" class="col-sm-2 control-label">Valor mínimo para venda - R$</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="qtdValorMinimo" name="qtdValorMinimo" placeholder="Informe a quantidade mínima para venda" value="<?php echo set_value('qtdValorMinimo')?>">
                    </div>
                  </div><!-- ./ form-group -->


                </div><!-- ./box-body -->
                <div class="col-xs-12 col-sm-9 col-lg-9">
                  &nbsp;
                </div>
                <div class="col-xs-12 col-sm-3 col-lg-3">
                  <button type="submit" class="btn btn-primary" style="width:100%">Cadastrar</button>
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
        var url = base_url + 'home/buscausuarioperfil'
        $.post(url,{
          idPerfil: idPerfil
        }, function(data){
          $('#resultado').html(data);
        });
      }


    </script>

    <!-- SCRIPT PARA CONSULTAR O CEP E PREENCHER OS DADOS DO FORMULARIO -->
    <script>
      $(document).ready(function() {

        function limpa_formulário_cep() {
          // Limpa valores do formulário de cep.
          $("#rua").val("");
          $("#bairro").val("");
          $("#cidade").val("");
          $("#uf").val("");
        }          
        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {

          //Nova variável "cep" somente com dígitos.
          var cep = $(this).val().replace(/\D/g, '');

          //Verifica se campo cep possui valor informado.
          if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

              //Preenche os campos com "..." enquanto consulta webservice.
              $("#rua").val("...");
              $("#bairro").val("...");
              $("#cidade").val("...");
              $("#uf").val("...");
              $("#ibge").val("...");

              //Consulta o webservice viacep.com.br/
              $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#rua").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#cidade").val(dados.localidade);
                    $("#uf").val(dados.uf);
                    $("#ibge").val(dados.ibge);
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
              });
            } //end if(validacep.test(cep))
            else {
              //cep é inválido.
              limpa_formulário_cep();
              alert("Formato de CEP inválido.");
            }
          } //end if (cep != "")
          else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
          }
        });//end $("#cep").blur(function()
      });//end $(document).ready(function()
    </script>
