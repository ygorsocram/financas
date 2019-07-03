            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?= base_url('Inicio');?>">Dashboard</a>
              </li>
              <li class="breadcrumb-item active"><?=$pagina?></li>
            </ol>

            <!-- DataTables Example -->
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-table"></i><?=$pagina?>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Valor Em aberto</th>
                        <th>Limite Restante</th>
                        <th>Função</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($cartoes -> result() as $cartoes): ?>
                      <tr>
                        <td><?= $cartoes->nome_cartao; ?></td>
                        <td><?= $cartoes->vlr_cartao_aberto; ?></td>
                        <td><?= $cartoes->vlr_limite_restante; ?></td>
      								  <td width="10px" id="funcoes">
                          <a href="<?= base_url("cartao/manuseia_dados_cartao/{$cartoes->id_cartao}")?>"><i class="font-icon fab fa-autoprefixer" title="Alterar" style="font-size:20px;"></i></a>
                          <a href="<?= base_url("cartao/acessar_fatura_atual/{$cartoes->id_cartao}")?>"><i class="font-icon fas fa-sign-in-alt" title="Acessar" style="font-size:20px;"></i></a>
      								  </td>
      							  </tr>
                      <?php endforeach; ?>
      							</tbody>
                  </table>
                </div>
              </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

        </div>
        <!-- /.container-fluid -->