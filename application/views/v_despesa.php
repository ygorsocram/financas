          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?= base_url('include');?>/inicio">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Despesas</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Despesas</div>
              <a id="botao-novo" class="btn btn-success btn-sm" href="<?= base_url('despesa/cadastrar')?>"><i class="font-icon fa fa-plus"></i> Nova</a>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Data</th>
                      <th>Nome</th>
                      <th>Valor</th>
                      <th>Categoria</th>
                      <th>Funções</th>
                    </tr>
                  </thead>
                  <tbody>
      							<?php foreach($despesas -> result() as $despesas): ?>
      								<td class="linha_destaque" data-url="<?= base_url("despesa/editar/{$despesas->id_transacao}")?>"><?= $despesas->data_cadastro; ?></td>
      								<td class="linha_destaque" data-url="<?= base_url("despesa/editar/{$despesas->id_transacao}")?>"><?= $despesas->nome; ?></td>
      								<td class="linha_destaque" data-url="<?= base_url("despesa/editar/{$despesas->id_transacao}")?>"><?= $despesas->valor; ?></td>
      								<td class="linha_destaque" data-url="<?= base_url("despesa/editar/{$despesas->id_transacao}")?>"><?= $despesas->categoria; ?></td>
      								<td width="10px" id="funcoes">
                        <span id="alterar" <i class="fa fa-edit" title="Pagar"></i></span>
      									<span id="alterar" <i class="fa fa-edit" title="Alterar"></i></span>
                        <span id="excluir" <i class="fa fa-user-times" title="Excluir"></i></span>
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
