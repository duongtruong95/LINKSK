
    <footer class="main-footer">
      <div class="float-right d-none d-sm-inline">
        Phiên bản <b style="color:yellow;"><?=$config['version'];?></b>
      </div>
      <strong>Copyright &copy; 2020-2021 <a href="https://www.cmsnt.co/" target="_blank">CMSNT.CO</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- Javascript Option -->
  <?=$footer;?>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?=BASE_URL('template/AdminLTE3/');?>plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?=BASE_URL('template/AdminLTE3/');?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?=BASE_URL('template/AdminLTE3/');?>dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?=BASE_URL('template/AdminLTE3/');?>dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?=BASE_URL('template/AdminLTE3/');?>dist/js/pages/dashboard.js"></script>
  <!-- ChartJS -->
  <script src="<?=BASE_URL('template/AdminLTE3/');?>plugins/chart.js/Chart.min.js"></script>
</body>
</html>