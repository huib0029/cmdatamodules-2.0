@extends('layouts.master')

@section('page-title')
 Visual pagina
@endsection

@section('title')
@endsection

@section('content')

<div class="fresh-table toolbar-color-blue">
  <!--    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
          Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
  -->

  <table id="fresh-table" class="table">
      <thead>
      <th data-field="id">Studentnummer</th>
      <th data-field="mail">HZ mail</th>
      <th data-field="name">Voornaam</th>
      <th data-field="lastname">Achternaam</th>
      <th data-field="studyyear">Leerjaar</th>
      <th data-field="project">Project</th>
      <th data-field="competentie">Competenties</th>
      </thead>
      <tbody>
      <tr>
          <td>00073350</td>
          <td>bakx0015</td>
          <td>Joris</td>
          <td>Bakx</td>
          <td>2</td>
          <td>CMDatamodules</td>
          <td>Gan1,Iad1,Ban1,Ban2</td>
      </tr>
      </tbody>
  </table>
</div>

</div>

@endsection

@section('scripts')
<script type="text/javascript">
        var $table = $('#fresh-table'),
            $alertBtn = $('#alertBtn'),
            full_screen = false;
        $().ready(function(){
            $table.bootstrapTable({
                toolbar: ".toolbar",
                showRefresh: false,
                search: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                striped: true,
                sortable: true,
                pageSize: 10,
                pageList: [10,25,50,100],
                formatShowingRows: function(pageFrom, pageTo, totalRows){
                    //do nothing here, we don't want to show the text "showing x of y from..."
                },
                formatRecordsPerPage: function(pageNumber){
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });
        }); </script>
@endsection
