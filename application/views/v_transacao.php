          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?= base_url('inicio');?>">Dashboard</a>
            </li>
                <li class="breadcrumb-item active"><?= $nome_tipo; ?></li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
                <table>
                  <tr>
                    <th>
                      <i class="fas fa-table"></i>
                        <?= $nome_tipo; ?>
                    </th>
                    <th id="botao_valor">
                      <a id="botao_valor" class="btn btn-info btn-sm" href="<?= base_url("transacao")?>" title="Valor total"><?=$valor_transacao_total?></a>
                      <a id="botao_valor" class="btn btn-warning btn-sm" href="<?= base_url("transacao")?>" title="Valor Pago"><?=$valor_transacao_pago?></a>
                      <a id="botao_valor" class="btn btn-danger btn-sm" href="<?= base_url("transacao")?>" title="Valor Restante"><?=$valor_transacao_restante?></a>
                    </th>
                    <th>
                      <form action="<?= base_url("transacao?id_tipo={$id_tipo}")?>" method="post">
                          <table>
                            <tr>
                              <th>
                                <label class="form-label" for="data_inicio">Data Inicio</label>
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
                    </th>
                    <th>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a id="botao-novo" class="btn btn-success btn-sm" href="<?= base_url("transacao/manusear?id_tipo={$id_tipo}&id=0")?>"><i class="font-icon fa fa-plus"></i> Nova</a>
                    </th>
                  </tr>
                </table>
              </div>
          <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Data</th>
                      <th>Pago</th>
                      <th>Nome</th>
                      <th>Valor</th>
                      <th>Categoria</th>
                      <th>Conta</th>
                      <th>Funções</th>
                    </tr>
                  </thead>
                  <tbody>
      							<?php foreach($transacoes -> result() as $transacoes): ?>
      								<td><?= $transacoes->data_cadastro; ?></td>
                      <td><?= $transacoes->pago; ?></td>
      								<td><?= $transacoes->nome; ?></td>
      								<td><?= $transacoes->valor; ?></td>
      								<td><?= $transacoes->categoria; ?></td>
                      <td><?= $transacoes->conta; ?></td>
      								<td width="10px" id="funcoes">
                          <?php if($transacoes->pago == 'S'):?>
                            <a href="<?= base_url("transacao/cancelar_pagamento?id_tipo={$id_tipo}&id={$transacoes->id_transacao}")?>"><i class="font-icon fas fa-undo" title="Cancelar Pagamento" style="font-size:20px; margin-right: 10px;"></i></a>
                          <?php else: ?>
                            <a href="<?= base_url("transacao/pagar?id_tipo={$id_tipo}&id={$transacoes->id_transacao}")?>"><i class="font-icon fas fa-hand-holding-usd" title="Pagar" style="font-size:20px; margin-right: 10px;"></i></a>
                          <?php endif ?>
      									<a href="<?= base_url("transacao/manusear?id_tipo={$id_tipo}&id={$transacoes->id_transacao}")?>"><i class="font-icon fab fa-autoprefixer" title="Alterar" style="font-size:20px;"></i></a>
                        <a href="<?= base_url("transacao/excluir?id_tipo={$id_tipo}&id={$transacoes->id_transacao}")?>"><i class="font-icon fa fa-eraser" style="font-size:20px; margin-left: 10px;" title="Excluir"></i></a>
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
