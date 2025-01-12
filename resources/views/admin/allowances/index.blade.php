@inject('request', 'Illuminate\Http\Request')
@extends('app')
@section('content')
<div class="content">

        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route("allowances.create") }}">
                    Add Allowance
                </a>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Allowances List
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Allowance">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    
                                    <th>
                                        Employee Id
                                    </th>
                                    <th>
                                        Year
                                    </th>
                                    <th>
                                        Month
                                    </th>
                                    <th>
                                        Amount
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allowances as $key => $allowance)
                                    <tr data-entry-id="{{ $allowance->id }}">
                                        <td>

                                        </td>
                                       
                                        <td>
                                            {{ $allowance->employee->employee_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Allowance::YEAR_SELECT[$allowance->year] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Allowance::MONTH_SELECT[$allowance->month] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $allowance->amount ?? '' }}
                                        </td>
                                        <td>
                                                <a class="btn btn-xs btn-primary" href="{{ route('allowances.show', $allowance->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                                <a class="btn btn-xs btn-info" href="{{ route('allowances.edit', $allowance->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>

                                                <form action="{{ route('allowances.destroy', $allowance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>


                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('allowances.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Allowance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection