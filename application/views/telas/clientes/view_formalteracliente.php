
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Atualização de Campos do Cliente
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li><i class="fa fa-user"></i> Clientes</li>
        <li class="active">Atualização de Cliente</li>
      </ol>
    </section>

    
    <section class="content"><!-- Main content -->
     
      <div class="row"> <!-- Info boxes -->
        <div class="col-xs-12 col-sm-12 col-lg-12">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Atualização de Cliente</h3><br>
              <?php
                if(isset($msg) && isset($msg_tipo)){
                  set_msg($msg,$msg_tipo);
                }
              ?>
              <?php echo validation_errors();?>
            </div><!-- /.box-header -->            
            <div class="box-body">
              <?php $attributes = array('class' => 'form-horizontal'); ?>
              <?php echo form_open('cliente/atualiza_cliente',$attributes); ?>
                <div class="box-body">
                  <?php 
                    if(isset($dadosCliente)){
                        $clienteNome = $dadosCliente->nome;
                        $clienteCpf = $dadosCliente->cpf;
                        $clienteCnpj = $dadosCliente->cnpj;
                        $clienteRazaoSocial = $dadosCliente->razaoSocial;
                        $clienteNomeFantasia = $dadosCliente->nomeFantasia;
                        $clienteTelefone = $dadosCliente->telefone;
                        $clienteCelular = $dadosCliente->celular;
                        $clienteEmail = $dadosCliente->email;
                        $clienteCep = $dadosCliente->cep;
                        $clienteRua = $dadosCliente->rua;
                        $clienteNumero = $dadosCliente->numero;
                        $clienteComplemento = $dadosCliente->complemento;
                        $clienteBairro = $dadosCliente->bairro;
                        $clienteCidade = $dadosCliente->cidade;
                        $clienteUf = $dadosCliente->uf;
                                            

                        echo "<input type='hidden' name='id' id='id' value='$dadosCliente->id' />";
                    }

                  ?>

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
                    <label for="nome" class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome" value="<?php echo set_value('nome',$dadosCliente->nome)?>" readonly="readonly">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="cpf" class="col-sm-2 control-label">CPF</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Ex:  999.999.999-99" value="<?php echo set_value('cnpj',$dadosCliente->cpf)?>" readonly="readonly">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="razaoSocial" class="col-sm-2 control-label">Razão Social</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="razaoSocial" name="razaoSocial" placeholder="Informe a Razão Social" value="<?php echo set_value('razaoSocial',$dadosCliente->razaoSocial)?>">
                    </div>
                  </div><!-- ./ form-group -->
                  <div class="form-group">
                    <label for="nomeFantasia" class="col-sm-2 control-label">Nome Fantasia</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nomeFantasia" name="nomeFantasia" placeholder="Informe o nome fantasia do cliente" value="<?php echo set_value('nomeFantasia',$dadosCliente->nomeFantasia)?>">
                    </div>
                  </div><!-- ./ form-group -->                  

                  <div class="form-group">
                    <label for="cnpj" class="col-sm-2 control-label">CNPJ</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Ex: 18.888.888/0008-88" value="<?php echo set_value('cnpj',$dadosCliente->cnpj)?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="telefone" class="col-sm-2 control-label">Telefone Fixo Residencial/Comercial</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Ex: (99)9999-9999" value="<?php echo set_value('telefone',$dadosCliente->telefone)?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="celular" class="col-sm-2 control-label">Celular</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="celular" name="celular" placeholder="Ex: (99)99999-9999" value="<?php echo set_value('celular',$dadosCliente->celular)?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">E-mail</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Ex: cadastro@gmail.com" value="<?php echo set_value('email',$dadosCliente->email)?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="cep" class="col-sm-2 control-label">CEP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="cep" name="cep" placeholder="Ex: 35.900-000" value="<?php echo set_value('cep'),$dadosCliente->cep?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="rua" class="col-sm-2 control-label">Rua</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="rua" name="rua" placeholder="Ex: Rua" value="<?php echo set_value('rua',$dadosCliente->rua)?>" readonly="readonly">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <label for="numero" class="col-sm-2 control-label">Número</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="numero" name="numero" placeholder="Ex: 12345" value="<?php echo set_value('numero',$dadosCliente->numero)?>">
                    </div>
                    <label for="complemento" class="col-sm-2 control-label">Complemento</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Ex: Bloco K, Apto 101" value="<?php echo set_value('complemento',$dadosCliente->complemento)?>">
                    </div>
                  </div><!-- ./ form-group -->

                  <div class="form-group">
                    <!-- BAIRRO -->
                    <label for="bairro" class="col-sm-2 control-label">Bairro</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Ex: Itabira" value="<?php echo set_value('bairro',$dadosCliente->bairro)?>" readonly="readonly">
                    </div>
                    <!-- CIDADE -->
                    <label for="cidade" class="col-sm-1 control-label">Cidade</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Ex: Itabira" value="<?php echo set_value('cidade',$dadosCliente->cidade)?>" readonly="readonly">
                    </div>
                    <!-- UF -->                  
                    <label for="uf" class="col-sm-1 control-label">UF</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="uf" name="uf" placeholder="Ex: MG" value="<?php echo set_value('uf',$dadosCliente->uf)?>" readonly="readonly">
                    </div>
                  </div><!-- ./ form-group -->               

                  

                </div><!-- ./box-body -->
                <div class="col-xs-12 col-sm-9 col-lg-9">
                  &nbsp;
                </div>
                <div class="col-xs-12 col-sm-3 col-lg-3">
                  <button type="submit" class="btn btn-primary" style="width:100%">Alterar</button>
                </div><!-- ./box-footer -->
              <?php echo form_close(); ?>
            </div><!-- ./box-body -->
          </div><!-- ./box box-warning -->
        </div><!-- ./col-xs-12 col-sm-6 col-lg-3 -->  
      </div><!-- /.row -->

    </section><!-- /.content -->


    
    <!-- jQuery 3 -->
    <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
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
    <script>
      //script para habilitar/desabilitar campos para CNPJ ou CPF
      $(document).ready(function(){

      });

      var cpf = '<?php echo $dadosCliente->cpf ?>'
      var cnpj = '<?php echo $dadosCliente->cnpj ?>'
      console.log("cpf "+cpf)
      console.log("cnpj "+cnpj)
      //document.getElementById('pj').checked = true;
      if(cpf != 0 && cpf != null && cpf != undefined){
        document.getElementById('pf').checked = true;
        checked_cpf();
      } else {
        document.getElementById('pj').checked = true;
        checked_cnpj();
      }

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
