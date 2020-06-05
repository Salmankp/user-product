<template>
    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2  mt-2 ">
            <button type="button" class ="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-right: 8px;float:right"
                    v-on:click="open_modal()">
                Add Product
            </button>
        </div>
            <div class="card-body">
                <div class="row">
                    <div class=" col-md-12">
                        <div class="card card-shadow mt-1">
                            <div class="card-header">
                                <div class="card-title text-center">
                                    <b style="font-size:22px">Products Detail</b>
                                </div>
                                <div class="row mt-1 mt-1">

<!--                                    <div class="col-md-2"></div>-->

                                    <div class="col-md-2">
                                        <select class="form-control valid" aria-invalid="false" v-model="search_category">
                                            <option value="" disabled selected>Select Category</option>
                                            <option :value="data.id" selected v-for="data in category">
                                                {{data.title}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Enter Internal Sku" v-model="search_internal_sku">
                                    </div>
                                    <div class="col-md-2" v-if="user.role=='admin' || user.role=='Master User'">
                                        <select class="form-control valid" aria-invalid="false" v-model="search_user">
                                            <option value="" disabled selected>Select Users</option>
                                            <option :value="data.id" selected v-for="data in users">
                                                {{data.username}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control valid" aria-invalid="false" v-model="search_shelf">
                                            <option value="" disabled selected>Select Shelf Status</option>
                                            <option value="1">Off shelf</option>
                                            <option value="2">On shelf</option>
                                            <option value="3">Disabled</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control valid" aria-invalid="false" v-model="search_approval">
                                            <option value="" disabled selected>Select Approval Status</option>
                                            <option value="1">Pending</option>
                                            <option value="2">Fail</option>
                                            <option value="3">Success</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control valid" aria-invalid="false" v-model="search_product_type">
                                            <option value="" disabled selected>Product Type</option>
                                            <option value="1">Original</option>
                                            <option value="2">Crawl</option>
                                            <option value="3">Overseas</option>
                                            <option value="4">Important</option>
                                            <option value="5">Library</option>
                                            <option value="6">other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-1 mt-2">

                                    <div class="col-md-2 offset-md-10">
                                        <button @click="search" class="btn btn-sm btn-info text-left ml-5 mr-2">Search</button>
                                        <button @click="reset_filter()" class="btn btn-sm btn-danger text-right">Reset</button>
                                    </div>
                                </div>

                                <div class="row mt-1 mt-2 px-4">


                                    <h6><strong>Shelf status: </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>

                                    <span class="badge badge-info pt-2 mx-1">All {{(off_shelf_count+on_shelf_count+disable_count)}}</span>
                                    <span class="badge badge-info pt-2 mx-1">Off shelf {{(off_shelf_count)}}</span>
                                    <span class="badge badge-info pt-2 mx-1">On shelf {{(on_shelf_count)}}</span>
                                    <span class="badge badge-info pt-2 mx-1">Disable {{(disable_count)}}</span>
                                </div>
                                <div class="row mt-1 mt-1 px-4">


                                    <h6><strong>Product Type:</strong> &nbsp;&nbsp;&nbsp;</h6>

                                    <span class="badge badge-info pt-2 mx-1">All
                                        {{(original+crawl+overseas+important+library+others)}}</span>
                                    <span class="badge badge-info pt-2 mx-1">
                                      Original {{(original)}}</span>
                                    <span class="badge badge-info pt-2 mx-1">Crawl {{(crawl)}}</span>
                                    <span class="badge badge-info pt-2 mx-1">Overseas {{(overseas)}}</span>
                                    <span class="badge badge-info pt-2 mx-1">Important {{(important)}}</span>
                                    <span class="badge badge-info pt-2 mx-1">Library {{(library)}}</span>
                                    <span class="badge badge-info pt-2 mx-1">Others {{(others)}}</span>
                                </div>
                                <div class="row mt-1 mt-1 px-4">


                                    <h6><strong>Approval status: </strong> </h6>

                                    <span class="badge badge-info pt-2 mx-1">All {{(
                                        pending_count+failure_count+success_count)}}</span>
                                    <span class="badge badge-info pt-2 mx-1">pending {{(pending_count)}}</span>
                                    <span class="badge badge-info pt-2 mx-1">failure {{(failure_count)}}</span>
                                    <span class="badge badge-info pt-2 mx-1">success {{(success_count)}}</span>
                                </div>


                            </div>
                            <div class="card-body">
                                <div id="ajax-datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <table id="ajax-datatable" class="display table table-bordered table-striped dataTable"
                                               style="width: 100%;" role="grid" aria-describedby="ajax-datatable_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending" style="width: 144px;">Image</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 221px;">Category Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 221px;">Title</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 105px;">Internal SKU</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 105px;">Product Type</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 105px;">Price</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Extn.: activate to sort column ascending" style="width: 49px;">Created By</th>
                                        <th class="sorting" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Extn.: activate to sort column ascending" style="width: 49px;">Created At</th>
                                        <th class="sorting text-center" tabindex="0" aria-controls="ajax-datatable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 93px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr><th rowspan="1" colspan="1">Image</th>
                                        <th rowspan="1" colspan="1">Category Name</th>
                                        <th rowspan="1" colspan="1">Title</th>
                                        <th rowspan="1" colspan="1">Internal SKU</th>
                                        <th rowspan="1" colspan="1">Product Type</th>
                                        <th rowspan="1" colspan="1">Price</th>
                                        <th rowspan="1" colspan="1">Created By</th>
                                        <th rowspan="1" colspan="1">Created At</th>
                                        <th rowspan="1" colspan="1" class="text-center">Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <tr role="row" class="odd" v-for="detail in data">
                                        <td class="sorting_1" v-if="detail.product_image==null">
                                            <p>No Image</p>
                                        </td>
                                        <td v-else>
                                            <img :src="detail.product_image.image_url" alt="no image" width="50px" height="50px" >
                                        </td>
                                        <td>{{detail.category.title}}</td>
                                        <td>{{detail.title}}</td>
                                        <td>{{detail.internal_sku}}</td>

                                        <td v-if="detail.product_type==1">
                                          original
                                        </td>
                                        <td v-if="detail.product_type==2">
                                           crawl
                                        </td>
                                        <td v-if="detail.product_type==3">
                                            overseas
                                        </td>
                                        <td v-if="detail.product_type==4">
                                            important
                                        </td>
                                        <td v-if="detail.product_type==5">
                                          library
                                        </td>
                                        <td v-if="detail.product_type==6">
                                           other
                                        </td>

                                        <td>{{detail.buying_price}}</td>
                                        <td>{{detail.user.username}}</td>
                                        <td>{{detail.created_at}}</td>
                                        <td class="text-center"> <a href="#" title="Edit Product" class="btn btn-info btn-icon btn-sm edit" v-on:click="edit_product(detail.id)">
                                            <i class="fa fa-edit"  title="Edit"></i></a>
                                            <a href="#" v-on:click="delete_product(detail.id)" title="Delete Product" class="btn btn-danger btn-icon btn-sm delete">
                                                <i class="fa fa-trash" title="Delete"></i></a>
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
                <div class="modal modal-open" data-backdrop="false"  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="max-width: 1200px">
                        <div class="modal-content" >
                            <div class="modal-header">
                                <h5 class="modal-title"  v-if="add_product.id==''">Add Product</h5>
                                <h5 class="modal-title"  v-else>Update Product</h5>
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
                                            <select class="form-control valid" aria-invalid="false" v-model="add_product.category">
                                                <option value="" disabled selected>Select Category</option>
                                                <option :value="data.id" selected v-for="data in category">
                                                    {{data.title}}</option>
                                            </select>
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

                        <!-- row -->
                        <div class="row mt-2">

                            <!-- status col-6 -->
                            <div class="col-6">

                                <div class="row mt-2">
                                    <div class="col-md-12">
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
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <p class="fw-600 text-center">Shelf Status</p>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control control-outline control--radio">Off-Shelf
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

                            <!-- end status col-6 -->
                            </div>


                            <div class="col-6">
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1"><b>Select Product Images</b></label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="file" @change="image_change"  name="image" ref="files" multiple/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p v-for="(image,index) in images" :key="index">{{image.name}}</p>
                                    </div>
                                </div>
                            </div>

                         </div>
                        <!-- end row -->

                        </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button v-if="add_product.id==''" type="button" @click="submit_product()" class="btn btn-primary">Add product</button>
                                <button v-else type="button" @click="submit_product()" class="btn btn-primary">Update product</button>
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
                pending_count:0,
                failure_count:0,
                success_count:0,
                off_shelf_count:0,
                on_shelf_count:0,
                disable_count:0,
                original:0,
                crawl:0,
                overseas:0,
                important:0,
                library:0,
                others:0,
                users:[],
                search_category:'',
                search_internal_sku:'',
                search_user:'',
                search_shelf:'',
                search_approval:'',
                search_product_type:'',
                img_url:'',
               add_product:{
                  'id':'',
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
                 'approval_status':1,
                 'shelf_status':1,
                 'product_type':1,
               },
                status:'',
                images:[],
                data:[],
                category:[],
                product_datatable:'',
            }
        },
        created() {

        },
        mounted() {
            let self=this;
            axios.get('/get/category', {
            }).then((response) => {
                this.category=response.data;
            })

           /* setTimeout(function () {
                    jQuery.noConflict();

            },600);*/

            axios.get('/get/product', {
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
                $.each(response.data, function(key, value) {
                   console.log(value.approval_status);
                   if(value.product_type==1) {
                       console.log('1');
                       self.original++;
                   }
                    if(value.product_type==2) {
                        console.log('2');
                        this.crawl++;
                    }if(value.product_type==3) {
                        console.log('3');
                        self.overseas++;
                    }
                    if(value.product_type==4) {
                        console.log('4');
                        self.important++;
                    }
                    if(value.product_type==5) {
                        console.log('5');
                        self.library++;
                    }if(value.product_type==6) {
                        console.log('6');
                        self.others++;
                    }
                });

            $.each(response.data, function(key, value) {
                console.log(value.shelf_status);
                if(value.shelf_status==1) {
                    console.log('4');
                    self.off_shelf_count++;
                }
                if(value.shelf_status==2) {
                    console.log('5');
                    self.on_shelf_count++;
                }if(value.shelf_status==3) {
                    console.log('6');
                    self.disable_count++;
                }
            });

                $.each(response.data, function(key, value) {
                    console.log(value.approval_status);
                    if(value.approval_status==1) {
                        console.log('1');
                        self.pending_count++;
                    }
                    if(value.approval_status==2) {
                        console.log('2');
                        self.failure_count++;
                    }if(value.approval_status==3) {
                        console.log('3');
                        self.success_count++;
                    }
                });

            });

            axios.get('/get/all/users', {
            }).then((response) => {
                    this.users=response.data;
            });
        },
        methods:{
            search()
            {
                let self=this;
                if(this.search_approval=='' && this.search_shelf=='' && this.search_category=='' && this.search_user=='' && this.search_internal_sku==''&& this.search_product_type=='')
                {
                    return swal({
                        title: "Search Field is Required",
                        text: "Please Select Any Field ",
                        icon: "warning",
                    });
                }
                else {
                    self.product_datatable.destroy();

                    axios.post('/search/product', {
                        category: this.search_category,
                        shelf: this.search_shelf,
                        approval: this.search_approval,
                        product_type:this.search_product_type,
                        internal_sku:this.search_internal_sku,
                        user: this.search_user,
                    }).then((response) => {
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
                    })
                }
            },

            reset_filter()
            {
             let self = this;
              this.search_category='';
              this.search_user='';
              this.search_shelf='';
              this.search_approval='';
              this.search_internal_sku='';
              this.search_product_type='';
                self.product_datatable.destroy();
                axios.get('/get/product', {
                }).then((response) => {
                    this.reset_value();
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
                    $.each(response.data, function(key, value) {
                        console.log(value.approval_status);
                        if(value.product_type==1) {
                            console.log('1');
                            self.original++;
                        }
                        if(value.product_type==2) {
                            console.log('2');
                            this.crawl++;
                        }if(value.product_type==3) {
                            console.log('3');
                            self.overseas++;
                        }
                        if(value.product_type==4) {
                            console.log('4');
                            self.important++;
                        }
                        if(value.product_type==5) {
                            console.log('5');
                            self.library++;
                        }if(value.product_type==6) {
                            console.log('6');
                            self.others++;
                        }
                    });

                    $.each(response.data, function(key, value) {
                        console.log(value.shelf_status);
                        if(value.shelf_status==1) {
                            console.log('1');
                            self.off_shelf_count++;
                        }
                        if(value.shelf_status==2) {
                            console.log('2');
                            self.on_shelf_count++;
                        }if(value.shelf_status==3) {
                            console.log('3');
                            self.disable_count++;
                        }
                    });

                    $.each(response.data, function(key, value) {
                        console.log(value.approval_status);
                        if(value.approval_status==1) {
                            console.log('1');
                            self.pending_count++;
                        }
                        if(value.approval_status==2) {
                            console.log('2');
                            self.failure_count++;
                        }if(value.approval_status==3) {
                            console.log('3');
                            self.success_count++;
                        }
                    });
                })


            },
            submit_product()
            {
                let flag=true;
                let self=this;
                if(this.add_product.title=='') {
                    flag=false;
                    return swal({
                        title: "Product Title is Required",
                        icon: "warning",
                    });
                }
                if(this.add_product.category=='') {
                    flag=false;
                    return swal({
                        title: "Product Category is Required",
                        icon: "warning",
                    });
                }
                if(this.add_product.internal_sku=='') {
                    flag=false;
                    return swal({
                        title: "Internal Sku is Required",
                        icon: "warning",
                    });
                }
                if(this.add_product.buying_price=='') {
                    flag=false;
                    return swal({
                        title: "Buying Price is Required",
                        icon: "warning",
                    });
                }
                if(this.add_product.weight=='') {
                    flag=false;
                    return swal({
                        title: "Product Weight is Required",
                        icon: "warning",
                    });
                }
                if(this.add_product.size_length=='') {
                    flag=false;
                    return swal({
                        title: "Product Size Length is Required",
                        icon: "warning",
                    });
                }
                if(this.add_product.size_width=='') {
                    flag=false;
                    return swal({
                        title: "Product Size idth is Required",
                        icon: "warning",
                    });
                }
                if(this.add_product.size_height=='') {
                    flag=false;
                    return swal({
                        title: "Product Size Height is Required",
                        icon: "warning",
                    });
                }
                if(this.add_product.discount=='') {
                    flag=false;
                    return swal({
                        title: "Product Discount is Required",
                        icon: "warning",
                    });
                }
                if(this.add_product.stock=='') {
                    flag=false;
                    return swal({
                        title: "Product Stock is Required",
                        icon: "warning",
                    });
                }
                if(this.add_product.Fill_time=='') {
                    flag=false;
                    return swal({
                        title: "Product Fill Time is Required",
                        icon: "warning",
                    });
                }

                if(flag) {
                    self.product_datatable.destroy();
                    let formData = new FormData();
                    for (let i = 0; i < this.images.length; i++) {
                        let file = self.images[i];
                        formData.append('files[' + i + ']', file);
                    }
                    const config = {
                        headers: {"content-type": "multipart/form-data"}
                    }
                    formData.append('id', this.add_product.id);
                    formData.append('title', this.add_product.title);
                    formData.append('sku', this.add_product.sku);
                    formData.append('desc', this.add_product.desc);
                    formData.append('short_desc', this.add_product.short_desc);
                    formData.append('keyword', this.add_product.keyword);
                    formData.append('category', this.add_product.category);
                    formData.append('trade_name', this.add_product.trade_name);
                    formData.append('brand_name', this.add_product.brand_name);
                    formData.append('manufact_number', this.add_product.manufact_number);
                    formData.append('internal_sku', this.add_product.internal_sku);
                    formData.append('product_source', this.add_product.product_source);
                    formData.append('discount', this.add_product.discount);
                    formData.append('source_url', this.add_product.source_url);
                    formData.append('product_code', this.add_product.product_code);
                    formData.append('remarks', this.add_product.remarks);
                    formData.append('buying_price', this.add_product.buying_price);
                    formData.append('weight', this.add_product.weight);
                    formData.append('size_length', this.add_product.size_length);
                    formData.append('size_width', this.add_product.size_width);
                    formData.append('size_height', this.add_product.size_height);
                    formData.append('dom_freight', this.add_product.dom_freight);
                    formData.append('int_freight', this.add_product.int_freight);
                    formData.append('stock', this.add_product.stock);
                    formData.append('fill_time', this.add_product.Fill_time);
                    formData.append('extra_field1', this.add_product.extra_field1);
                    formData.append('extra_field2', this.add_product.extra_field2);
                    formData.append('extra_field3', this.add_product.extra_field3);
                    formData.append('extra_field4', this.add_product.extra_field4);
                    formData.append('extra_field5', this.add_product.extra_field5);
                    formData.append('approval_status', this.add_product.approval_status);
                    formData.append('shelf_status', this.add_product.shelf_status);
                    formData.append('product_type', this.add_product.product_type);
                    formData.append('user_id', this.user.id);

                    axios.post('/add/product', formData, config).then((response) => {
                        this.data = response.data;
                        swal({
                            title: "Success",
                            text: "Product Successfully "+this.status,
                            icon: "success",
                        });
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
                        this.reset_value();
                        $.each(response.data, function(key, value) {
                            console.log(value.approval_status);
                            if(value.product_type==1) {
                                console.log('1');
                                self.original++;
                            }
                            if(value.product_type==2) {
                                console.log('2');
                                this.crawl++;
                            }if(value.product_type==3) {
                                console.log('3');
                                self.overseas++;
                            }
                            if(value.product_type==4) {
                                console.log('4');
                                self.important++;
                            }
                            if(value.product_type==5) {
                                console.log('5');
                                self.library++;
                            }if(value.product_type==6) {
                                console.log('6');
                                self.others++;
                            }
                        });

                        $.each(response.data, function(key, value) {
                            console.log(value.shelf_status);
                            if(value.shelf_status==1) {
                                console.log('1');
                                self.off_shelf_count++;
                            }
                            if(value.shelf_status==2) {
                                console.log('2');
                                self.on_shelf_count++;
                            }if(value.shelf_status==3) {
                                console.log('3');
                                self.disable_count++;
                            }
                        });

                        $.each(response.data, function(key, value) {
                            console.log(value.approval_status);
                            if(value.approval_status==1) {
                                console.log('1');
                                self.pending_count++;
                            }
                            if(value.approval_status==2) {
                                console.log('2');
                                self.failure_count++;
                            }if(value.approval_status==3) {
                                console.log('3');
                                self.success_count++;
                            }
                        });
                        // $('#exampleModal').modal('toggle');
                        $('#exampleModal').toggle();
                        $('#exampleModal').removeClass('.modal-backdrop.show');
                    })
                }
            },
            delete_product(id)
            {
                let self = this;

                swal({
                    title: "Are you sure?",
                    text: "You want to Delete this Product!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        swal("Product has Been Successfully Deleted!", {
                            icon: "success",
                        });
                        self.product_datatable.destroy();
                        axios.get('/delete/product/' + id).then((response) => {
                            if (response.data) {
                                this.reset_value();
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
                                this.reset_value();
                                $.each(response.data, function(key, value) {
                                    console.log(value.approval_status);
                                    if(value.product_type==1) {
                                        console.log('1');
                                        self.original++;
                                    }
                                    if(value.product_type==2) {
                                        console.log('2');
                                        this.crawl++;
                                    }if(value.product_type==3) {
                                        console.log('3');
                                        self.overseas++;
                                    }
                                    if(value.product_type==4) {
                                        console.log('4');
                                        self.important++;
                                    }
                                    if(value.product_type==5) {
                                        console.log('5');
                                        self.library++;
                                    }if(value.product_type==6) {
                                        console.log('6');
                                        self.others++;
                                    }
                                });

                                $.each(response.data, function(key, value) {
                                    console.log(value.shelf_status);
                                    if(value.shelf_status==1) {
                                        console.log('1');
                                        self.off_shelf_count++;
                                    }
                                    if(value.shelf_status==2) {
                                        console.log('2');
                                        self.on_shelf_count++;
                                    }if(value.shelf_status==3) {
                                        console.log('3');
                                        self.disable_count++;
                                    }
                                });

                                $.each(response.data, function(key, value) {
                                    console.log(value.approval_status);
                                    if(value.approval_status==1) {
                                        console.log('1');
                                        self.pending_count++;
                                    }
                                    if(value.approval_status==2) {
                                        console.log('2');
                                        self.failure_count++;
                                    }if(value.approval_status==3) {
                                        console.log('3');
                                        self.success_count++;
                                    }
                                });
                            }
                        });
                    }
                });

            },
            edit_product(id)
            {
                this.status='Updated';
                axios.get('/edit/product/'+id).then((response) => {
                        this.add_product.id=response.data.id;
                        this.add_product.title=response.data.title;
                        this.add_product.sku=response.data.sku;
                        this.add_product.short_desc=response.data.short_description;
                        this.add_product.desc=response.data.description;
                        this.add_product.keyword=response.data.keywords;
                        this.add_product.category=response.data.category_id;
                        this.add_product.trade_name=response.data.trade_name;
                        this.add_product.brand_name=response.data.brand_name;
                        this.add_product.internal_sku=response.data.internal_sku;
                        this.add_product.manufact_number=response.data.manufacturer_number;
                        this.add_product.product_source=response.data.product_source;
                        this.add_product.source_url=response.data.source_url;
                        this.add_product.product_code=response.data.product_code;
                        this.add_product.remarks=response.data.remarks;
                        this.add_product.buying_price=response.data.buying_price;
                        this.add_product.weight=response.data.weight;
                        this.add_product.size_length=response.data.size_length;
                        this.add_product.size_width=response.data.size_width;
                        this.add_product.size_height=response.data.size_height;
                        this.add_product.dom_freight=response.data.domestic_freight;
                        this.add_product.int_freight=response.data.international_freight;
                        this.add_product.discount=response.data.discount;
                        this.add_product.stock=response.data.stock;
                        this.add_product.Fill_time=response.data.fill_time;
                        this.add_product.extra_field1=response.data.extra_field_1;
                        this.add_product.extra_field2=response.data.extra_field_2;
                        this.add_product.extra_field3=response.data.extra_field_3;
                        this.add_product.extra_field4=response.data.extra_field_4;
                        this.add_product.extra_field5=response.data.extra_field_5;
                        this.add_product.approval_status=response.data.approval_status;
                        this.add_product.shelf_status=response.data.shelf_status;
                        this.add_product.product_type=response.data.product_type;
                        this.images=[];
                         $('#exampleModal').modal('toggle');
                });
            },
            reset_value()
            {
                this.pending_count=0;
                    this.failure_count=0;
                    this.success_count=0;
                    this.off_shelf_count=0;
                    this.on_shelf_count=0;
                    this.disable_count=0;
                    this.original=0;
                    this.crawl=0;
                    this.overseas=0;
                    this.important=0;
                    this.library=0;
                    this.others=0;
            },
            open_modal()
            {
                this.status='Added';
                this.pending_count=0;
                    this.failure_count=0;
                    this.success_count=0;
                    this.off_shelf_count=0;
                    this.on_shelf_count=0;
                    this.disable_count=0;
                    this.original=0;
                    this.crawl=0;
                    this.overseas=0;
                    this.important=0;
                    this.library=0;
                    this.others=0;
                this.add_product={
                        'id':'',
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
                        'approval_status':1,
                        'shelf_status':1,
                        'product_type':1,
                },
                    this.images=[];
                $('#exampleModal').modal('toggle');
            },

            image_change(){
                for(let i=0; i<this.$refs.files.files.length;i++)
                {
                        this.images.push(this.$refs.files.files[i]);
                        console.log(this.images);
                }
            }

        }
    }
</script>

<style scoped>
    .modal {
        overflow-y: scroll; /*default*/
        overflow-y: auto;
    }
    .modal-open{
        overflow: scroll;
    }


</style>
