          <!-- Breadcrumbs-->
          <div>
              <ol class="breadcrumb">
                <td>
                    <li class="breadcrumb-item">
                      <a href="<?= base_url("cartao");?>">Dashboard / Cartão de Crédito (<?=$nome_fatura?>)</a>
                    </li>
                    <li class="breadcrumb-item active"><?=$pagina?></li>
        </td>
                <td id="listar_faturas">
                    <a id="listar_faturas" class="btn btn-success btn-sm" href="<?= base_url("cartao/acessar_faturas/{$id_cartao}")?>"><i class="font-icon fa fa-plus"></i> Acessar Faturas</a>
        </td>
              </ol>
          </div>

            <!-- DataTables Example -->
            <div class="card mb-3">
              <div class="card-header">
                <div class="row">
                  <div class="col-lg-12">
                    <div id="divisor_mes">
                      <a href="<?= base_url("cartao/decrementa_fatura/{$id_cartao}/{$id_fatura}")?>"><i class="fas fa-arrow-circle-left"></i></a> 
                      Vencimento :  <?=$dt_vencimento?>
                      <a href="<?= base_url("cartao/incrementa_fatura/{$id_cartao}/{$id_fatura}")?>"><i class="fas fa-arrow-circle-right"></i></a> 
                    </div>
                  <table>
                    <td>
                    <div id="botao_valor_transacao" class="btn btn-info btn-sm" href="<?= base_url("cartao/acessar_lancamento/{$id_fatura}")?>" title="Valor Fatura"><?=$valor_fatura?>
                      <a id="botao_valor_transacao" class="btn btn-warning btn-sm" href="<?= base_url("cartao/acessar_lancamento/{$id_fatura}")?>" title="Valor Fatura Aberto"><?=$valor_fatura_aberto?></a>
                   </div>
                   </td>
                   <td>
                   <div class ="float-right">
                      <a id="botao_novo_cabecalho" class="btn btn-success btn-sm" href="<?= base_url("cartao/manusear_cartao/0/{$id_cartao}/{$id_fatura}")?>"><i class="font-icon fa fa-plus"></i> Novo Lançamento</a>
                      <a id="botao_novo_cabecalho" class="btn btn-danger btn-sm" href="<?= base_url("cartao/manusear_estorno/0/{$id_cartao}/{$id_fatura}")?>"><i class="font-icon fa fa-minus"></i> Estorno</a>
                      <a id="botao_novo_cabecalho" class="btn btn-primary btn-sm" href="<?= base_url("cartao/manusear_pagar_fatura/0/{$id_cartao}/{$id_fatura}")?>"><i class="font-icon fa fa-minus"></i> Pagar</a>
                    </div>
                    </td>
                  </table>
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
      									       <a href="<?= base_url("cartao/manusear_estorno/{$lancamentos->id_transacao}/{$id_cartao}/{$id_fatura}")?>"><i class="font-icon fab fa-autoprefixer" title="Alterar" style="font-size:20px;"></i></a>
                          <?php elseif($lancamentos->categoria == 'PAGAMENTO CARTÃO' || $lancamentos->categoria == 'PAGAMENTO PARCIAL'): ?>
      									       <a href="<?= base_url("cartao/manusear_pagar_fatura/{$lancamentos->id_transacao}/{$id_cartao}/{$id_fatura}")?>"><i class="font-icon fab fa-autoprefixer" title="Alterar" style="font-size:20px;"></i></a>
                          <?php else: ?>
      									       <a href="<?= base_url("cartao/manusear_cartao/{$lancamentos->id_transacao}/{$id_cartao}/{$id_fatura}")?>"><i class="font-icon fab fa-autoprefixer" title="Alterar" style="font-size:20px;"></i></a>
                          <?php endif ?>
                        <a href="<?= base_url("cartao/excluir?id={$lancamentos->id_transacao}/{$lancamentos->id_fatura_cartao}/{$id_cartao}")?>"><i class="font-icon fa fa-eraser" style="font-size:20px; margin-left: 10px;" title="Excluir"></i></a>
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
