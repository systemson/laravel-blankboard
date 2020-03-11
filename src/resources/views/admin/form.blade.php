@extends('blankboard::layouts.admin')

@section('content')
@include('blankboard::admin.includes.header', ['title' => 'Homepage', 'breadcrumbs' => []])

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="card-title">Title</h5>
          </div>
          <div class="card-body">
            @if (!is_null($resource->getKey()))
              {{ Form::open(['route' => ['admin.roles.update', $resource->getKey()], 'method' => 'PATCH']) }}
            @else
              {{ Form::open(['route' => ['admin.roles.store']]) }}
            @endif
            <div class="form-group row">
              <div class="form-group col-sm-10">
                {{ Form::submit(__('messages.send'), ['class' => 'btn btn-success']) }}
                {{ Form::reset(__('messages.reset'), ['class' => 'btn btn-default']) }}
              </div>
            </div>

            @foreach ($resource->getFillable() as $input)
              @if (in_array($input, [$resource->getKeyName(), 'password']))
                @continue
              @endif
              <div class="form-group row">
                <label for="{{ $input }}" class="col-sm-4 col-form-label text-right">{{ __('table.' . $input) }}:</label>
                <div class="col-sm-6">
                  @if ($input == 'status')
                  {{ Form::select($input, [1 => __('messages.active'), 0 => __('messages.inactive')], $resource->getFormValue($input), ['class' => 'form-control form-control-sm']) }}
                  @else
                  {{ Form::text($input, $resource->getFormValue($input), ['class' => 'form-control form-control-sm']) }}
                  @endif
                </div>
              </div>
            @endforeach

            {{ Form::close() }}
          </div>
          <div class="card-footer">
            Resource form
          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection