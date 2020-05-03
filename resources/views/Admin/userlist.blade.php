@extends('Layouts.admin-index')
@section('title')
    User List
@endsection
@section('container')

<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content ">

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">All User List</div>
                            <div class="col-md-1 ml-auto"><i onclick="openModal()" class="fas fa-user-plus"></i></div>
                        </div>
                    </div>
                    <div class="card-body" id="showData">

                        <table class="table table-responsive-md table-bordered">

                            <thead>

                                <th>Sl No</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Address</th>
                                <th>Contact Info</th>
                                <th>Action</th>

                            </thead>

                            <tbody id="tableData">
                                
                                <tr v-for="(eachdata,index) in valData">
                                <td>@{{index+1}}</td>
                                <td>@{{eachdata.name}}</td>
                                <td>@{{eachdata.username}}</td>
                                <td>@{{eachdata.address}}</td>
                                <td>@{{eachdata.phnnumber}}</td>
                                <td><i class="fas fa-edit" @click="updateModal(eachdata.amar_user_id)"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i @click="deleteData(eachdata.amar_user_id)" class="fas fa-trash"></i></td>
                                </tr>
                              
                            </tbody>
                            
                        </table>

                        <tfoot>

                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="show">
                                <strong>Success !</strong> Record Deleted.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        </tfoot>
            
                    </div>
                    <div class="card-footer"></div>
                </>
            </div>
        </div>
    </div>
</div>
  
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" v-model="name" class="form-control">
                    <span id="namespan" style="color:red">Name Can not be Empty</span>
                </div>
                <div class="form-group">
                    <label for="">User Name</label>
                    <input type="text" name="" v-model="username" id="username" class="form-control">
                    <span id="usernamespan" style="color:red">User Name Can not be Empty</span>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="" id="pass" v-model="pass" class="form-control">
                    <span id="passspan" style="color:red">Password Can not be Empty</span>
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" name="" onfocusout="passCheck()" v-model="conpass" id="conpass" class="form-control">
                    <span id="conpassspan" style="color:red">Confirm Password Can not be Empty</span>
                    <span id="confpassspan" style="color:red">Password & Confirm Password does not Match</span>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="" id="address" v-model="address" class="form-control">
                    <span id="addressspan" style="color:red">Address Can not be Empty</span>
                </div>
                <div class="form-group">
                    <label for="">Phone Number</label>
                    <input type="text" name="" id="phnnum" v-model="phnnum" class="form-control">
                    <span id="phnnumspan" style="color:red">Phone Number Can not be Empty</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" @click="checkForm" class="btn btn-primary">Save changes</button>
            </div>
            <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="status=='success'">
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
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="dataentry">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="updatename" class="form-control">
                    <input type="hidden" name="updateid" id="updateid" v-model="updateid" class="form-control">
                    {{-- <span id="namespan" style="color:red">Name Can not be Empty</span> --}}
                </div>
                <div class="form-group">
                    <label for="">User Name</label>
                    <input type="text" name="" id="updateusername" class="form-control" readonly>
                    {{-- <span id="usernamespan" style="color:red">User Name Can not be Empty</span> --}}
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="" id="updatepass" class="form-control">
                    <input type="hidden" name="" id="existpass" class="form-control">
                    {{-- <span id="passspan" style="color:red">Password Can not be Empty</span> --}}
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" name="" onfocusout="passCheck()" v-model="conpass" id="conpass" class="form-control">
                    {{-- <span id="conpassspan" style="color:red">Confirm Password Can not be Empty</span> --}}
                    {{-- <span id="confpassspan" style="color:red">Password & Confirm Password does not Match</span> --}}
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="" id="updateaddress" class="form-control">
                    {{-- <span id="addressspan" style="color:red">Address Can not be Empty</span> --}}
                </div>
                <div class="form-group">
                    <label for="">Phone Number</label>
                    <input type="text" name="" id="updatephnnum" class="form-control">
                    {{-- <span id="phnnumspan" style="color:red">Phone Number Can not be Empty</span> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" @click="updateDataModal" class="btn btn-primary">Save changes</button>
            </div>
            <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="status=='success'">
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
            </div>
        </div>
    </div>
</div>

<script>

    


    var getAlldata=new Vue({

        el:"#showData",

        data:{

            i:0,

            valData:[],
        },
        methods:{

            getData:function(){

                axios.get('/admin/getAllUser').then(({data})=>this.valData=data.data);

            },
            updateData:function(id){

                axios.post('/admin/editUser',{

                    id:id,

                }).then(({data})=>this.name=data.data.name);

                console.log(id);

                $("#exampleModalCenter2").modal('show');

                $("#updatename").val(this.name);


            },

            deleteData:function(id){

                if(confirm('Are You Sure !!')){

                    console.log(id);

                    axios.post('/admin/deleteUser',{

                        id:id,

                    }).then(({data})=>this.status=data.status);

                    $("#show").show();

                    this.getData();

                }else{

                    return ;
                }
            }
        },
        mounted:function(){     

            console.log('Mounted');
            this.getData();
        }
    });

    function updateModal(id){

        console.log(id);

        $.ajax({

            type:'get',
            url:"{{route('admin.editUser')}}",
            data:{

                id:id,

            },
            success:function(data){

                console.log(data);

                $("#exampleModalCenter2").modal('show');

                console.log('endmodal');

                $("#updateid").val(id);
                $("#updatename").val(data.data.name);
                $("#updateusername").val(data.data.username);
                $("#existpass").val(data.data.password);
                $("#updateaddress").val(data.data.address);
                $("#updatephnnum").val(data.data.phnnumber);

            }
        });

    }

    var upDateModal=new Vue({

        el:"#dataentry",
        data:{

            updateid:"",
            updatename:"",
            updatepass:"",
            updateaddress:"",  
            updatephnnum:"",  
            existpass:"",  
        },
        methods:{

            updateDataModal:function(){

                var id=$("#updateid").val();
                var updatename=$("#updatename").val();
                var updatepass=$("#updatepass").val();
                var existpass=$("#existpass").val();
                var updateaddress=$("#updateaddress").val();
                var updatephnnum=$("#updatephnnum").val();

                this.updateid=id;
                this.updatename=updatename;
                this.updatepass=updatepass;
                this.existpass=existpass;
                this.updateaddress=updateaddress;
                this.updatephnnum=updatephnnum;

                axios.post('/admin/updateUser',{

                    updateid:this.updateid,
                    updatename:this.updatename,
                    updatepass:this.updatepass,
                    updateaddress:this.updateaddress,
                    updatephnnum:this.updatephnnum,
                    existpass:this.existpass,
                });

                $("#exampleModalCenter2").modal('hide');

                getAlldata.getData();
            }
        }

    });


    function openModal(){

        name=$("#name").val('');
        username=$("#username").val('');
        pass=$("#pass").val('');
        conpass=$("#conpass").val('');
        address=$("#address").val('');
        phnnum=$("#phnnum").val('');

        $("#exampleModalCenter").modal('show');
    }


    $("#namespan").hide();
    $("#usernamespan").hide();
    $("#passspan").hide();
    $("#conpassspan").hide();
    $("#confpassspan").hide();
    $("#addressspan").hide();
    $("#phnnumspan").hide();

    function passCheck(){

        pass=$("#pass").val();
        conpass=$("#conpass").val();

        console.log(pass);

        if(pass==conpass){

            $("#confpassspan").hide();

        }else{

            $("#confpassspan").show();

        }
    }

    name=$("#name").val();
    username=$("#username").val();
    pass=$("#pass").val();
    conpass=$("#conpass").val();
    address=$("#address").val();
    phnnum=$("#phnnum").val();


    var app= new Vue({

        el:"#exampleModalCenter",
        data:{
            
            name:"",
            username:"",
            pass:"",
            conpass:"",
            address:"",
            phnnum:"",

            status:"",
            
        },
        methods:{

            checkForm:function(e){

                if(!this.name){

                    $("#namespan").show();

                }else{

                    $("#namespan").hide();
                }
                if(!this.username){

                    $("#usernamespan").show();

                }else{

                    $("#usernamespan").hide();

                }
                if(!this.pass){

                    $("#passspan").show();

                }else{

                    $("#passspan").hide();

                }
                if(!this.conpass){

                    $("#confpassspan").show();

                }else{

                    $("#confpassspan").hide();

                }
                if(!this.address){

                    $("#addressspan").show();

                }else{

                    $("#addressspan").hide();
                }
                if(!this.phnnum){

                    $("#phnnumspan").show();

                }else{

                    $("#phnnumspan").hide();
                }

                if(this.name && this.username && this.pass && this.address && this.phnnum){

                    this.sendData(this.name,this.username,this.pass,this.address,this.phnnum);

                }else{

                    return ;
                }

                e.preventDefault();
            },

            sendData:function(name,username,pass,address,phnnum){

                axios.post('/admin/addUser',{
                    name:this.name,
                    username:this.username,
                    pass:this.pass,
                    address:this.address,
                    phnnum:this.phnnum,
                }).then(({data})=>this.status=data.status);

            }
        },


    });

    $("#show").hide();

    // var updateModal=new Vue({

    //     el:"#tableData",
    //     data:{
            
    //         name:"",
    //         username:"",
    //         pass:"",
    //         conpass:"",
    //         address:"",
    //         phnnum:"",
    //         status:"",

    //     },
    //     methods:{

    //         updateData:function(id){

    //             axios.post('/admin/editUser',{

    //                 id:id,

    //             }).then(({data})=>this.name=data.data.name);

    //             console.log(id);

    //             $("#exampleModalCenter2").modal('show');

    //             $("#updatename").val(this.name);
                

    //         },

    //         deleteData:function(id){

    //             if(confirm('Are You Sure !!')){

    //                 console.log(id);

    //                 axios.post('/admin/deleteUser',{

    //                     id:id,

    //                 }).then(({data})=>this.status=data.status);

    //                 $("#show").show();

    //             }else{

    //                 return ;
    //             }
    //         }
    //     }
    // });

    
    

    
</script>
    
@endsection