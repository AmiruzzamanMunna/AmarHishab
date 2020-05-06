@extends('Layouts.user-index')
@section('title')
    Product Details 
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
@endsection
@section('container')

<div class="dashboard-ecommerce" id="showData">
    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">Product Details</div>
                            <div class="col-md-1 ml-auto"><i @click="openModal()" class="fas fa-user-plus"></i></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive-md">

                            <thead>
                                <th>Sl No</th>
                                <th>Brand Name</th>
                                <th>Company Name</th>
                                <th>Product Name</th>
                                <th>Available</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                <tr v-for="(eachdata,index) in valData">
                                    <td>@{{index+1}}</td>
                                    <td>@{{eachdata.product_brand_name}}</td>
                                    <td>@{{eachdata.product_producer_name}}</td>
                                    <td>@{{eachdata.product_details_name}}</td>
                                    <td v-if="eachdata.product_details_quantity<10"><div class="row"><div class="col-12"><div class="row"><div class="col-3">@{{eachdata.product_details_quantity}}</div><span class="badge badge-danger align-left text-left">Low Quantity</span></div></div></div></td>
                                    <td v-else>@{{eachdata.product_details_quantity}}</td>
                                    <td><i class="fas fa-edit" @click="updateModal(eachdata.product_details_id)"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i @click="deleteData(eachdata.product_details_id)" class="fas fa-trash"></i></td>
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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Product Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Product Name</label>
                    <input type="text" name="name" id="pname" v-model="comname" class="form-control">
                    <span id="pnamespan" style="color:red">Product Name Can not be Empty</span>
                </div>
                <div class="form-group">
                    <label for="">Product Brand</label>
                    <select name="" id="brands" class="form-control">

                        

                    </select>
                    <span id="pbrandspan" style="color:red">Product Brand Can not be Empty</span>
                </div>
                <div class="form-group">
                    <label for="">Product Company</label>
                    <select name="" id="company" class="form-control">

                    </select>
                    <span id="pcompanyspan" style="color:red">Product Company Can not be Empty</span>
                </div>
                <div class="form-group">
                    <label for="">Product Category</label>
                    <select name="" id="category" class="form-control">

                    </select>
                    <span id="pcategoryspan" style="color:red">Product Category Can not be Empty</span>
                </div>
                <div class="form-group">
                    <label for="">Purchase Amount</label>
                    <input type="text" name="name" id="pamount" class="form-control">
                    <span id="pamountspan" style="color:red">Enter a Valid Amount</span>
                </div>
                <div class="form-group">
                    <label for="">Product Quantity</label>
                    <input type="text" name="name" id="pquantity"  class="form-control">
                    <span id="pquantityspan" style="color:red">Enter a Valid Quantity</span>
                </div>
                <div class="form-group">
                    <label for="">Entry Date</label>
                    <input type="date" name="name" value="{{date('Y-m-d')}}" id="pdate" class="form-control">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" @click="checkForm" class="btn btn-primary">Save changes</button>
            </div>
            {{-- <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="status=='success'">
                <strong>Success !</strong> Record Save.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-warning alert-dismissible fade show" role="alert" v-else>
                <strong>Sorry !</strong> Record did not Save.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Product Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Product Name</label>
                    <input type="text" name="name" id="uppname" v-model="comname" class="form-control">
                    <input type="hidden" name="name" id="id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Product Brand</label>
                    <select name="" id="upbrands" class="form-control">

                        

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Product Company</label>
                    <select name="" id="upcompany" class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Product Category</label>
                    <select name="" id="upcategory" class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Purchase Amount</label>
                    <input type="text" name="name" id="uppamount" class="form-control">
                    
                </div>
                <div class="form-group">
                    <label for="">Product Quantity</label>
                    <input type="text" name="name" id="uppquantity"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Entry Date</label>
                    <input type="date" name="name" id="uppdate" class="form-control">
                    
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" @click="updateData" class="btn btn-primary">Save changes</button>
            </div>
            {{-- <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="status=='success'">
                <strong>Success !</strong> Record Save.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-warning alert-dismissible fade show" role="alert" v-else>
                <strong>Sorry !</strong> Record did not Save.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
        </>
    </div>
</div>

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

                axios.get('/getAllProductDetails').then(({data})=>this.valData=data.data);

            },
            openModal:function(){

                console.log('click');

                $("#comname").val("");

                $.ajax({

                    type:"get",
                    url:"{{route('user.getListedProduct')}}",
                    success:function(data){

                        console.log(data);

                        $("#exampleModalCenter").modal('show');

                        var brandData='<option value="0">Select</option>';

                        for($i=0;$i<data.brands.length;$i++){

                            brandData+='<option value="'+data.brands[$i].product_brand_id+'">'+data.brands[$i].product_brand_name+'</option>';
                        }
                        $("#brands").html(brandData);

                        var company='<option value="0">Select</option>';
                        for($i=0;$i<data.companyName.length;$i++){

                            company+='<option value="'+data.companyName[$i].product_producer_id+'">'+data.companyName[$i].product_producer_name+'</option>';
                        }
                        $("#company").html(company);

                        var cat='<option value="0">Select</option>';

                        for($i=0;$i<data.category.length;$i++){

                            cat+='<option value="'+data.category[$i].product_category_id+'">'+data.category[$i].product_category_name+'</option>';
                        }
                        $("#category").html(cat);
                    },
                    error:function(error){

                        console.log(error);
                    }
                });

                
            },
            checkForm:function(){

                console.log('Click');

                var pname=$("#pname").val();
                var brands=$("#brands").val();
                var company=$("#company").val();
                var category=$("#category").val();
                var pamount=$("#pamount").val();
                var pquantity=$("#pquantity").val();


                if(pname==''){

                    $("#pnamespan").show();
                }

                if(brands==0){

                    $("#pbrandspan").show();
                }
                if(company==0){

                    $("#pcompanyspan").show();
                }
                if(category==0){

                    $("#pbrandsppcategoryspanan").show();
                }
                if(!parseFloat(pamount)){

                    $("#pamountspan").show();
                }
                if(!parseInt(pquantity)){

                    $("#pquantityspan").show();
                }

                if(pname!='' && brands!=0 && company!=0 && category!=0 && parseFloat(pamount) && parseInt(pquantity)){

                    this.insert();
                }
                

            },
            insert:function(){

                console.log('click');

                var pname=$("#pname").val();
                var brands=$("#brands").val();
                var company=$("#company").val();
                var category=$("#category").val();
                var pamount=$("#pamount").val();
                var pquantity=$("#pquantity").val();
                var pdate=$("#pdate").val();

                axios.post('/insertProductDetails',{

                    pname:pname,
                    brands:brands,
                    company:company,
                    category:category,
                    pamount:pamount,
                    pquantity:pquantity,
                    pdate:pdate,

                }).catch(function(e){

                    console.log(e);
                });

                $("#exampleModalCenter").modal('hide');

                this.getAllData();
            },
            updateModal:function(id){

                console.log(id);

                $.ajax({

                    type:"get",
                    url:"{{route('user.editProductDetails')}}",
                    data:{

                        id:id
                    },
                    success:function(data){

                        console.log(data);

                        $("#exampleModalCenter2").modal('show');

                        $("#id").val(id);
                        var pname=$("#uppname").val(data.data.product_details_name);
                        var brands=$("#upbrands").val();
                        var company=$("#upcompany").val();
                        var category=$("#upcategory").val();
                        var pamount=$("#uppamount").val(data.data.product_details_purchase_amount);
                        var pquantity=$("#uppquantity").val(data.data.product_details_quantity);
                        var pdate=$("#uppdate").val(data.data.product_details_entry_date);

                        var brandData='';

                        for($i=0;$i<data.brands.length;$i++){

                            if(data.data.product_details_brand_id==data.brands[$i].product_brand_id){

                                brandData+='<option value="'+data.brands[$i].product_brand_id+'" selected>'+data.brands[$i].product_brand_name+'</option>';

                            }else{

                                brandData+='<option value="'+data.brands[$i].product_brand_id+'">'+data.brands[$i].product_brand_name+'</option>';

                            }

                            
                        }

                        $("#upbrands").html(brandData);

                        var comData='';

                        for($i=0;$i<data.companyName.length;$i++){

                            if(data.data.product_details_com_id==data.companyName[$i].product_producer_id){

                                comData+='<option value="'+data.companyName[$i].product_producer_id+'" selected>'+data.companyName[$i].product_producer_name+'</option>';

                            }else{

                                comData+='<option value="'+data.companyName[$i].product_producer_id+'">'+data.companyName[$i].product_producer_name+'</option>';

                            }

                            
                        }

                        $("#upcompany").html(comData);

                        var catData='';

                        for($i=0;$i<data.category.length;$i++){

                            if(data.data.product_details_product_cat_id==data.category[$i].product_category_id){

                                catData+='<option value="'+data.category[$i].product_category_id+'" selected>'+data.category[$i].product_category_name+'</option>';

                            }else{

                                catData+='<option value="'+data.category[$i].product_category_id+'">'+data.category[$i].product_category_name+'</option>';

                            }

                            
                        }

                        $("#upcategory").html(catData);


                    }
                });
            },
            updateData:function(){

                
                var id=$("#id").val();
                var pname=$("#uppname").val();
                var brands=$("#upbrands").val();
                var company=$("#upcompany").val();
                var category=$("#upcategory").val();
                var pamount=$("#uppamount").val();
                var pquantity=$("#uppquantity").val();
                var pdate=$("#uppdate").val();

                axios.post('/editProductDetailsUpdate',{

                    id:id,
                    pname:pname,
                    brands:brands,
                    company:company,
                    category:category,
                    pamount:pamount,
                    pquantity:pquantity,
                    pdate:pdate,
                });

                $("#exampleModalCenter2").modal('hide');

                this.getAllData();
            },
            deleteData:function(id){

                console.log(id);

                if(confirm('Are You sure!!')){

                    axios.post('/deleteProductDetailsUpdate',{

                        id:id,
                    });

                    this.getAllData();

                }else{

                    return;
                }

                
            }

        },
        mounted:function(){

            console.log('Mounted');

            this.getAllData();
        }

    });
</script>

    
@endsection