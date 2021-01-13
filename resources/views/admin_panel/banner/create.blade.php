@extends('admin_panel.adminLayout') @section('content')
<script src="{{asset('js/lib/jquery.js')}}"></script>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />

<style>label.error {
  color: #a94442;
  background-color: #f2dede;
  border-color: #ebccd1;
  padding:1px 20px 1px 20px;
}
#map {
        width: 100%;
        height: 350px;
}
</style>
<div class="content-wrapper" id="loginApp">
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a style="color:green;" href="{{route('admin.products')}}">
                                < Back to List</a>
                                    <br>
                                    <br>
                                    <h4 >Create Banner</h4>
                                        <br>
                                        <div id="for_extension_error"></div>
                                        <div class="form-group">
                                            <label  >Title*</label>
                                            <input type="text" class="form-control" id="Name" name="Name"  value="" v-model="shop.name">
                                        </div>
                                        <div class="form-group">
                                                <vue-dropzone ref="myVueDropzone" :options="dropzoneOptions" :id="'productUploads'">
                                                </vue-dropzone>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label  for="Description"> Description*</label>
                                            <textarea type="textarea" class="form-control" id="Description" name="Description" v-model="shop.description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label  for="Description"> Type</label>
                                            <select class="form-control form-control-md" id="type" name="type" v-model="shop.type">
                                               <option value="main" >Main </option>
                                               <option value="shop" >shop </option>
                                            </select>
                                        </div>
                                        <div class="form-group" v-if="shop.type == 'shop'">
                                            <label  for="Category">Shops*</label>
                                            <select class="form-control form-control-md" id="Category" name="Category" v-model="cat_array" name="Categories[]" multiple="multiple">
                                                @php foreach($shops as $cat) {
                                                echo "<option value=".$cat->id." >".$cat->name." </option>"; $select_attribute=''; } @endphp
                                            </select>
                                        </div>
                                        
                                        <input type="submit" name="saveButton" class="btn btn-success mr-2" id="saveButton" value="Create" @click="saveProduct" />
                                    @if($errors->any())


                                    <ul>
                                        @foreach($errors->all() as $err)
                                        <tr>
                                            <td>
                                                <li>{{$err}}</li>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </ul>
                                    @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

  
@endsection
@section('script')
<script src="{{asset('js/app.js')}}"></script>
<script>
   
    // code from the next step will go here
    </script>
<!--JQUERY Validation-->
<script>
	const app = new Vue({
      el: '#loginApp',
      data(){
        return{
          username : '',
          password : '',
          login_error : '',
          dropzoneOptions: {
                url: 'https://httpbin.org/post',
                thumbnailWidth: 200,
                addRemoveLinks: true,
                dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>Upload banner image here"
            },
          product : {},
          cat_array : [],
          shop : {},
          lat : '',
          lng : '',
        }
      },
      mounted(){
        this.shop.type = "main";
      },
      methods : {
          saveProduct(){
            var files = this.$refs.myVueDropzone.getAcceptedFiles();
            console.log(files);
            this.shop.shops = this.cat_array;
            var formdata = new FormData();
            
            formdata.append('banner',JSON.stringify(this.shop));
            formdata.append('files_count',files.length);
            for( var i = 0; i < files.length; i++ ){
                let file = files[i];
                formdata.append('files[' + i + ']', file);
            }
                axios.post("/banner/create", formdata,{
                headers : {
                    'Content-Type': 'multipart/form-data'
                }})
                .then(response => {
                    if (response.data.message == "success") {
                        alert('shop saved successfully')
                    } else{
                      this.login_error = 'Username or password is incorrect';
                    }
                })
                .catch(error => {
                  this.login_error = 'Username or password is incorrect';
                });
          },

        login(){
          axios.post("/admin/login", {
                    username: this.username,
                    password: this.password,
                })
                .then(response => {
                    if (response.data.message == "success") {
                        location.href = "http://localhost:8000/admin_panel?token="+response.data.token;
                    } else{
                      this.login_error = 'Username or password is incorrect';
                    }
                })
                .catch(error => {
                  this.login_error = 'Username or password is incorrect';
                });
        }
      }
  });


    </script>
     
@endsection
