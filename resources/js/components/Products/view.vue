<template>
    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2  mt-2 ">
            <button type="button" class ="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Add Products
            </button>
        </div>
        <div class=" col-md-12">

            <div class="card-body">
                <div class="row">
                    <div class=" col-sm-12">
                        <div class="card card-shadow mb-4">
                            <div class="card-header">
                                <div class="card-title">
                                    Ajax Data Tables
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="ajax-datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row"><div class="col-sm-12"><table id="ajax-datatable" class="display table table-bordered table-striped dataTable" style="width: 100%;" role="grid" aria-describedby="ajax-datatable_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending" style="width: 144px;">Image</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 221px;">Title</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 105px;">Short Description</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Extn.: activate to sort column ascending" style="width: 49px;">Created By.</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 93px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr><th rowspan="1" colspan="1">Image</th>
                                        <th rowspan="1" colspan="1">Title</th>
                                        <th rowspan="1" colspan="1">Short Description</th>
                                        <th rowspan="1" colspan="1">Created By.</th>
                                        <th rowspan="1" colspan="1">Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">Airi Satou</td>
                                        <td>{{add_product.title}}</td>
                                        <td>{{add_product.short_desc}}}</td>
                                        <td>{{user.name}}</td>
                                        <td> <a href="#" class="btn btn-info btn-icon btn-sm edit">
                                            <i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger btn-icon btn-sm edit">
                                                <i class="fa fa-edit"></i></a>
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
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 1200px">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" class="form-control"  v-model="add_product.title"
                                           aria-describedby="emailHelp" placeholder="Enter Title">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sku</label>
                                    <input type="text" class="form-control"  v-model="add_product.sku"
                                           aria-describedby="emailHelp" placeholder="Enter Sku">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Keywords</label>
                                    <input type="text" class="form-control"   v-model="add_product.keyword"
                                           aria-describedby="emailHelp"
                                           placeholder="Enter Keyword">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp"  v-model="add_product.category"
                                           placeholder="Enter Category">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea rows="4" class="form-control" aria-describedby="emailHelp"  v-model="add_product.desc"
                                              placeholder="Enter Description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Short Description</label>
                                    <textarea rows="4" class="form-control" aria-describedby="emailHelp"  v-model="add_product.short_desc"
                                              placeholder="Enter Description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trade Name</label>
                                    <input type="text" class="form-control"  aria-describedby="emailHelp"  v-model="add_product.trade_name"
                                           placeholder="Enter Trade Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp"  v-model="add_product.brand_name"
                                           placeholder="Enter Brand Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Internal SKU</label>
                                    <input type="text" class="form-control"  aria-describedby="emailHelp"  v-model="add_product.internal_sku"
                                           placeholder="Enter Internal SKU">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Manufacture Number</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp"  v-model="add_product.manufact_number"
                                           placeholder="Enter Manufacture Number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Source</label>
                                    <input type="text" class="form-control"  aria-describedby="emailHelp"  v-model="add_product.product_source"
                                           placeholder="Enter Product Source">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Source URL</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp"  v-model="add_product.source_url"
                                           placeholder="Enter Source URl">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Code</label>
                                    <input type="text" class="form-control"  aria-describedby="emailHelp"  v-model="add_product.product_code"
                                           placeholder="Enter Product Code">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Remarks</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp"  v-model="add_product.remarks"
                                           placeholder="Enter Remarks">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Buying Price</label>
                                    <input type="text" class="form-control"  aria-describedby="emailHelp"  v-model="add_product.buying_price"
                                           placeholder="Enter Buying Price">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Weight</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp"  v-model="add_product.weight"
                                           placeholder="Enter Weight">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Size Length</label>
                                    <input type="text" class="form-control"  aria-describedby="emailHelp"  v-model="add_product.size_length"
                                           placeholder="Enter Size Length">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Size Width</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp"  v-model="add_product.size_width"
                                           placeholder="Enter Size Width">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Size Height</label>
                                    <input type="text" class="form-control"  aria-describedby="emailHelp"  v-model="add_product.size_height"
                                           placeholder="Enter Size Height">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Domestic Freight</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp"  v-model="add_product.dom_freight"
                                           placeholder="Enter Domestic Freight">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">International Freight</label>
                                    <input type="text" class="form-control"  aria-describedby="emailHelp"  v-model="add_product.int_freight"
                                           placeholder="Enter International Freight">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Discount</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp"  v-model="add_product.discount"
                                           placeholder="Enter Discount">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stock</label>
                                    <input type="text" class="form-control"  aria-describedby="emailHelp"  v-model="add_product.stock"
                                           placeholder="Enter Stock">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fill Time</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp"  v-model="add_product.Fill_time"
                                           placeholder="Enter Fill Time">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Extra Field 1</label>
                                    <input type="text" class="form-control"  aria-describedby="emailHelp"  v-model="add_product.extra_field1"
                                           placeholder="Enter Extra Field 1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Extra Field 2</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" v-model="add_product.extra_field2"
                                           placeholder="Enter Extra Field 2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Extra Field 3</label>
                                    <input type="text" class="form-control"  aria-describedby="emailHelp" v-model="add_product.extra_field3"
                                           placeholder="Enter Extra Field 3">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Extra Field 4</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" v-model="add_product.extra_field4"
                                           placeholder="Enter Extra Field 4">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Extra Field 5</label>
                                    <input type="text" class="form-control"  aria-describedby="emailHelp" v-model="add_product.extra_field5"
                                           placeholder="Enter Extra Field 5">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="fw-600 text-center">Approval Status</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control control-outline control--radio">Pending
                                            <input type="radio" name="Pending" value="1" v-model="add_product.approval_status">
                                            <span class="control__indicator"></span>
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="control control-outline control-outline-info control--radio">Fail
                                            <input type="radio" name="Fail" value="2" v-model="add_product.approval_status">
                                            <span class="control__indicator"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control control-outline control-outline-success control--radio">Success
                                            <input type="radio" name="Success" value="3" v-model="add_product.approval_status">
                                            <span class="control__indicator"></span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <p class="fw-600 text-center">Shelf Status</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control control-outline control--radio">OffShelf
                                            <input type="radio" name="OffShelf" value="1" v-model="add_product.shelf_status">
                                            <span class="control__indicator"></span>
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="control control-outline control-outline-info control--radio">OnShelf
                                            <input type="radio" name="OnShelf" value="2" v-model="add_product.shelf_status">
                                            <span class="control__indicator"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control control-outline control-outline-success control--radio">Disabled
                                            <input type="radio" name="Disabled" value="3" v-model="add_product.shelf_status">
                                            <span class="control__indicator"></span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <p class="fw-600 text-center">Product Type</p>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="control control-outline control--radio">Original
                                            <input type="radio" name="Original" value="1" v-model="add_product.product_type">
                                            <span class="control__indicator"></span>
                                        </label>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="control control-outline control-outline-info control--radio">Crawl
                                            <input type="radio" name="Crawl" value="2" v-model="add_product.product_type">
                                            <span class="control__indicator"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control control-outline control-outline-success control--radio">Overseas
                                            <input type="radio" name="Overseas" value="3" v-model="add_product.product_type">
                                            <span class="control__indicator"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control control-outline control-outline-success control--radio">Important
                                            <input type="radio" name="Important" value="4" v-model="add_product.product_type">
                                            <span class="control__indicator"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control control-outline control-outline-success control--radio">Library
                                            <input type="radio" name="Library" value="5" v-model="add_product.product_type">
                                            <span class="control__indicator"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control control-outline control-outline-success control--radio">Others
                                            <input type="radio" name="Others" v-model="add_product.product_type" value="6">
                                            <span class="control__indicator"></span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" @click="submit_product()" class="btn btn-primary">Add product</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!--Modal Open-->
</template>

<script>


    export default {
        name: "view.vue",
        props:['user'],
        data() {
            return {
               add_product:{
                 'title':'',
                 'sku':'',
                 'short_desc':'',
                 'desc':'',
                 'keyword':'',
                 'category':'',
                 'trade_name':'',
                 'brand_name':'',
                 'internal_sku':'',
                 'manufact_number':'',
                 'product_source':'',
                 'source_url':'',
                 'product_code':'',
                 'remarks':'',
                 'buying_price':'',
                 'weight':'',
                 'size_length':'',
                 'size_width':'',
                 'size_height':'',
                 'dom_freight':'',
                 'int_freight':'',
                 'discount':'',
                 'stock':'',
                 'Fill_time':'',
                 'extra_field1':'',
                 'extra_field2':'',
                 'extra_field3':'',
                 'extra_field4':'',
                 'extra_field5':'',
                 'approval_status':false,
                 'shelf_status':false,
                 'product_type':false,
               },
            }
        },
        created() {

        },
        mounted() {
            setTimeout(function () {
                    jQuery.noConflict();
            $(document).ready(function() {
                $('#ajax-datatable').DataTable( {
                } );
            } );
            },600);

            axios.get('/get/product', {
            }).then((response) => {
                this.add_product.title=response.data[0].title;
                this.add_product.short_desc=response.data[0].short_description;
            })

        },
        methods:{

            submit_product()
            {
                axios.post('/add/product', {
                   product:this.add_product,
                   user:this.user,
                }).then((response) => {
                    if (response.data=='success') {
                        swal({
                            title: 'Success!',
                            text: 'Product Successfully Added',
                            type: 'success',
                            confirmButtonClass: "btn btn-success",
                            buttonsStyling: false,
                        });
                        // this.table.draw();
                        $('#exampleModal').modal('toggle');
                    }
                })
            },

        }
    }
</script>

<style scoped>

</style>
