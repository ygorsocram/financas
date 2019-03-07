          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
                  <a href="<?= base_url('Inicio');?>">Dashboard</a>
                </li>
                          <li class="breadcrumb-item active">Categoria</li>
                    </ol>

                <!-- DataTables Example -->
                <div class="card mb-3">
                  <div class="card-header">
                          <div class="row">
      <div class="col-lg-12">
                      <i class="fas fa-table"></i>
                        Categorias de Entrada
                        <a id="botao_novo_categoria" class="btn btn-success btn-sm float-right" href="<?= base_url("categoria/manusear/0/1")?>"><i class="font-icon fa fa-plus"></i> Nova</a>
                </div>
                                </div>
                </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                              <th>Nome</th>
                              <th>Cor Relatórios</th>
                              <th>Funções</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($categorias_entrada -> result() as $categorias): ?>
                    <tr>
                            <td><?= $categorias->nome; ?></td>
                            <td><button style="background-color:<?= $categorias->cor; ?>" title="Cor"><i class="fas fa-table"></i></button></td>
      								<td width="10px" id="funcoes">
      				          <a href="<?= base_url("categoria/manusear/{$categorias->id_categoria}/1")?>"><i class="font-icon fab fa-autoprefixer" title="Alterar" style="font-size:20px;"></i></a>
                        <a href="<?= base_url("categoria/excluir/{$categorias->id_categoria}")?>"><i class="font-icon fa fa-eraser" style="font-size:20px; margin-left: 10px;" title="Excluir"></i></a>
      								</td>
      							</tr>
      							<?php endforeach; ?>
      							</tbody>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted"></div>
          </div>

                <div class="card mb-3">
                  <div class="card-header">
                      <i class="fas fa-table"></i>
                        Categorias de Saída
                        <a id="botao_novo_categoria" class="btn btn-success btn-sm" href="<?= base_url("categoria/manusear/0/2")?>"><i class="font-icon fa fa-plus"></i> Nova</a>
                </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                              <th>Nome</th>
                              <th>Valor Orçamento</th>
                              <th>Cor Relatórios</th>
                              <th>Funções</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($categorias_saida -> result() as $categorias): ?>
                    <tr>
                            <td><?= $categorias->nome; ?></td>
                            <td><?= $categorias->vlr_orcamento; ?></td>
                            <td><button style="background-color:<?= $categorias->cor; ?>" title="Cor"><i class="fas fa-table"></i></button></td>
      								<td width="10px" id="funcoes">
      				          <a href="<?= base_url("categoria/manusear/{$categorias->id_categoria}/2")?>"><i class="font-icon fab fa-autoprefixer" title="Alterar" style="font-size:20px;"></i></a>
                        <a href="<?= base_url("categoria/excluir/{$categorias->id_categoria}")?>"><i class="font-icon fa fa-eraser" style="font-size:20px; margin-left: 10px;" title="Excluir"></i></a>
      								</td>
      							</tr>
      							<?php endforeach; ?>
      							</tbody>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted"></div>
          </div>

        </div>
        <!-- /.container-fluid -->
