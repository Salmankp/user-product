<template>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><b>Update Profile </b></div>

                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control"
                                       aria-describedby="emailHelp" v-model="user.username"
                                       placeholder="Enter username">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control"
                                       aria-describedby="emailHelp" v-model="user.email"
                                       placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div @click="update_profile" class="col-md-3 btn btn-info">Update Profile</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "profile_view.vue",
        props:['user'],
        data() {
            return {
                reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
            }
        },
        created() {
            console.log(this.user)
        },
        mounted() {

        },
        methods:{

            update_profile()
            {
                let flag=true;
                if(this.user.username=='') {
                    flag=false;
                    return swal({
                        title: "UserName is Required",
                        text: "Please Enter Username",
                        icon: "warning",
                    });
                }
                if(this.user.email=='') {
                    flag = false;
                    return swal({
                        title: "Email is Required",
                        text: "Please Enter Email",
                        icon: "warning",
                    });
                }
                    if(!this.reg.test(this.user.email))
                    {
                        flag=false;
                        return swal({
                            title: "Email Is Invalid",
                            text: "Please Enter Valid Email Address",
                            icon: "warning",
                        });
                    }

                if(flag) {
                    axios.post('/update/profile', {
                        email:this.user.email,
                        username:this.user.username,
                        user_id:this.user.id,
                    }).then((response) => {
                        if(response.data=='success')
                        {
                            swal({
                                title: "Success",
                                text: "Profile Updated Successfully",
                                icon: "success",
                            });
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
            }


        }
    }
</script>

<style scoped>

</style>
