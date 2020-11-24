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
                                    <h4 >Create product</h4>
                                    <br>
                                    <vue-dropzone ref="myVueDropzone" :options="dropzoneOptions" :id="'productUploads'">
                                    </vue-dropzone>
                                    <br>
                                        <div id="for_extension_error"></div>
                                        <div class="form-group">
                                            <label  >Product Name*</label>
                                            <input type="text" class="form-control" id="Name" name="Name"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label  for="Description">Product Description*</label>
                                            <textarea type="textarea" class="form-control" id="Description" name="Description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label  for="Category">Category*</label>
                                            <select class="form-control form-control-md" id="Category" name="Category" v-model="cat_array" name="Categories[]" multiple="multiple">
                                                @php foreach($catlist as $cat) {
                                                echo "<option value=".$cat->id." >".$cat->name." </option>"; $select_attribute=''; } @endphp
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label  >Product Price*</label>
                                            <input type="text" class="form-control" name="Price" id="Price" value="">
                                        </div>
                                        <div class="form-group">
                                            <label  >Product Discounted Price*</label>
                                            <input type="text" class="form-control" id="Discounted_Price"  name="Discounted_Price" value="">
                                        </div>
                                        
                                        <div class="form-group ">
                                            <label  >Product Colors*</label>
                                            
                                            <input type="color" id="picker" class="form-control col-md-2">
                                            <br>
                                            <a onclick="addColor()" class="btn btn-sm btn-primary" >add</a>
                                            <br>
                                            <br>
                                            <div id="colors" style="border:1px solid #eee"> 
                                            </div>  
                                            <br>            
                                            <input type="text" class="form-control" id="color_list" name="Colors" value="" hidden>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label >Product Tags*</label>
                                            <input type="text" class="form-control" id="Tags" name="Tags" value="">
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
                dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>Upload product images here"
            },
          product : {},
          cat_array : [],
        }
      },
      mounted(){
        
      },
      methods : {
          saveProduct(){
            var files = this.$refs.myVueDropzone.getAcceptedFiles();
            console.log(this.cat_array);
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
