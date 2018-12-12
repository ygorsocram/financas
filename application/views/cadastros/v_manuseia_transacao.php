          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?= base_url('include');?>/inicio">Dashboard</a>
            </li>
                <?php if($id_transacao== 0):?>
                <li class="breadcrumb-item active">Nova <?= $nome_tipo; ?></li>
                <?php else: ?>
                <li class="breadcrumb-item active">Edita <?= $nome_tipo; ?></li>
                <?php endif ?>
          </ol>

<div class="page-content" id="manusear_despesas">
		<div class="container-fluid">
			<section class="box-typical box-panel mb-4" id="form_despesas">
        <div class="widget-container fluid-height">
          <div class="box-typical-body">
            <form action="<?= base_url("transacao/gravar?id_tipo={$id_tipo}&id={$id_transacao}")?>" method="post">
				<div class="row">
              		<div class="col-lg-8" id="manusear_despesa">
              				<fieldset class="form-group">
              					<label class="form-label" for="nome">Nome*</label>
              					<input class="form-control proximo_campo" id="nome" name="nome" type="text" value= "<?= $nome; ?>" placeholder="Nome da Despesa" size="40" required>
              				</fieldset>
              		</div>
                  <div class="col-lg-2" id="manusear_despesa">
                      <fieldset class="form-group">
                        <label class="form-label" for="valor">Valor*</label>
                        <input class="form-control proximo_campo" id="valor" name="valor" type="number" value= "<?= $valor; ?>" step="0.01" size="30" required>
                      </fieldset>
                  </div>
                  <?php if($id_tipo != 3):?>
                      <div class="col-lg-1" id="manusear_despesa">
                          <fieldset class="form-group">
                            <label class="form-label" for="pago">Pago</label>
                            <input class="form-control proximo_campo" id="pago" name="pago" type="checkbox" size="5" <?= $pago; ?>>
                          </fieldset>
                      </div>
                  <?php endif ?>
                  <div class="col-lg-3" id="manusear_despesa">
                      <fieldset class="form-group">
                        <label class="form-label" for="data">Data*</label>
                        <input class="form-control proximo_campo" id="data" name="data" type="date" value= "<?= $data_cadastro; ?>" value = "<?= $data; ?>" placeholder="Data" size="80">
                      </fieldset>
                  </div>
                      <div class="col-lg-2" id="div_categoria">
                          <fieldset class="form-group">
                            <label class="form-label" for="categoria" id="categoria">Categoria*</label>
                            <select class="form-control proximo_campo uppercase" id="catrgoria" name="categoria">
                            <?php foreach($categorias -> result() as $categorias): ?>
                              <?php if($categoria== $categorias->id_categoria):?>
                                  <option value="<?= $categorias->id_categoria; ?>" selected> <?= $categorias->nome; ?></option>
                              <?php else: ?>
                                  <option value="<?= $categorias->id_categoria; ?>"> <?= $categorias->nome; ?></option>
                              <?php endif ?>
                            <?php endforeach; ?>
							             </select>
                          </fieldset>
                      </div>
                    <?php if($id_tipo != 3):?>
                      <div class="col-lg-2" id="div_conta">
                          <fieldset class="form-group">
                            <label class="form-label" for="conta" id="conta">Conta*</label>
                            <select class="form-control proximo_campo uppercase" id="conta" name="conta">
                            <?php foreach($contas -> result() as $contas): ?>
                              <?php if($conta== $contas->id_conta):?>
                                  <option value="<?= $contas->id_conta; ?>" selected> <?= $contas->nome; ?></option>
                              <?php else: ?>
                                  <option value="<?= $contas->id_conta; ?>"> <?= $contas->nome; ?></option>
                              <?php endif ?>
                            <?php endforeach; ?>
							             </select>
                          </fieldset>
                      </div>
                  <?php else: ?>
                      <div class="col-lg-2" id="div_cartao">
                          <fieldset class="form-group">
                            <label class="form-label" for="cartao" id="cartao">Cartao*</label>
                            <select class="form-control proximo_campo uppercase" id="cartao" name="cartao">
                            <?php foreach($cartoes -> result() as $cartoes): ?>
                              <?php if($cartao== $cartoes->id_cartao):?>
                                  <option value="<?= $cartoes->id_cartao; ?>" selected> <?= $cartoes->nome; ?></option>
                              <?php else: ?>
                                  <option value="<?= $cartoes->id_cartao; ?>"> <?= $cartoes->nome; ?></option>
                              <?php endif ?>
                            <?php endforeach; ?>
							             </select>
                          </fieldset>
                      </div>
                      <div class="col-lg-2" id="div_fatura">
                          <fieldset class="form-group">
                            <label class="form-label" for="fatura" id="fatura">Fatura*</label>
                            <select class="form-control proximo_campo uppercase" id="fatura" name="fatura">
                            <?php foreach($faturas -> result() as $faturas): ?>
                              <?php if($fatura== $faturas->id_fatura):?>
                                  <option value="<?= $faturas->id_fatura; ?>" selected> <?= $faturas->nome; ?></option>
                              <?php else: ?>
                                  <option value="<?= $faturas->id_fatura; ?>"> <?= $faturas->nome; ?></option>
                              <?php endif ?>
                            <?php endforeach; ?>
							             </select>
                          </fieldset>
                      </div>
                  <?php endif ?>
              		<div class="col-lg-50" id="manusear_despesa">
              				<fieldset class="form-group">
              					<label class="form-label" for="observacao">Observaçao</label>
              					<input class="form-control proximo_campo" id="observacao" name="observacao" type="textarea" value= "<?= $observacao; ?>" placeholder="observacao" size="100">
              				</fieldset>
              		</div>
              	</div>
                <a class="btn btn-info-outline" href="<?= base_url('transacao?id_tipo=2')?>"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                        <button type="submit" class="btn btn-inline btn-success pull-right" id="manusear_despesa">Gravar</button>
      </form>
			</div>
		</section>
    </div>
 </div>
