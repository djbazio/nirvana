@extends('app')

@section('title')
  Upload Bulk Product
@stop

@section('contentheader')
  Upload Bulk Product
@stop

@section('breadcrumb')
  <a href="{{route('product.index')}}">Products</a>
  <li>Upload Bulk Product</li>
@stop

@section('main-content')
	<div class="panel-body">
		<h3 class="title-hero">
			Upload Bulk Product By Excel
		</h3>

		<div class="example-box-wrapper"> 
			<form class="form-horizontal bordered-row" method="post" files='true' enctype="multipart/form-data" id="ism_form">
				{{csrf_field()}}

				<div class="form-group">
		          <label class="col-md-offset-2 col-sm-2 control-label">
		          	Select a category
		          	<span class="required">*</span>
		          </label>
		          <div class="col-sm-5">
		            {!! Form::select('category_id', $categories, null, ['class' => 'form-control selectpicker', 'placeholder' => 'Please select a category', 'data-live-search' => "true"]) !!}
		          </div>
		        </div>

				<div class="form-group">
		          <label class="col-md-offset-2 col-sm-2 control-label">Upload Excel</label>
		          <div class="col-sm-5">
		            <input type="file" name="excel">
		            <small>
						<a href="{{asset('/templates/Bulk_Product_Upload_Template.xlsx')}}" download>
							Download sample excel file by clicking here.
						</a>
					</small>
		          </div>
		        </div>
	
			    <div class="bg-default content-box text-center pad20A mrg25T">
	                <input type="submit" class="btn btn-lg btn-primary" id="submitButton" value="{{ trans('core.save') }}" onclick="submitted()">
	            </div>
			</form>
		</div>
	</div>


@stop


@section('js')
    @parent


@stop