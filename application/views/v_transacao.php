          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?= base_url('include');?>/inicio">Dashboard</a>
            </li>
                <li class="breadcrumb-item active"><?= $nome_tipo; ?></li>
          </ol>

          <!-- Alteração dos meses
          <ol class="breadcrumb">
                <div class="card-header">Filtros</div>
                <form action="<?= base_url('transacao/filtrar?id_tipo=1');?>" method="post">
                  <div id="filtrar">
                      <fieldset class="form-group">
                        <label class="form-label" for="data_inicio">Data Início</label>
                        <input class="form-control proximo_campo" id="data_inicio" name="data_inicio" type="date" value= "<?= $data_inicio; ?>" placeholder="Data" size="80">
                      </fieldset>
                  </div>
                  <div id="filtrar">
                      <fieldset class="form-group">
                        <label class="form-label" for="data_fim">Data Fim</label>
                        <input class="form-control proximo_campo" id="data_fim" name="data_fim" type="date" value= "<?= $data_fim; ?>" placeholder="Data" size="80">
                      </fieldset>
                  </div>
                        <li>
                            <button type="submit" class="btn btn-inline btn-success pull-right" id="filtrar">Filtrar</button>
                        </li>
                </form>
          </ol> -->

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              <?= $nome_tipo; ?></div>
              <a id="botao-novo" class="btn btn-success btn-sm" href="<?= base_url("transacao/manusear?id_tipo={$id_tipo}&id=0")?>"><i class="font-icon fa fa-plus"></i> Nova</a>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Pago</th>
                      <th>Data</th>
                      <th>Nome</th>
                      <th>Valor</th>
                      <th>Categoria</th>
                      <th>Funções</th>
                    </tr>
                  </thead>
                  <tbody>
      							<?php foreach($transacoes -> result() as $transacoes): ?>
                      <td><?= $transacoes->pago; ?></td>
      								<td><?= $transacoes->data_cadastro; ?></td>
      								<td><?= $transacoes->nome; ?></td>
      								<td><?= $transacoes->valor; ?></td>
      								<td><?= $transacoes->categoria; ?></td>
      								<td width="10px" id="funcoes">
                          <?php if($transacoes->pago == 'S'):?>
                            <a href="<?= base_url("transacao/cancelar_pagamento?id_tipo={$id_tipo}&id={$transacoes->id_transacao}")?>">Cancelar pagamento</a>
                          <?php else: ?>
                            <a href="<?= base_url("transacao/pagar?id_tipo={$id_tipo}&id={$transacoes->id_transacao}")?>">Pagar</a>
                          <?php endif ?>
      									<a href="<?= base_url("transacao/manusear?id_tipo={$id_tipo}&id={$transacoes->id_transacao}")?>">Alterar</a>
                        <a href="<?= base_url("transacao/excluir?id_tipo={$id_tipo}&id={$transacoes->id_transacao}")?>">Excluir</a>
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