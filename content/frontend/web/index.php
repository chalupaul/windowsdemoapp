<?php
require "./_config.php";
require "./_header.php";
require "./_list.php";

$app_url = $names_url_list[mt_rand(0, count($names_url_list) - 1)];
$names = list_names($app_url);
?>
<div class="row">
  <div class="col-md-12">
    <table class="table table-hover" id="names-table">
      <thead><tr><th>&nbsp;</th><th>Name</th><th></th></tr></thead>
      <tbody></tbody>
    </table>
  </div><!-- class="col-md-12"-->
  <div class="col-md-4" id="status"></div>
  <div class="col-md-4 text-center">
    <div id="pageContainer"></div>
  </div>
  <div class="col-md-4 text-right">
    <button type="button" class="btn btn-primary" id="more-names">More Names!</button>
  </div>
</div><!-- class="row" -->

<div class="modal fade" tabindex="-1" role="dialog" id="new-names-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Added the following names.</h4>
      </div>
      <div class="modal-body" id="new-names"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div><!-- content -->
  </div><!-- dialog -->
</div><!-- modal -->

<?php
$names_json = json_encode($names);
$extra_js = "var namesArray = " . $names_json . ";\n";
require "./_footer.php";
?>
