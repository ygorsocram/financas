          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?= base_url('include');?>/inicio">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Nova Despesa</li>
          </ol>

<div class="page-content" id="cadastrar_despesas">
		<div class="container-fluid">
			<section class="box-typical box-panel mb-4" id="form_despesas">
        <div class="widget-container fluid-height">
          <div class="box-typical-body">
				<div class="row">
              		<div class="col-lg-8" id="cadastrar_despesa">
              				<fieldset class="form-group">
              					<label class="form-label" for="nome">Nome*</label>
              					<input class="form-control proximo_campo" id="nome" name="nome" type="text" placeholder="Nome da Despesa" size="40" required>
              				</fieldset>
              		</div>
                  <div class="col-lg-2" id="cadastrar_despesa">
                      <fieldset class="form-group">
                        <label class="form-label" for="valor">Valor</label>
                        <input class="form-control proximo_campo" id="valor" name="valor" type="number" step="0.01" size="30">
                      </fieldset>
                  </div>
                      <div class="col-lg-1" id="cadastrar_despesa">
                          <fieldset class="form-group">
                            <label class="form-label" for="pago">Pago</label>
                            <input class="form-control proximo_campo" id="pago" name="pago" type="checkbox" value= "" size="5">
                          </fieldset>
                      </div>
                  <div class="col-lg-3" id="cadastrar_despesa">
                      <fieldset class="form-group">
                        <label class="form-label" for="data">Data</label>
                        <input class="form-control proximo_campo" id="data" name="data" type="date" placeholder="Data" size="80">
                      </fieldset>
                  </div>
                      <div class="col-lg-2" id="div_categoria">
                          <fieldset class="form-group">
                            <label class="form-label" for="categoria" id="categoria">Categoria</label>
                            <select class="form-control proximo_campo uppercase" id="catrgoria" name="categoria">
                            <?php foreach($categorias -> result() as $categorias): ?>
      								          <option value="<?= $categorias->id_categoria; ?>"> <?= $categorias->nome; ?></option>
                            <?php endforeach; ?>
							             </select>
                          </fieldset>
                      </div>
                      <div class="col-lg-2" id="div_conta">
                          <fieldset class="form-group">
                            <label class="form-label" for="conta" id="conta">Conta</label>
                            <select class="form-control proximo_campo uppercase" id="conta" name="conta">
                            <?php foreach($contas -> result() as $contas): ?>
      								          <option value="<?= $contas->id_conta; ?>"> <?= $contas->nome; ?></option>
                            <?php endforeach; ?>
							</select>
                          </fieldset>
                      </div>
              	</div>
			</div>
		</section>
    </div>
 </div>
