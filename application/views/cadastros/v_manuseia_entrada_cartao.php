          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?= base_url("cartao/acessar_lancamento/{$id_fatura}");?>">Dashboard / Cartão de Crédito / Faturas / Lançamentos</a>
            </li>
                <?php if($id_transacao== 0):?>
                <li class="breadcrumb-item active">Novo <?= $nome_tela; ?></li>
                <?php else: ?>
                <li class="breadcrumb-item active">Edita <?= $nome_tela; ?></li>
                <?php endif ?>
          </ol>

<div class="page-content" id="manusear_despesas">
		<div class="container-fluid">
			<section class="box-typical box-panel mb-4" id="form_despesas">
        <div class="widget-container fluid-height">
          <div class="box-typical-body">
            <form action="<?= base_url("cartao/gravar/{$id_transacao}")?>" method="post">
              <input type="hidden" name="cartao" id="cartao" value=<?="{$id_cartao}"?> />
              <input type="hidden" name="fatura" id="fatura" value=<?="{$id_fatura}"?> />
				        <div id="dados_cadastrais" class="row">
              		<div class="col-lg-8" id="manusear_despesa">
              				<fieldset class="form-group">
              					<label class="form-label" for="nome">Nome*</label>
              					<input class="form-control proximo_campo" id="nome" name="nome" type="text" value= "<?= $nome; ?>" placeholder="Nome do lançamento de Cartão" size="40" required>
              				</fieldset>
              		</div>
                  <div class="col-lg-2" id="div_valor">
                      <fieldset class="form-group">
                        <label class="form-label" for="valor">Valor*</label>
                        <input class="form-control proximo_campo" id="valor" name="valor" type="number" value= "<?= $valor; ?>" step="0.01" size="30" required>
                      </fieldset>
                  </div>
                  <div class="col-lg-2" id="manusear_despesa">
                      <fieldset class="form-group">
                        <label class="form-label" for="data">Data*</label>
                        <input class="form-control proximo_campo" id="data" name="data" type="date" value= "<?= $data_cadastro; ?>" value = "<?= $data; ?>" placeholder="Data" size="80">
                      </fieldset>
                  </div>
                      <div class="col-lg-3" id="div_categoria">
                          <fieldset class="form-group">
                            <label class="form-label" for="categoria" id="categoria">Categoria*</label>
                            <select class="form-control proximo_campo uppercase" id="categoria" name="categoria" onChange="dados(this.value);">
                              <?php if($nome_tela== 'Estorno'):?>
                                <option value="19" selected>ESTORNO</option>
                                <?php else: ?>
                            <?php foreach($categorias -> result() as $categorias): ?>
                              <?php if($categoria== $categorias->id_categoria):?>
                                  <option value="<?= $categorias->id_categoria; ?>" selected> <?= $categorias->nome; ?></option>
                              <?php else: ?>
                                  <option value="<?= $categorias->id_categoria; ?>"> <?= $categorias->nome; ?></option>
                              <?php endif ?>
                            <?php endforeach; ?>
                              <?php endif ?>
							             </select>
                          </fieldset>
                      </div>
                      <div class="col-lg-3" id="div_conta">
                          <fieldset class="form-group">
                            <label class="form-label" for="conta" id="conta">Conta Débito*</label>
                            <select class="form-control proximo_campo uppercase" id="conta" name="conta">
                            <?php foreach($contas -> result() as $contas): ?>
                              <?php if($id_conta== $contas->id_conta):?>
                                  <option value="<?= $contas->id_conta; ?>" selected> <?= $contas->nome; ?></option>
                              <?php else: ?>
                                  <option value="<?= $contas->id_conta; ?>"> <?= $contas->nome; ?></option>
                              <?php endif ?>
                            <?php endforeach; ?>
							             </select>
                          </fieldset>
                      </div>
              		<div class="col-lg-50" id="div_observacao">
              				<fieldset class="form-group">
              					<label class="form-label" for="observacao">Observaçao</label>
              					<input class="form-control proximo_campo" id="observacao" name="observacao" type="textarea" value= "<?= $observacao; ?>" placeholder="observacao" size="88">
              				</fieldset>
              		</div>
              	</div>
                <a id="botao_voltar" class="btn btn-warning btn-sm" href="<?= base_url("cartao/acessar_lancamento/{$id_fatura}")?>"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
               <button type="submit" class="btn btn-inline btn-success pull-right" id="manusear_despesa">Gravar</button>
      </form>
			</div>
		</section>
    </div>
 </div>
