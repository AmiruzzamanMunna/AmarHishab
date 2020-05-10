@extends('Layouts.user-index')
@section('title')
    Customer Monthly Details
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
@endsection
@section('container')
<div class="dashboard-ecommerce" id="showData">
    <div class="modal fade bd-example-modal-lg" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Customer Purchasing Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <input type="hidden" name="" id="idVal" value="0">
                            <input type="hidden" name="" id="customer_id">
                            
                            <div class="row">
                                <div class="col-md-6">Product Details Update</div>
                                <div class="col-2 ml-auto"><i @click="appendData()" class="fas fa-plus-circle"></i></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-responsive-md">
                                <thead>
                                    <th>Sl No</th>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                    <th>Purchased Time</th>
                                    <th>Purchased Amount Total</th>
                                    <th>Given Amount Total</th> 
                                    <th>Due Amount</th> 
                                </thead>
                                <tbody id="appendDataShow">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" @click="updateData()" class="btn btn-primary">Save changes</button>
                </div>
                
            </div>
        </div>
    </div>
    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12-col-xl-12">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xl-2">
                        <h3>Select Date</h3>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xl-3">
                        <input type="date" class="form-control" value="{{date('Y-m-d')}}" id="getDate">
                    </div>
                    <div class="col-md-3 col-lg-6 col-xl-6 col-sm-3">
                        <button style="margin-bottom: 5%" @click="getAllData()" class="btn btn-primary col-4">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xl-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-6">Customer Purchasing Details</div>
                                    
                                </div>
                            </>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <table class="table table-bordered table-responsive-md">

                            <thead>
                                <th>Sl No</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Type</th>
                                <th>Purchase Time</th>
                                <th>Purchase Amount Total</th>
                                <th>Given Amount Total</th> 
                                <th>Due Amount</th> 
                            </thead>

                            <tbody>
                                <tr v-for="(eachdata,index) in valData">
                                    <td>@{{index+1}}</td>
                                    <td>@{{eachdata.customer_details_name}}</td>
                                    <td>@{{eachdata.customer_details_address}}</td>
                                    <td>@{{eachdata.customer_details_phn}}</td>
                                    <td>@{{eachdata.customer_type_name}}</td>
                                    <td>@{{eachdata.times}}</td>
                                    <td>@{{eachdata.purchasedTotal}}</td>
                                    <td>@{{eachdata.givenTotal}}</td>
                                    <td>@{{eachdata.Due}}</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                
            </div>
        </>
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
    </div>
</div>




<!-- Large modal -->





<script>

    $("#pnamespan").hide();
    $("#pbrandspan").hide();
    $("#pcompanyspan").hide();
    $("#pcategoryspan").hide();
    $("#pamountspan").hide();
    $("#pquantityspan").hide();

    var app = new Vue({

        el:"#showData",

        data:{

            comname:"",
            updatecomname:"",

            valData:[],

        },
        methods:{

            getAllData:function(){

                var date=$("#getDate").val();
                

                axios.post('/customermonthly/Report',{date:date}).then(({data})=>this.valData=data.data);

            },
            
            purchaseModal:function(id){

                console.log(id);

                $("#exampleModalCenter3").modal('show');
                $("#idVal").val(0);
                $("#customer_id").val(id);
                var date=$("#getDate").val();

                $.ajax({

                    type:'get',
                    url:"{{route('user.customerDetailsIdWise')}}",
                    data:{

                        id:id,
                        date:date,

                    },
                    success:function(data){

                        var html='';
                        var option='';

                       
                        for($i=0;$i<data.data.length;$i++){

                            html+='<tr id="remove'+$i+'">';
                            html+='<td>'+($i+1)+'</td>';
                            html+='<td><input type="hidden" id="update_product_id'+$i+'" value="'+data.data[$i].product_purchase_product_id+'" name="update_product_id[]"><select class="form-control" id="product_id'+$i+'" onchange="getAvailable('+$i+')"></select><input type="hidden" name="purchase_id[]" id="purchase_id'+$i+'" value="'+data.data[$i].product_purchase_id+'"></td>';
                            html+='<td id="availableShow'+$i+'"></td>';
                            html+='<td><input type="text" name="updateQuantity[]" id="available'+$i+'" class="form-control" value="'+data.data[$i].product_purchase_quantity+'"><input type="text" placeholder="New Quantity" name="newQuantity[]" class="form-control"></td>';
                            html+='<td><input type="text" name="updatePrice[]" id="amount'+$i+'" value="'+data.data[$i].product_purchase_amount+'" class="form-control"></td>';
                            html+='<td><i class="fas fa-minus-circle" onclick="removeData('+$i+')"></i></td>';
                            html+='</tr>'; 
                            id=$("#idVal").val($i);

                        }
                        $("#appendDataShow").html(html);
                        for($j=0;$j<data.data.length;$j++){


                            for($k=0;$k<data.product.length;$k++){

                                var product_id=data.data[$j].product_purchase_product_id;
                                if(data.product[$k].product_details_id==product_id){

                                    option+='<option value="'+data.product[$k].product_details_id+'" selected>'+data.product[$k].product_details_name+'</option>';
                                    

                                }else{

                                    option+='<option value="'+data.product[$k].product_details_id+'">'+data.product[$k].product_details_name+'</option>';
                                }
       
                        
                            }

                            console.log('j'+$j);

                            $("#product_id"+$j).html(option);
                            option='';

                        }
                        
                        
                        
                        
                        
                    },
                    error:function(error){

                        console.log(error);
                    }
                });
                $("#appendDataShow").html('');

            },
            appendData:function(){

                console.log('click');

                $.ajax({

                    type:'get',
                    url:"{{route('user.getAllProductDetails')}}",
                    success:function(data){

                        console.log(data);

                        id=$("#idVal").val();
                        id++;

                        var html='';
                        var option='<option>Select</option>';

                        html+='<tr id="remove'+id+'">'
                        html+='<td>'+id+'</td>'
                        html+='<td><input type="hidden" id="pid'+id+'" name="product_all_id[]"><select class="form-control" name="" id="product_id'+id+'" onchange="getAvailable('+id+')"></select></td>';
                        html+='<td id="availableShow'+id+'"></td>';
                        html+='<td><input type="text" id="available'+id+'" name="quantity[]" class="form-control"></td>';
                        html+='<td><input type="text" id="amount'+id+'" name="amount[]" class="form-control"></td>';
                        html+='<td><i class="fas fa-minus-circle" onclick="removeData('+id+')"></i></td>';
                        html+='<tr>';
                        html+='</tr>';

                        for($i=0;$i<data.data.length;$i++){

                            option+='<option value="'+data.data[$i].product_details_id+'">'+data.data[$i].product_details_name+'</option>';


                        }
                        

                        $("#appendDataShow").append(html);
                        $("#product_id"+id).html(option);

                        id=$("#idVal").val(id);
                    },
                    error:function(error){

                        console.log(error);
                    }
                });

                
            },
            
            updateData:function(){

                var customer_id=$("#customer_id").val();

                var update_product_id=$("input[name^='update_product_id']").map(function () {return $(this).val();}).get();
                var purchase_id=$("input[name^='purchase_id']").map(function () {return $(this).val();}).get();
                var updateQuantity=$("input[name^='updateQuantity']").map(function () {return $(this).val();}).get();
                var newQuantity=$("input[name^='newQuantity']").map(function () {return $(this).val();}).get();
                var updatePrice=$("input[name^='updatePrice']").map(function () {return $(this).val();}).get();

                var product_id=$("input[name^='product_all_id']").map(function () {return $(this).val();}).get();
                var quantity=$("input[name^='quantity']").map(function () {return $(this).val();}).get();
                var amount=$("input[name^='amount']").map(function () {return $(this).val();}).get();
                var getDate=$("#getDate").val();

                axios.post('/customer/updatePurchasingDetails',{
                    
                    customer_id:customer_id,
                    update_product_id:update_product_id,
                    purchase_id:purchase_id,
                    updateQuantity:updateQuantity,
                    newQuantity:newQuantity,
                    updatePrice:updatePrice,
                    product_id:product_id,
                    quantity:quantity,
                    amount:amount,
                    getDate:getDate,
                });

                $("#exampleModalCenter3").modal('hide');
                this.getAllData();
            }
            

        },
        mounted:function(){

            console.log('Mounted');

            this.getAllData();
        }

    });

    var i=0;
    function removeData(id){

        console.log(id)
        var product_id=$("#product_id"+id).val();
        var purchase_id=$("#purchase_id"+id).val();
        var getDate=$("#getDate").val();
        var customer_id=$("#customer_id").val();

        
        
        i++;

        $.ajax({

            type:'get',
            url:"{{route('user.purchasingRemovingDetails')}}",
            data:{

                product_id:product_id, 
                id:customer_id, 
                date:getDate,
                purchase_id:purchase_id,
            },
            success:function(data){

                $("#remove"+id).remove();

            },
            error:function(error){

            }
        });
        
        
        console.log('remove'+id);
        // id=$("#idVal").val(id-i);
    }

    function getAvailable(id){

        var product_id=$("#product_id"+id).val();
        var update_product_id=$("#product_id"+id).val();
        var arrayData=[];
        var arrayDataUpdate=[];

        arrayData.push(product_id);


        $("#pid"+id).val(arrayData);
    

        console.log(arrayData);

        $.ajax({

            type:'get',
            url:"{{route('user.getAvailableProduct')}}",
            data:{

                id:product_id,
            },
            success:function(data){

                for($i=0;$i<data.data.length;$i++){

                    $("#available"+id).val(data.data[$i].availablequantity);
                    $("#availableShow"+id).html(data.data[$i].availablequantity);
                    $("#amount"+id).val(data.data[$i].product_details_purchase_amount);

                }

                
            },
            error:function(error){

                console.log(error);
            }
        });
    }

</script>

    
@endsection