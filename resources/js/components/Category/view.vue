<template>
    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2 mt-2 ">
            <button type="button" class ="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-right: 8px;float:right"
                    v-on:click="open_modal()">
                Add Category
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class=" col-md-12">
                    <div class="card card-shadow mb-4">
                        <div class="card-header">
                            <div class="card-title text-center">
                                <b style="font-size:22px">Category Detail</b>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="ajax-datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row"><div class="col-sm-12"><table id="ajax-datatable" class="display table table-bordered table-striped dataTable" style="width: 100%;" role="grid" aria-describedby="ajax-datatable_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending" style="width: 144px;">Name</th>
                                        <th class="sorting text-center" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 93px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr><th rowspan="1" colspan="1">Name</th>
                                        <th rowspan="1" colspan="1" class="text-center">Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <tr role="row" class="odd" v-for="category in data">
                                        <td class="sorting_1">{{category.title}}</td>
                                        <td class="text-center"> <a href="#" class="btn btn-info btn-icon btn-sm edit"
                                                                    v-on:click="edit_user(category.id)">
                                            <i class="fa fa-edit"  title="Edit Category"></i></a>
                                            <a href="#" v-on:click="delete_user(category.id)" class="btn btn-danger btn-icon btn-sm delete">
                                                <i class="fa fa-trash" title="Delete Category"></i></a>
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
                            <h5 class="modal-title"  v-if="add_category.id==''" >Add Category</h5>
                            <h5  v-else class="modal-title" >Update Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" v-model="add_category.name"
                                           aria-describedby="emailHelp" placeholder="Enter Category Name">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-if="add_category.id==''" type="button" @click="submit_category()" class="btn btn-primary">Add Category</button>
                            <button v-else type="button" @click="submit_category()" class="btn btn-primary">Update Category</button>
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
                add_category:{
                    'id':'',
                    'name':'',
                },
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

            axios.get('/get/category', {
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

            submit_category()
            {
                let flag=true;
                if(this.add_category.name=='') {
                    flag=false;
                    return swal({
                        title: "Category Name is Required",
                        text: "Please Enter Name Field",
                        icon: "warning",
                    });
                }

                if(flag) {
                    let self = this;
                    self.product_datatable.destroy();
                    axios.post('/add/category', {
                        add_category: this.add_category,
                        user: this.user,
                    }).then((response) => {
                        swal({
                            title: "Success",
                            text: "Category Successfully "+this.status,
                            icon: "success",
                        });
                        this.data = response.data;
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

                    }).catch(error => {
                    });
                    $('#exampleModal').toggle();
                    $('#exampleModal').removeClass('.modal-backdrop.show');
                }
            },
            delete_user(id)
            {
                let self = this;
                swal({
                    title: "Are you sure?",
                    text: "You want to Delete this Category!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        swal("Category has Been Successfully Deleted!", {
                            icon: "success",
                        });
                        self.product_datatable.destroy();
                        axios.get('/delete/category/' + id).then((response) => {
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
                axios.get('/edit/category/'+id).then((response) => {
                    this.add_category.id=response.data.id;
                    this.add_category.name=response.data.title;
                    $('#exampleModal').modal('toggle');
                });
            },
            open_modal()
            {
                $('#exampleModal').modal('show');

                this.status='Added';
                this.add_category={
                    'id':'',
                    'name':'',
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
