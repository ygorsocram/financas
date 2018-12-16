
  <body id="page-top">
    <div id="wrapper">


      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?= base_url('include');?>/#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Charts</li>
          </ol>

          <!-- Area Chart Example
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Area Chart Example</div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

          <div class="row">
            <div class="col-lg-8">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-bar"></i>
                  Bar Chart Example</div>
                <div class="card-body">
                  <canvas id="myBarChart" width="100%" height="50"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-pie"></i>
                  Pie Chart Example</div>
                <div class="card-body">
                  <canvas id="myPieChart" width="100%" height="100"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
              </div>
            </div>
          </div>-->

<!-- mortis-->
<h1>Bar charts</h1>
<div id="graph"></div>
<pre id="code" class="prettyprint linenums">
// Use Morris.Bar
Morris.Bar({
  element: 'graph',
  data: [
  <?php foreach($categorias -> result() as $categorias): ?>
          {x: '<?= $categorias->nome; ?>', y: <?= $categorias->valor; ?>, a: <?= $categorias->valor_orcamento; ?>},
  <?php endforeach; ?>
  ],
  xkey: 'x',
  ykeys: ['y', 'a'],
  labels: ['Valor Gasto', 'Meta']
}).on('click', function(i, row){
  console.log(i, row);
});
</pre>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="<?= base_url('include');?>/#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Page level plugin JavaScript-->
    <script src="<?= base_url('include');?>/vendor/chart.js/Chart.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="<?= base_url('include');?>/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url('include');?>/js/demo/chart-bar-demo.js"></script>
    <script src="<?= base_url('include');?>/js/demo/chart-pie-demo.js"></script>

  </body>

</html>
