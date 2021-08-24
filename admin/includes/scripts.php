<!-- itmust be under bootsrap and jquery -->
<!-- Moment JS -->
<!-- <script src="../bower_components/moment/moment.js"></script> -->


<!-- DataTables -->
<script src="./DataTables/datatables.js"></script>

<!-- CK Editor -->
<script src="./js/ckeditor/ckeditor.js"></script>

<!-- Data Table Initialize -->
<script>
  $(function () {
    $('#example1').DataTable({
      responsive: true,
      'paging'  : true
    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
  $(function(){
    //Initialize Select2 Elements
    $('.select2').select2()

    //CK Editor
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
  });
</script>




