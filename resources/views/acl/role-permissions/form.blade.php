@extends('app')

@section('contentheader')
  {{trans('core.set_permission')}} {{trans('core.for')}} <b>{{$role->name}}</b>
@stop

@section('breadcrumb')
  {{trans('core.set_permission')}}
@stop

@section('main-content')

<div class="panel-body">

  <form  method="post" class="form-horizontal bordered-row">
    {{ csrf_field() }}

    <div class="form-group bg-khaki">

    

      <input type="hidden" value="{{$role->id}}" name="role_id">

      <div class="text-center" style="background-color: #F8F8F8; margin-bottom: 20px;">
        <label class="control-label col-sm-offset-3 col-sm-2">
          <span style=" color:navy; font-weight: bold;">Select All</span>
        </label>

        <div class="col-sm-1">
          <input type="checkbox"  name="all_permission" id="all-access" class="all-access" >
        </div>
      </div>
    </div>

      <div class="row">
        @foreach($permissions as $permission)
        <div class="col-md-4">
          <div class="form-group">
            <label class="control-label col-sm-8"> {{ ucwords($permission->type).' '.ucwords($permission->name) }}</label>
            <div class="col-sm-4">
              <input
                type="checkbox"
                class="input-group"
                data-toggle="switch"
                name="permissions{{$permission->id}}"
                value="{{$permission->id}}"
                @if(in_array(ucwords($permission->type).' '.ucwords($permission->name), $rolePermissionNameLists) == true)
                  checked
                @endif
                > 
            </div>
          </div>
        </div>
        @endforeach
      </div>
      

      <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right" style="margin-bottom: 10px;">{{trans('core.submit')}} </button>
      </div>

  </form>
</div>


                
@stop


@section('js')
  @parent
  <script type="text/javascript">
    $(document).ready(function () {
    $(".all-access").click(function () {
        $(".input-group").prop('checked', $(this).prop('checked'));
        });
    });
  </script>

@stop

