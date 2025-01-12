@extends('app')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.allowance.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("allowances.update", [$allowance->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : '' }}">
                            <label for="employee">{{ trans('cruds.allowance.fields.employee') }}*</label>
                            <select name="employee_id" id="employee" class="form-control select2" required>
                                @foreach($employees as $id => $employee)
                                    <option value="{{ $id }}" {{ (isset($allowance) && $allowance->employee ? $allowance->employee->id : old('employee_id')) == $id ? 'selected' : '' }}>{{ $employee }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee_id'))
                                <p class="help-block">
                                    {{ $errors->first('employee_id') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">
                            <label for="year">{{ trans('cruds.allowance.fields.year') }}</label>
                            <select id="year" name="year" class="form-control">
                                <option value="" disabled {{ old('year', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Allowance::YEAR_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('year', $allowance->year) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('year'))
                                <p class="help-block">
                                    {{ $errors->first('year') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('month') ? 'has-error' : '' }}">
                            <label for="month">{{ trans('cruds.allowance.fields.month') }}*</label>
                            <select id="month" name="month" class="form-control" required>
                                <option value="" disabled {{ old('month', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Allowance::MONTH_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('month', $allowance->month) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('month'))
                                <p class="help-block">
                                    {{ $errors->first('month') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                            <label for="amount">{{ trans('cruds.allowance.fields.amount') }}*</label>
                            <input type="number" id="amount" name="amount" class="form-control" value="{{ old('amount', isset($allowance) ? $allowance->amount : '') }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <p class="help-block">
                                    {{ $errors->first('amount') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.allowance.fields.amount_helper') }}
                            </p>
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection