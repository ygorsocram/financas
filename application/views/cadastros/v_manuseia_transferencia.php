          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?= base_url("conta");?>">Dashboard / Contas</a>
            </li>
                <li class="breadcrumb-item active">Nova Conta</li>
          </ol>

<div class="page-content" id="manusear_despesas">
		<div class="container-fluid">
			<section class="box-typical box-panel mb-4" id="form_despesas">
        <div class="widget-container fluid-height">
          <div class="box-typical-body">
            <form action="<?= base_url("conta/gravar/{$id_tipo}/{$id_transacao}")?>" method="post">
				        <div id="dados_cadastrais" class="row">
              		<div class="col-lg-10" id="manusear_despesa">
              				<fieldset class="form-group">
              					<label class="form-label" for="nome">Descrição*</label>
              					<input class="form-control proximo_campo" id="nome" name="nome" type="text" value= "<?= $nome; ?>" placeholder="Descrição da Transferencia" size="40" required>
              				</fieldset>
              		</div>
                  <div class="col-lg-2" id="div_valor">
                      <fieldset class="form-group">
                        <label class="form-label" for="valor">Valor*</label>
                        <input class="form-control proximo_campo" id="valor" name="valor" type="number" value= "<?= $valor; ?>" step="0.01" size="30" required>
                      </fieldset>
                  </div>
                      <div class="col-lg-3" id="div_conta_saida">
                          <fieldset class="form-group">
                            <label class="form-label" for="conta_saida" id="conta_saida">Conta Saída*</label>
                            <select class="form-control proximo_campo uppercase" id="conta_saida" name="conta_saida">
                            <?php foreach($contas_saida -> result() as $conta): ?>
                              <?php if($conta_saida== $conta->id_conta):?>
                                  <option value="<?= $conta->id_conta; ?>" selected> <?= $conta->nome; ?></option>
                              <?php else: ?>
                                  <option value="<?= $conta->id_conta; ?>"> <?= $conta->nome; ?></option>
                              <?php endif ?>
                            <?php endforeach; ?>
							             </select>
                          </fieldset>
                      </div>
                      <div class="col-lg-3" id="div_conta">
                          <fieldset class="form-group">
                            <label class="form-label" for="conta_entrada" id="conta_entrada">Conta Entrada*</label>
                            <select class="form-control proximo_campo uppercase" id="conta_entrada" name="conta_entrada">
                            <?php foreach($contas_entrada -> result() as $contas): ?>
                              <?php if($conta_entrada== $contas->id_conta):?>
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
                <a id="botao_voltar" class="btn btn-warning btn-sm" href="<?= base_url("conta")?>"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                <button type="submit" class="btn btn-inline btn-success pull-right" id="manusear_despesa">Gravar</button>
      </form>
			</div>
		</section>
    </div>
 </div>
