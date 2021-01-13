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
                                    <div class="row">
                                        <div class="col-6">
                                            <vue-dropzone ref="myVueDropzone" :options="dropzoneOptions" :id="'productUploads'">
                                            </vue-dropzone>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label  >Product Name*</label>
                                                <input type="text" class="form-control" id="Name" v-model="product.name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label  for="Category">Shop*</label>
                                                <select class="form-control form-control-md" id="Category" name="Category" v-model="shops" name="shops[]" multiple="multiple">
                                                    @php foreach($shops as $shop) {
                                                    echo "<option value=".$shop->id." >".$shop->name." </option>"; $select_attribute=''; } @endphp
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label  for="Description">Product Description*</label>
                                                <textarea type="textarea" class="form-control" v-model="product.description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label  for="Category">Category*</label>
                                                <select class="form-control form-control-md" id="Category" name="Category" v-model="cat_array" name="Categories[]" multiple="multiple">
                                                    @php foreach($catlist as $cat) {
                                                    echo "<option value=".$cat->id." >".$cat->name." </option>"; $select_attribute=''; } @endphp
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label  >Product Price*</label>
                                                <input type="text" class="form-control" v-model="product.price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row" v-for="(attribute,index) in attributes">
                                                <div class="col-5">
                                                    <input type="text" class="form-control" v-model="attribute.key">
                                                </div>
                                                <div class="col-5">
                                                    <input type="text" class="form-control" v-model="attribute.value">
                                                </div>
                                                
                                                <div class="col-1">
                                                    <a href="#" class="btn btn-sm btn-danger" @click="deleteRow(index)"><i class="mdi mdi-delete"></i></a>
                                                </div>
                                                <div class="col-1" v-if="index+1 ==  attributes.length">
                                                    <a href="#" class="btn btn-sm btn-primary" @click="addRow()"><i class="mdi mdi-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <br>
                                       
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
          login_error : '',
          dropzoneOptions: {
                url: 'https://httpbin.org/post',
                thumbnailWidth: 200,
                addRemoveLinks: true,
                dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>Upload product images here"
            },
          product : {},
          cat_array : [],
          shops :[],
          attributes : [
              {key:'size', value:''}
          ]
        }
      },
      mounted(){
        
      },
      methods : {
        addRow(){
            this.attributes.push({key:'key name', value:''});
        },
        deleteRow(index){
            this.attributes.splice(index, 1);
        },

        saveProduct(){
            if(!this.product.name){
                alert('please provide a name');
                return;

            }
            if(!this.product.price){
                alert('please provide a name');
                return;

            }
            if(this.cat_array.length <= 0){
                alert('please select category');
                return;

            }
            if(this.attributes.length <= 0){
                alert('please select attributes');
                return;

            }
            if(this.attributes.shops <= 0){
                alert('please select shops');
                return;

            }
            
            var files = this.$refs.myVueDropzone.getAcceptedFiles();
            console.log(files);
            this.product.category = this.cat_array;
            this.product.attributes = this.attributes;
            this.product.shops = this.shops;
            var formdata = new FormData();
            
            formdata.append('product',JSON.stringify(this.product));
            formdata.append('files_count',files.length);
            for( var i = 0; i < files.length; i++ ){
                let file = files[i];
                formdata.append('files[' + i + ']', file);
            }
                axios.post("/admin_panel/products/create", formdata,{
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
      }
  });


    </script>
     
@endsection
