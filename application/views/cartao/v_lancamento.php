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
                <div class="row">
                  <div class="col-lg-12">
                      <i class="fas fa-table"></i>
                      <?=$pagina?> : <?=$nome_fatura?> - Vencimento :  <?=$dt_vencimento?>
                    <div id="botao_valor_transacao" class="btn btn-info btn-sm" href="<?= base_url("cartao/acessar_lancamento?&id_fatura={$id_fatura}")?>" title="Valor Fatura"><?=$valor_fatura?>
                      <a id="botao_valor_transacao" class="btn btn-warning btn-sm" href="<?= base_url("cartao/acessar_lancamento?&id_fatura={$id_fatura}")?>" title="Valor Fatura Aberto"><?=$valor_fatura_aberto?></a>
                   </div>
                   <div class ="float-right">
                      <a id="botao_novo_cabecalho" class="btn btn-success btn-sm" href="<?= base_url("cartao/manusear_cartao?id=0&id_cartao={$id_cartao}&id_fatura={$id_fatura}")?>"><i class="font-icon fa fa-plus"></i> Novo Lançamento</a>
                      <a id="botao_novo_cabecalho" class="btn btn-danger btn-sm" href="<?= base_url("cartao/manusear_estorno?id=0&id_cartao={$id_cartao}&id_fatura={$id_fatura}")?>"><i class="font-icon fa fa-minus"></i> Estorno</a>
                      <a id="botao_novo_cabecalho" class="btn btn-primary btn-sm" href="<?= base_url("cartao/manusear_pagar_fatura?id=0&id_cartao={$id_cartao}&id_fatura={$id_fatura}")?>"><i class="font-icon fa fa-minus"></i> Pagar</a>
                    </div>
            </div>
                        </div>
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
                    <tr>
                            <td><?= $lancamentos->data_cadastro; ?></td>
                            <td><?= $lancamentos->nome; ?></td>
                            <td><?= $lancamentos->valor; ?></td>
                            <td><?= $lancamentos->categoria; ?></td>
      								<td id="funcoes">
                          <?php if($lancamentos->categoria == 'ESTORNO'):?>
      									       <a href="<?= base_url("cartao/manusear_estorno?id={$lancamentos->id_transacao}&id_cartao={$id_cartao}&id_fatura={$id_fatura}")?>"><i class="font-icon fab fa-autoprefixer" title="Alterar" style="font-size:20px;"></i></a>
                          <?php elseif($lancamentos->categoria == 'PAGAMENTO CARTÃO' || $lancamentos->categoria == 'PAGAMENTO PARCIAL'): ?>
      									       <a href="<?= base_url("cartao/manusear_pagar_fatura?id={$lancamentos->id_transacao}&id_cartao={$id_cartao}&id_fatura={$id_fatura}")?>"><i class="font-icon fab fa-autoprefixer" title="Alterar" style="font-size:20px;"></i></a>
                          <?php else: ?>
      									       <a href="<?= base_url("cartao/manusear_cartao?id={$lancamentos->id_transacao}&id_cartao={$id_cartao}&id_fatura={$id_fatura}")?>"><i class="font-icon fab fa-autoprefixer" title="Alterar" style="font-size:20px;"></i></a>
                          <?php endif ?>
                        <a href="<?= base_url("cartao/excluir?id={$lancamentos->id_transacao}&id_fatura={$lancamentos->id_fatura_cartao}&id_cartao={$id_cartao}")?>"><i class="font-icon fa fa-eraser" style="font-size:20px; margin-left: 10px;" title="Excluir"></i></a>
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
