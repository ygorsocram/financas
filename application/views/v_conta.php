<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
        <a href="<?= base_url('Inicio');?>">Dashboard</a>
      </li>
                <li class="breadcrumb-item active">Contas</li>
          </ol>

      <!-- DataTables Example -->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Contas
          <a id="botao_novo" class="btn btn-success btn-sm" href="<?= base_url("conta/manusear_canta?id=0")?>"><i class="font-icon fa fa-plus"></i> Nova Conta</a>
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
