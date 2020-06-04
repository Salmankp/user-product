<template>
    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2 mt-2 ">
            <button type="button" class ="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-right: 8px;float:right"
                    v-on:click="open_modal()">
                Add User
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class=" col-md-12">
                    <div class="card card-shadow mb-4">
                        <div class="card-header">
                            <div class="card-title text-center">
                                <b style="font-size:22px">Users Detail</b>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="ajax-datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row"><div class="col-sm-12"><table id="ajax-datatable" class="display table table-bordered table-striped dataTable" style="width: 100%;" role="grid" aria-describedby="ajax-datatable_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending" style="width: 144px;">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 221px;">Email</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 105px;">Username</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Extn.: activate to sort column ascending" style="width: 49px;">Status</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Extn.: activate to sort column ascending" style="width: 49px;">Role</th>
                                        <th class="sorting text-center" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 93px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr><th rowspan="1" colspan="1">Name</th>
                                        <th rowspan="1" colspan="1">Email</th>
                                        <th rowspan="1" colspan="1">Username</th>
                                        <th rowspan="1" colspan="1">Status</th>
                                        <th rowspan="1" colspan="1">Role</th>
                                        <th rowspan="1" colspan="1" class="text-center">Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <tr role="row" class="odd" v-for="user in data">
                                        <td class="sorting_1">{{user.name}}</td>
                                        <td>{{user.email}}</td>
                                        <td>{{user.username}}</td>
                                        <td v-if="user.status==1"><span class="badge badge-success">Active</span></td>
                                        <td v-else><span class="badge badge-danger">Inactive</span></td>
                                        <td>{{user.role}}</td>
                                        <td class="text-center"> <a href="#" class="btn btn-info btn-icon btn-sm edit" v-on:click="edit_user(user.id)">
                                            <i class="fa fa-edit"  title="Edit User"></i></a>
                                            <a href="#" v-on:click="delete_user(user.id)" class="btn btn-danger btn-icon btn-sm delete">
                                                <i class="fa fa-trash" title="Delete User"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" data-backdrop="false"  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="max-width: 800px">
                    <div class="modal-content" >
                        <div class="modal-header">
                            <h5 class="modal-title"  v-if="add_user.id==''" >Add User</h5>
                            <h5  v-else class="modal-title" >Update User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" v-model="add_user.name"
                                               aria-describedby="emailHelp" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control" v-model="add_user.email"
                                               aria-describedby="emailHelp" placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" v-if="add_user.id==''">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input type="password" class="form-control"
                                               aria-describedby="emailHelp" v-model="add_user.password"
                                               placeholder="Enter Password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="text" class="form-control" aria-describedby="emailHelp" v-model="add_user.username"
                                               placeholder="Enter Username">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Role</label>
                                        <select class="form-control valid" aria-invalid="false" v-model="add_user.role">
                                            <option value="" selected>Select Role</option>
                                            <option value="Master User" v-if="user.role=='admin'">Master User</option>
                                            <option value="Child User">Child User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Status</label>
                                        <select class="form-control valid" aria-invalid="false" v-model="add_user.status">
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Extra Field 1</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" v-model="add_user.field1"
                                           placeholder="Enter Field1">
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Extra Field 2</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" v-model="add_user.field2"
                                           placeholder="Enter Field2">
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Extra Field 3</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" v-model="add_user.field3"
                                           placeholder="Enter Field3">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-if="add_user.id==''" type="button" @click="submit_user()" class="btn btn-primary">Add User</button>
                            <button v-else type="button" @click="submit_user()" class="btn btn-primary">Update User</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</template>

<script>


    export default {
        name: "view.vue",
        props:['user'],
        data() {
            return {
                add_user:{
                    'id':'',
                    'name':'',
                    'username':'',
                    'email':'',
                    'password':'',
                    'role':'',
                    'status':'',
                    'field1':'',
                    'field2':'',
                    'field3':'',
                },
                reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
                data:[],
                product_datatable:'',
                status:'',
            }
        },
        created() {

        },
        mounted() {
            console.log(this.user);
            let self=this;
            /* setTimeout(function () {
                     jQuery.noConflict();

             },600);*/

            axios.get('/get/user', {
            }).then((response) => {
                setTimeout(function () {
                    jQuery.noConflict();
                    $(document).ready(function () {
                        self.product_datatable=$('#ajax-datatable').DataTable({
                            language: {
                                search: "_INPUT_",
                                searchPlaceholder: "Search records",
                            },
                            "fnDrawCallback":function(){
                                $("input[type='search']").attr("id", "searchBox");
                                $('#searchBox').css("width", "200px");
                                $('.dataTables_filter').css("float", "right");
                            }
                        });
                    });
                },600);
                this.data=response.data;
            })

        },
        methods:{

            submit_user()
            {
                let flag=true;
                if(this.add_user.name=='') {
                    flag=false;
                    return swal({
                        title: "Name is Required",
                        text: "Please Enter Name Field",
                        icon: "warning",
                    });
                }
                if(this.add_user.email=='') {
                    flag=false;
                    return swal({
                        title: "Email is Required",
                        text: "Please Enter Email Address",
                        icon: "warning",
                    });
                }
                 if(!this.reg.test(this.add_user.email))
                {
                    flag=false;
                    return swal({
                        title: "Email Is Invalid",
                        text: "Please Enter Valid Email Address",
                        icon: "warning",
                    });
                }
                if(this.add_user.username=='')
                {
                    flag=false;
                    return swal({
                        title: "Username is Required",
                        text: "Please Enter Username",
                        icon: "warning",
                    });
                }
                if(this.add_user.id=='' && this.add_user.password=='')
                {
                    flag=false;
                    return swal({
                        title: "Password is Required",
                        text: "Please Enter Password",
                        icon: "warning",
                    });
                }
                if(this.add_user.role=='')
                {
                    flag=false;
                    return swal({
                        title: "Role is Required",
                        text: "Please Select User Role",
                        icon: "warning",
                    });
                }
                if(this.add_user.status=='' && this.add_user.status!=0)
                {
                    flag=false;
                    return swal({
                        title: "Status is Required",
                        text: "Please Select Status",
                        icon: "warning",
                    });
                }

                if(flag) {
                    let self = this;
                    axios.post('/add/user', {
                        add_user: this.add_user,
                        user: this.user,
                    }).then((response) => {
                        if(response.data) {
                                self.product_datatable.destroy();
                                swal({
                                    title: "Success",
                                    text: "User Successfully " + this.status,
                                    icon: "success",
                                });
                                this.data = response.data;
                                $(document).ready(function () {
                                    self.product_datatable = $('#ajax-datatable').DataTable({
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search records",
                                        },
                                        "fnDrawCallback": function () {
                                            $("input[type='search']").attr("id", "searchBox");
                                            $('#searchBox').css("width", "200px");
                                            $('.dataTables_filter').css("float", "right");
                                        }
                                    });
                                });

                            $('#exampleModal').toggle();
                            $('#exampleModal').removeClass('.modal-backdrop.show');
                            }
                    }).catch(error => {
                        if(error) {
                            swal({
                                title: "Failed",
                                text: "Email or Username Already Exists",
                                icon: "error",
                            });
                        }
                    });

                }
            },
            delete_user(id)
            {
                let self = this;
                swal({
                    title: "Are you sure?",
                    text: "You want to Delete this User!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        swal("User has Been Successfully Deleted!", {
                            icon: "success",
                        });
                        self.product_datatable.destroy();
                        axios.get('/delete/user/' + id).then((response) => {
                            if (response.data) {
                                $(document).ready(function () {
                                    self.product_datatable = $('#ajax-datatable').DataTable({
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search records",
                                        },
                                        "fnDrawCallback":function(){
                                            $("input[type='search']").attr("id", "searchBox");
                                            $('#searchBox').css("width", "200px");
                                            $('.dataTables_filter').css("float", "right");
                                        }
                                    });
                                });
                                this.data = response.data;

                            }
                        });
                    }
                });

            },
            edit_user(id)
            {
                this.status='Updated';
                axios.get('/edit/user/'+id).then((response) => {
                    this.add_user.id=response.data.id;
                    this.add_user.name=response.data.name;
                    this.add_user.username=response.data.username;
                    this.add_user.email=response.data.email;
                    this.add_user.role=response.data.role;
                    this.add_user.status=response.data.status;
                    this.add_user.field1=response.data.extra_field_1;
                    this.add_user.field2=response.data.extra_field_2;
                    this.add_user.field3=response.data.extra_field_3;
                    $('#exampleModal').modal('toggle');
                });
            },
            open_modal()
            {
                $('#exampleModal').modal('show');

                this.status='Added';
                this.add_user={
                        'id':'',
                        'name':'',
                        'username':'',
                        'email':'',
                        'password':'',
                        'role':'',
                        'status':'1',
                        'field1':'',
                        'field2':'',
                        'field3':'',
                }
            },


        }
    }
</script>

<style scoped>
    .modal {
        overflow-y: scroll; /*default*/
        overflow-y: auto;
    }


</style>
