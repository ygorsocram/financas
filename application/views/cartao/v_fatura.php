          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">

                              <a href="<?= base_url('cartao');?>">Dashboard / Cartão de Crédito</a>
                            </li>
                                      <li class="breadcrumb-item active"><?=$pagina?></li>
                                </ol>

                            <!-- DataTables Example -->
                            <div class="card mb-3">
                              <div class="card-header">
                                <i class="fas fa-table"></i>
                                <?=$pagina?> : <?=$nome_fatura?></div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                              <th>Vencimento</th>
                              <th>Valor da Fatura</th>
                              <th>Valor aberto da Fatura</th>
                              <th>Função</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($faturas -> result() as $faturas): ?>
                    <tr>
                            <td><?= $faturas->dt_vencimento; ?></td>
                            <td><?= $faturas->vlr_fatura; ?></td>
                            <td><?= $faturas->vlr_fatura_aberto; ?></td>
      								<td id="funcoes">
                        <a href="<?= base_url("cartao/acessar_lancamento?id_fatura={$faturas->id_fatura}")?>"><i class="font-icon fas fa-sign-in-alt" title="Acessar" style="font-size:20px;"></i></a>
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
