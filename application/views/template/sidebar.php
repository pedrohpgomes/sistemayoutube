<?php
  $dadosSession = $this->session->userdata('logged_in');
  $nomeUsuario = $dadosSession['nomeUsuario'];
  $menu_ativo = null;
  if(isset($telaAtiva)){
    $menu_ativo = $telaAtiva;
  }

?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/dist/img/user2.jpg')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $nomeUsuario?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     <!--  <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Pesquisar...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
       <!--  <li class="header">MENU DE NAVEGAÇÃO</li> -->
 
        <li class="treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li>

        <?php if (controleAcessoMenuUsuarios()){ ?>
          <li class="treeview <?php if ($menu_ativo === 'usuarios'){echo 'active';}?> ">
            <a href="#">
              <i class="fa fa-user"></i>
              <span>Usuários</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('home/cadastra_usuario')?>"><i class="fa fa-user-plus"></i> Cadastrar</a></li>
              <li><a href="<?php echo base_url('home/consulta_usuario')?>"><i class="fa fa-users"></i> Consultar</a></li>
              <li><a href="<?php echo base_url('home/lista_usuario')?>"><i class="fa fa-list"></i> Listar</a></li>
            </ul>
          </li>
        <?php } ?>


        <?php if (controleAcessoMenuClientes()){ ?>
          <li class="treeview <?php if ($menu_ativo === 'clientes'){echo 'active';}?> ">
            <a href="#">
              <i class="fa fa-handshake-o"></i>
              <span>Clientes</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('cliente/cadastra_cliente')?>"><i class="fa fa-user-plus"></i> Cadastrar</a></li>
              <li><a href="<?php echo base_url('cliente/consulta_cliente')?>"><i class="fa fa-users"></i> Consultar</a></li>
              <li><a href="<?php echo base_url('cliente/lista_cliente')?>"><i class="fa fa-list"></i> Listar</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php if (controleAcessoMenuProdutos()){ ?>
          <li class="treeview <?php if ($menu_ativo === 'produtos'){echo 'active';}?> ">
            <a href="#">
              <i class="fa fa-cubes"></i>
              <span>Produtos</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('produto/cadastra_produto')?>"><i class="fa fa-plus"></i> Cadastrar</a></li>
              <li><a href="<?php echo base_url('produto/consulta_produto')?>"><i class="fa fa-search"></i> Consultar</a></li>
              <li><a href="<?php echo base_url('produto/lista_produto')?>"><i class="fa fa-list"></i> Listar</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php if (controleAcessoMenuPedidos()){ ?>
          <li class="treeview <?php if ($menu_ativo === 'pedidos'){echo 'active';}?> ">
            <a href="#">
              <i class="fa fa-shopping-bag"></i>
              <span>Pedidos</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('pedido/novo_pedido')?>"><i class="fa fa-plus"></i> Novo</a></li>
              <li><a href="<?php echo base_url('pedido/altera_pedido')?>"><i class="fa fa-pencil-square-o"></i> Alterar</a></li>
              <li><a href="<?php echo base_url('pedido/lista_pedido')?>"><i class="fa fa-list"></i> Listar</a></li>
              <li><a href="<?php echo base_url('pedido/emissao_pedido')?>"><i class="fa fa-money"></i> Emissão</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php if (controleAcessoMenuRelatorios()){ ?>
          <li class="treeview <?php if ($menu_ativo === 'relatorios'){echo 'active';}?> ">
            <a href="#">
              <i class="fa fa-bar-chart"></i>
              <span>Relatórios</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('relatorio/relatorio_clientes')?>"><i class="fa fa-circle-o"></i> Clientes</a></li>
              <li><a href="<?php echo base_url('relatorio/relatorio_produtos')?>"><i class="fa fa-circle-o"></i> Produtos</a></li>
              <li><a href="<?php echo base_url('relatorio/relatorio_pedidos')?>"><i class="fa fa-circle-o"></i> Pedidos</a></li>
            </ul>
          </li>
        <?php } ?>

         <?php if (controleAcessoMenuAgenda()){ ?>
          <li class="treeview <?php if ($menu_ativo === 'agenda'){echo 'active';}?> ">
            <a href="#">
              <i class="fa fa-calendar"></i>
              <span>Agenda</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('agenda/agenda')?>"><i class="fa fa-circle-o"></i> Agenda</a></li>
            </ul>
          </li>
        <?php } ?>




        <li class="treeview">
          <a href="<?php echo base_url('home/requisicaoajax')?>">
            <i class="fa fa-files-o"></i>
            <span>Requisição Ajax</span>
          </a>
        </li>













    </section>
    <!-- /.sidebar -->
  </aside>