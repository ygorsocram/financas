          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?= base_url("cartao/acessar_faturas?id_cartao={$id_cartao}");?>">Dashboard / Cartão de Crédito / Faturas</a>
            </li>
                      <li class="breadcrumb-item active"><?=$pagina?></li>
                </ol>

            <!-- DataTables Example -->
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-table"></i>
                <?=$pagina?> : <?=$nome_fatura?> - Vencimento :  <?=$dt_vencimento?>
              <a id="botao-novo" class="btn btn-success btn-sm" href="<?= base_url("cartao/manusear_estorno?id=0&id_cartao={$id_cartao}&id_fatura={$id_fatura}")?>"><i class="font-icon fa fa-plus"></i> Estorno</a>
              <a id="botao-novo" class="btn btn-success btn-sm" href="<?= base_url("cartao/manusear_cartao?id=0&id_cartao={$id_cartao}&id_fatura={$id_fatura}")?>"><i class="font-icon fa fa-plus"></i> Novo Lançamento</a>
              </div>
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
                    <?php foreach($lancamentos -> result() as $lancamentos): ?>
                            <td><?= $lancamentos->data_cadastro; ?></td>
                            <td><?= $lancamentos->nome; ?></td>
                            <td><?= $lancamentos->valor; ?></td>
                            <td><?= $lancamentos->categoria; ?></td>
      								<td width="10px" id="funcoes">
                          <?php if($lancamentos->categoria == 'ESTORNO'):?>
      									       <a href="<?= base_url("cartao/manusear_estorno?id={$lancamentos->id_transacao}&id_cartao={$id_cartao}&id_fatura={$id_fatura}")?>">Alterar<a>
                          <?php else: ?>
      									       <a href="<?= base_url("cartao/manusear_cartao?id={$lancamentos->id_transacao}&id_cartao={$id_cartao}&id_fatura={$id_fatura}")?>">Alterar<a>
                          <?php endif ?>
                        <a href="<?= base_url("cartao/excluir?id={$lancamentos->id_transacao}&id_fatura={$lancamentos->id_fatura_cartao}&id_cartao={$id_cartao}")?>">Excluir</a>
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
