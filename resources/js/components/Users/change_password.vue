<template>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><b>Reset Password </b></div>

                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Old Password</label>
                                <input type="password" class="form-control"
                                       aria-describedby="emailHelp" v-model="old_password"
                                       placeholder="Enter old Password">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control"
                                       aria-describedby="emailHelp" v-model="password"
                                       placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="col-md-12" >
                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                <input type="password" class="form-control"
                                       aria-describedby="emailHelp" v-model="confirm_password"
                                       placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div @click="update_password" class="col-md-3 btn btn-info">Update Password</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "change_password.vue",
        props:['user'],
        data() {
            return {
                password:'',
                confirm_password:'',
                old_password:'',
            }
        },
        created() {

        },
        mounted() {

        },
        methods:{

            update_password()
           {
               let flag=true;
               if(this.old_password=='') {
                   flag=false;
                   return swal({
                       title: "Old Password is Required",
                       text: "Please Enter Old Password Field",
                       icon: "warning",
                   });
               }
               if(this.password=='') {
                   flag=false;
                   return swal({
                       title: "Password is Required",
                       text: "Please Enter Password Field",
                       icon: "warning",
                   });
               }
               if(this.confirm_password=='') {
                   flag=false;
                   return swal({
                       title: "Confirm Password is Required",
                       text: "Please Enter Confirm Password Field",
                       icon: "warning",
                   });
               }
               if(this.password!=this.confirm_password || this.confirm_password!==this.password)
               {
                   flag=false;
                   return swal({
                       title: "Password Fields do not match",
                       text: "Both Fields should be Same",
                       icon: "warning",
                   });
               }

               if(flag) {
                   axios.post('/update/password', {
                       password: this.password,
                       confirm_password: this.confirm_password,
                       old_password:this.old_password,
                       user: this.user,
                   }).then((response) => {
                       if(response.data=='success')
                       {
                           swal({
                               title: "Success",
                               text: "Password Updated Successfully",
                               icon: "success",
                           });
                           this.password='';
                           this.confirm_password='';
                           this.old_password='';
                       }
                       if(response.data=='error')
                       {
                           swal({
                               title: "error",
                               text: "Old Password do not match",
                               icon: "error",
                           });
                       }

                   })
               }
           }


        }
    }
</script>

<style scoped>

</style>
