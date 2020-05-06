@extends('Layouts.user-index')
@section('title')
    Customer Details 
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
                            <div class="col-md-6">Customer Details</div>
                            <div class="col-md-1 ml-auto"><i @click="openModal()" class="fas fa-user-plus"></i></div>
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
                                <th>Purchase</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                <tr v-for="(eachdata,index) in valData">
                                    <td>@{{index+1}}</td>
                                    <td>@{{eachdata.customer_details_name}}</td>
                                    <td>@{{eachdata.customer_details_address}}</td>
                                    <td>@{{eachdata.customer_details_phn}}</td>
                                    <td>@{{eachdata.customer_type_name}}</td>
                                    <td class="text-center"><i class="fas fa-cart-plus"></i></i></td>
                                    <td><i class="fas fa-edit" @click="updateModal(eachdata.customer_details_id)"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i @click="deleteData(eachdata.customer_details_id)" class="fas fa-trash"></i></td>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Add Customer Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Customer Name</label>
                    <input type="text" name="name" id="pname" class="form-control">
                    <span id="pnamespan" style="color:red">Customer Name Can not be Empty</span>
                </div>
                <div class="form-group">
                    <label for="">Customer Type</label>
                    <select name="" id="type" class="form-control">
                        <option value="0">Select</option>
                        <option value="1">Cash</option>
                        <option value="2">Due</option>
                    </select>
                    <span id="pbrandspan" style="color:red">Type Can not be Empty</span>
                </div>
        
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="name" id="address" class="form-control">
                    <span id="pamountspan" style="color:red">Address can not be Empty</span>
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" name="name" id="phn"  class="form-control">
                    <span id="pquantityspan" style="color:red">Phone Number can not be Empty</span>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Update Customer Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Customer Name</label>
                    <input type="text" name="uname" id="uname" class="form-control">
                    <input type="hidden" name="name" id="id" class="form-control">
                    
                </div>
                <div class="form-group">
                    <label for="">Customer Type</label>
                    <select name="" id="utype" class="form-control">
                        
                    </select>
                    
                </div>
        
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="name" id="uaddress" class="form-control">
                    
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" name="name" id="uphn"  class="form-control">
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

                axios.get('/getAllCustomer').then(({data})=>this.valData=data.data);

            },
            openModal:function(){

                console.log('click');

                var name=$("#pname").val("");
                var address=$("#address").val("0");
                var phn=$("#phn").val("");

                $("#exampleModalCenter").modal('show');

                
            },
            checkForm:function(){

                console.log('Click');

                var name=$("#pname").val();
                var type=$("#type").val();
                var address=$("#address").val();
                var phn=$("#phn").val();


                if(name==''){

                    $("#pnamespan").show();
                }

                if(type==0){

                    $("#pbrandspan").show();
                }
                if(address==''){

                    $("#pamountspan").show();
                }
        
                if(!parseInt(phn)){

                    $("#pquantityspan").show();
                }

                if(name!='' && type!=0 && address!='' && parseInt(phn)){

                    this.insert();
                }
                

            },
            insert:function(){

                console.log('click');

                var name=$("#pname").val();
                var type=$("#type").val();
                var address=$("#address").val();
                var phn=$("#phn").val();

                axios.post('/insertCustomerDetails',{

                    name:name,
                    type:type,
                    address:address,
                    phn:phn,

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
                    url:"{{route('user.editCustomerDetails')}}",
                    data:{

                        id:id
                    },
                    success:function(data){

                        console.log(data);

                        $("#exampleModalCenter2").modal('show');

                        $("#id").val(id);
                        var name=$("#uname").val(data.data.customer_details_name);
                        var type=$("#utype").val();
                        var address=$("#uaddress").val(data.data.customer_details_address);
                        var phn=$("#uphn").val(data.data.customer_details_phn);

                        var html='';
                        if(data.data.customer_details_type==1){

                            html+='<option value="0">Select</option>';
                            html+='<option value="1" selected>Cash</option>';
                            html+='<option value="2">Due</option>';

                        }else{

                            html+='<option value="0">Select</option>';
                            html+='<option value="1">Cash</option>';
                            html+='<option value="2" selected>Due</option>';
                        }

                        $("#utype").html(html);


                    }
                });
            },
            updateData:function(){

                
                var id=$("#id").val();
            
                var name=$("#uname").val();
                var type=$("#utype").val();
                var address=$("#uaddress").val();
                var phn=$("#uphn").val();

                axios.post('/editCustomerDetailsUpdate',{

                    id:id,
                    name:name,
                    type:type,
                    address:address,
                    phn:phn,

                });

                $("#exampleModalCenter2").modal('hide');

                this.getAllData();
            },
            deleteData:function(id){

                console.log(id);

                if(confirm('Are You sure!!')){

                    axios.post('/deleteCustomerDetailsUpdate',{

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