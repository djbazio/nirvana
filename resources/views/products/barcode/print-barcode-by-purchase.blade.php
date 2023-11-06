@extends('app')

@section('title')
	{{trans('core.print_barcode_by_purchase')}}
@stop

@section('contentheader')
	{{trans('core.print_barcode_by_purchase')}}
@stop

@section('breadcrumb')
	{{trans('core.print_barcode_by_purchase')}}
@stop

@section('main-content')

<div class="panel-body" id="app">
  	<div style="background-color: #c5d5d34d;">
		<!-- Print setting section -->
		<div class="panel-heading" style="background-color: #c5d5d34d;">
		  	<div class="form-group">
		    	<div class="row">
			     	<div class="col-md-12">
			     		<label>Print Per Page</label>
				      	<select v-model="ppp" class="form-control">
						  <option disabled value="">Please select one</option>
						  <option value="pp10">Per Page 10</option>
						  <option value="pp24">Per Page 24</option>
						  <option value="pp40">Per Page 40</option>
						  <option value="pp50">Per Page 50</option>
						  <option value="pp60">Per Page 60</option>
						  <option value="pp70">Per Page 70</option>
						</select>
				    </div>
				</div>
		  	</div>

		  	<div class="form-group">
		  		<div class="row">
		    		<div class="col-md-2">
					  	<div class="checkbox-custom checkbox-custom-success">
	                        <input id="checkbox3" type="checkbox" v-model.number='site_name'>
	                        <label for="checkbox3">
	                            Site Name
	                        </label>
	                	</div>
					</div>

					<div class="col-md-2">
						<div class="checkbox-custom checkbox-custom-success">
				    		<input id="checkbox4" type="checkbox" v-model.number='product_name'>
				    		<label for="checkbox4">
	                        	Product Name
	                    	</label>
					    </div>
					</div>

					<div class="col-md-2">
						<div class="checkbox-custom checkbox-custom-success">
				    		<input id="checkbox1" type="checkbox" v-model.number='product_price'>
				    		<label for="checkbox1">
	                        	Product Price
	                    	</label>
					    </div>
					</div>
				</div>
			</div>
		</div>
		<!-- Print setting section ends -->


		<!-- purchase reference selection form -->
		<form method="post"> 
			<!-- <div class="well">@{{products}}</div> -->
	    	<div style="padding: 15px;">
				<select class="form-control selectPickerLive" @change="setPurchase" v-model="products.product_id" data-live-search="true">
					<option>{{trans('core.select_purchase')}}</option>
					@foreach($purchases as $purchase)
						<option 
							value="{!! $purchase->id !!}"
						>
							{{$purchase->reference_no}}
						</option>
					@endforeach
				</select>
			</div>
		</form>
		<!-- purchase reference selection form ends-->

		<!-- print button div -->
		<div class="row" v-if="showPrintButton">
			<div class="col-md-12">
				<a @click="printDiv('printableArea')" class="btn btn-block btn-xs" style="background-color: #2D5C8A; color: #FFF;"> 
					{{trans('core.print')}} 
				</a>
			</div>
		</div>
		<!-- ends -->
  	</div>
	

	<div class="panel-body" v-if="!loading">
		<div class="a4paper" id="printableArea">
			<div class="barcode-item" v-for="product in barcodeProducts" >
				<div :class="ppp" v-for="n in parseInt(product.purchase_quantity)" style="float: left; ">
					<p v-if="site_name" class="barcode-info-p">
						{{settings('site_name')}}
					</p>
					<p v-if="product_name" class="barcode-info-p">
						@{{ product.name }}
					</p>
					<img :src="product.barcode">
					<br>
					<small style="font-size: 8px !important;"><b>@{{product.code}}</b></small>
					<p v-if="product_price" style="line-height: 12px !important; font-size: 8px !important;">
						MRP: {{settings('currency_code')}} @{{product.mrp}} 
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="panel-body" v-else>
		<div style="min-height: 535px;" v-if="loading" >
			<center>
				<div id="loader">  
				  <div class="a"></div>
				  <div class="b"></div>  
				  <div class="c"></div>
				  <div class="d"></div>
				</div>
			</center>
		</div>
	</div>
</div>
@stop

@section('js')
    @parent
	<script src="/assets/js-core/vue.min.js"></script>
    <script src="/assets/js-core/axios.min.js"></script>
    
    <script>
    	$(document).ready(function () {
    		$('.selectPickerLive').selectpicker();
    	})
	    
    	axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
		axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    	Vue.component('products', {
    		template: '#products',
    		props: ['id', 'product', 'add', 'remove'],
    		data: function () {
	    		return {}
	    	},
	    	methods: {
	    	},
	    	mounted: function () {
	    	}
    	})

    	var app = new Vue({
		    el: '#app',
		    data: {
		    	items: 48,
		    	ppp:'pp40',
		    	site_name: true,
			    product_name: true,
			    product_price: true,
		    	products: [
		    		{ 
		    			id: 1, 
		    			quantity: 1,
		    			product_id: 0,
		    			barcode: ''
		    		},
		    	],
		    	barcodeProducts: [
		    	],
		    	submitted: false,
		    	loading: false,
		    	showPrintButton: false,
		    },
		    computed: {

		    },
		    methods:{
	    		setPurchase: function (event) {
	    			var self = this
	    			self.loading = true
	    			var purchaseId = $('option:selected', event.target).val()
	    			axios.get('/admin/api/v1/purchase/' + purchaseId + '/products')
	    				.then(function (response) {
	    					self.loading = false
	    					self.showPrintButton = true
	    					console.log(JSON.stringify(response))
	    					self.barcodeProducts = response.data
	    				})
						.catch(function (error) {
							self.loading = false
							console.log(JSON.stringify(error))
						})

	    		},
		        addInput: function () {
		        	var newInputId = 1
		        	for (var i = 0; i < this.products.length; i++) {
		        		newInputId = this.products[i].id + 1
		        	}
		        	this.products.push({ id: newInputId, barcode: '', product_id: '', quantity: 1})
		        	this.$nextTick(function () {
		        		$('.selectPickerLive').selectpicker()
		        	})
		        },
		        removeInput: function (id) {
		           var index = this.products.findIndex(function (sell) {
		           		return sell.id === id
		           })
		           this.products.splice(index, 1)
		        },
		        printDiv: function (divName) {
		        	var printContents = document.getElementById(divName).innerHTML;
		            var originalContents = document.body.innerHTML;
		            document.body.innerHTML = printContents;
		            window.print();
		            document.body.innerHTML = originalContents;
		            location.reload();
        		}
		    }
		});
    </script>
@stop