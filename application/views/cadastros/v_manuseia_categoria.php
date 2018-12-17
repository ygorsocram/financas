          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?= base_url("categoria");?>">Dashboard / Categoria</a>
            </li>
                <?php if($id_categoria== 0):?>
                <li class="breadcrumb-item active">Nova Categoria</li>
                <?php else: ?>
                <li class="breadcrumb-item active">Edita Categoria</li>
                <?php endif ?>
          </ol>

<div class="page-content" id="manusear_despesas">
		<div class="container-fluid">
			<section class="box-typical box-panel mb-4" id="form_despesas">
        <div class="widget-container fluid-height">
          <div class="box-typical-body">
            <form action="<?= base_url("categoria/gravar?id={$id_categoria}")?>" method="post">
				        <div id="dados_cadastrais" class="row">
              		<div class="col-lg-6" id="manusear_despesa">
              				<fieldset class="form-group">
              					<label class="form-label" for="nome">Nome*</label>
              					<input class="form-control proximo_campo" id="nome" name="nome" type="text" value= "<?= $nome; ?>" placeholder="Nome do lançamento de Cartão" size="40" required>
              				</fieldset>
              		</div>
                  <?php if($id_tipo== 2):?>
                  <div class="col-lg-2" id="div_valor">
                      <fieldset class="form-group">
                        <label class="form-label" for="valor_orcamento">Valor Orçamento</label>
                        <input class="form-control proximo_campo" id="valor_orcamento" name="valor_orcamento" type="number" value= "<?= $valor_orcamento; ?>" step="0.01" size="30">
                      </fieldset>
                  </div>
                  <?php endif ?>
              		<div class="col-lg-2" id="manusear_despesa">
              				<fieldset class="form-group">
              					<label class="form-label" for="cor">Cor</label>
              					<input class="form-control proximo_campo" id="cor" name="cor" type="text" value= "<?= $cor; ?>" placeholder="Cor em html" size="10" required>
              				</fieldset>
              		</div>
              	</div>
                </div>
                <a id="botao_voltar" class="btn btn-warning btn-sm" href="<?= base_url("categoria")?>"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                <button type="submit" class="btn btn-inline btn-success pull-right" id="manusear_despesa">Gravar</button>
      </form>
			</div>
		</section>
    </div>
 </div>
