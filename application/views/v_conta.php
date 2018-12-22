<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
        <a href="<?= base_url('Inicio');?>">Dashboard</a>
      </li>
                <li class="breadcrumb-item active">Contas</li>
          </ol>

          <div class="card mb-3">
            <div class="card-header">
                      <form id="filtro_transacao" action="<?= base_url("conta")?>" method="post">
                          <table>
                            <tr>
                              <th>
                                <label id="data_inicio_relatorio" class="form-label" for="data_inicio">Data Inicio</label>
                              </th>
                              <th>
                                <input class="form-control proximo_campo" id="data_inicio" name="data_inicio" type="date" value= "<?= $data_inicio; ?>" size="80">
                              </th>
                              <th>
                                <label class="form-label" for="data_fim">&nbsp;&nbsp;Data Fim</label>
                              </th>
                              <th>
                                <input class="form-control proximo_campo" id="data_fim" name="data_fim" type="date" value= "<?= $data_fim; ?>" size="80">
                              </th>
                              <th>
                              &nbsp;
                              <button type="submit" class="btn btn-success btn-sm" id="manusear_despesa"><i class="font-icon fas fa-search" title="Pesquisar"></i></button>
                              </th>
                            </tr>
                          </table>
                      </form>
              </div>
          </div>

      <!-- DataTables Example -->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Contas
          <a id="botao_novo_categoria" class="btn btn-success btn-sm" href="<?= base_url("conta/manusear_canta?id=0")?>"><i class="font-icon fa fa-plus"></i> Nova Conta</a>
        </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
                    <th>Nome</th>
                    <th>Saldo</th>
                    <th title="Todas as entradas não pagas - Todas as saidas não pagas (Despesas e Cartão)">Pendente</th>
                    <th title="Se todas as entradas e saidas forem pagas ou recebidas seu saldo ficará nesse valor">Valor Esperado</th>
                    <th>Funções</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($contas -> result() as $contas): ?>
          <tr>
                  <td><?= $contas->nome; ?></td>
                  <td><?= $contas->vlr_saldo; ?></td>
                  <td><?= $contas->vlr_pendente; ?></td>
                  <td><?= $contas->vlr_restante; ?></td>
            <td width="10px" id="funcoes">
              <a href="<?= base_url("conta/acessar_contas")?>"><i class="font-icon fas fa-sign-in-alt" title="Acessar" style="font-size:20px; margin-right: 10px;"></i></a>
      				<a href="<?= base_url("conta/manusear_contas?id={$contas->id_conta}")?>"><i class="font-icon fab fa-autoprefixer" title="Alterar" style="font-size:20px;"></i></a>
              <a href="<?= base_url("conta/excluir?id={$contas->id_conta}")?>"><i class="font-icon fa fa-eraser" style="font-size:20px; margin-left: 10px;" title="Excluir"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
          </tbody>
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>

</div>
<!-- /.container-fluid -->
