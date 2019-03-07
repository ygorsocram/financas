          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?= base_url("cartao");?>">Dashboard / Cartão</a>
            </li>
                <?php if($id_cartao== 0):?>
                <li class="breadcrumb-item active">Novo Cartao</li>
                <?php else: ?>
                <li class="breadcrumb-item active">Edita Cartão</li>
                <?php endif ?>
          </ol>

<div class="page-content" id="manusear_despesas">
		<div class="container-fluid">
			<section class="box-typical box-panel mb-4" id="form_despesas">
        <div class="widget-container fluid-height">
          <div class="box-typical-body">
            <form action="<?= base_url("cartao/gravar_dados_cartao/{$id_cartao}")?>" method="post">
				        <div id="dados_cadastrais" class="row">
              		<div class="col-lg-6" id="manusear_despesa">
              				<fieldset class="form-group">
              					<label class="form-label" for="nome">Nome*</label>
              					<input class="form-control proximo_campo" id="nome" name="nome" type="text" value= "<?= $nome; ?>" placeholder="Nome do Cartão" size="40" required>
              				</fieldset>
              		</div>
                  <div class="col-lg-2" id="div_valor">
                      <fieldset class="form-group">
                        <label class="form-label" for="dia_fechamento">Dia Fechamento*</label>
                        <input class="form-control proximo_campo" id="dia_fechamento" name="dia_fechamento" type="number" value= "<?= $dia_fechamento; ?>" step="0.01" size="30" required>
                      </fieldset>
                  </div>
                  <div class="col-lg-2" id="div_valor">
                      <fieldset class="form-group">
                        <label class="form-label" for="dia_pagamento">Dia Pagamento*</label>
                        <input class="form-control proximo_campo" id="dia_pagamento" name="dia_pagamento" type="number" value= "<?= $dia_pagamento; ?>" step="1" size="30" required>
                      </fieldset>
                  </div>
                  <div class="col-lg-2" id="div_valor">
                      <fieldset class="form-group">
                        <label class="form-label" for="valor_limite">Valor Limite *</label>
                        <input class="form-control proximo_campo" id="valor_limite" name="valor_limite" type="number" value= "<?= $valor_limite; ?>" step="0.01" size="30" required>
                      </fieldset>
                  </div>
                      <div class="col-lg-3" id="div_bandeira">
                          <fieldset class="form-group">
                            <label class="form-label" for="bandeira" id="bandeira">Bandeira*</label>
                            <select class="form-control proximo_campo uppercase" id="bandeira" name="bandeira" onChange="dados(this.value);">
                            <?php foreach($bandeiras -> result() as $bandeiras): ?>
                              <?php if($bandeira== $bandeiras->id_bandeira):?>
                                  <option value="<?= $bandeiras->id_bandeira; ?>" selected> <?= $bandeiras->nome; ?></option>
                              <?php else: ?>
                                  <option value="<?= $bandeiras->id_bandeira; ?>"> <?= $bandeiras->nome; ?></option>
                              <?php endif ?>
                            <?php endforeach; ?>
                           </select>
                          </fieldset>
                      </div>
                      <div class="col-lg-3" id="div_conta">
                          <fieldset class="form-group">
                            <label class="form-label" for="conta" id="conta">Conta*</label>
                            <select class="form-control proximo_campo uppercase" id="conta" name="conta" onChange="dados(this.value);">
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
              	</div>
                </div>
                <a id="botao_voltar" class="btn btn-warning btn-sm" href="<?= base_url("cartao")?>"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                <button type="submit" class="btn btn-inline btn-success pull-right" id="manusear_despesa">Gravar</button>
      </form>
			</div>
		</section>
    </div>
 </div>
