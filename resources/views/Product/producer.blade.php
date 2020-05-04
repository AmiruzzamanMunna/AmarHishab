@extends('Layouts.user-index')
@section('title')
    Product Producer Company 
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
                            <div class="col-md-6">Product Producer Comapny</div>
                            <div class="col-md-1 ml-auto"><i @click="openModal()" class="fas fa-user-plus"></i></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive-md-sm-lg">

                            <thead>
                                <th>Sl No</th>
                                <th>Brand Name</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                <tr v-for="(eachdata,index) in valData">
                                    <td>@{{index+1}}</td>
                                    <td>@{{eachdata.product_producer_name}}</td>
                                    <td><i class="fas fa-edit" @click="updateModal(eachdata.product_producer_id)"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i @click="deleteData(eachdata.product_producer_id)" class="fas fa-trash"></i></td>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Add Product Producer Company</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Company Name</label>
                    <input type="text" name="name" id="comname" v-model="comname" class="form-control">
                    <span id="namespan" style="color:red">Company Name Can not be Empty</span>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Update Product Company</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Company Name</label>
                    <input type="text" name="name" id="updatecomname" class="form-control">
                    <input type="hidden" name="name" id="id"  class="form-control">
                    
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
        </div>
    </div>
</div>

<script>

    $("#namespan").hide();

    var app = new Vue({

        el:"#showData",

        data:{

            comname:"",
            updatecomname:"",

            valData:[],

        },
        methods:{

            getAllData:function(){

                axios.get('/getAllProductCompany').then(({data})=>this.valData=data.data);

            },
            openModal:function(){

                console.log('click');

                $("#comname").val("");

                $("#exampleModalCenter").modal('show');
            },
            checkForm:function(){

                console.log('Click');

                if(!this.comname){

                    $("#namespan").show();
                }else{

                    this.insert();
                }

            },
            insert:function(){

                axios.post('/insertCompanyName',{

                    comname:this.comname,

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
                    url:"{{route('user.updateProducerName')}}",
                    data:{

                        id:id
                    },
                    success:function(data){

                        $("#exampleModalCenter2").modal('show');

                        $("#id").val(id);
                        $("#updatecomname").val(data.data.product_producer_name);

                    }
                });
            },
            updateData:function(){

                var updatecomname=$("#updatecomname").val();
                var id=$("#id").val();

                this.updatecomname=updatecomname;

                axios.post('/updateProducerNameStore',{

                    name:updatecomname,
                    id:id,
                });

                $("#exampleModalCenter2").modal('hide');

                this.getAllData();
            },
            deleteData:function(id){

                console.log(id);

                if(confirm('Are You sure!!')){

                    axios.post('/deleteProducerName',{

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