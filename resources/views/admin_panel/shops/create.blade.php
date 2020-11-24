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
                                    <h4 >Create Shop</h4>
                                        <br>
                                        <div id="for_extension_error"></div>
                                        <div class="form-group">
                                            <label  >Shop Name*</label>
                                            <input type="text" class="form-control" id="Name" name="Name"  value="" v-model="shop.name">
                                        </div>
                                        <div class="form-group">
                                                <vue-dropzone ref="myVueDropzone" :options="dropzoneOptions" :id="'productUploads'">
                                                </vue-dropzone>
                                        </div>
                                        <div class="form-group">
                                            <label  >Pick a location*</label>
                                            <div id='map'></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label  for="Description"> Description*</label>
                                            <textarea type="textarea" class="form-control" id="Description" name="Description" v-model="shop.description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label  for="Category">Category*</label>
                                            <select class="form-control form-control-md" id="Category" name="Category" v-model="cat_array" name="Categories[]" multiple="multiple">
                                                @php foreach($catlist as $cat) {
                                                echo "<option value=".$cat->id." >".$cat->name." </option>"; $select_attribute=''; } @endphp
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label  >Phone Number*</label>
                                            <input type="text" class="form-control" name="Price" id="Price" value="" v-model="shop.phone">
                                        </div>
                                        <div class="form-group">
                                            <label  >Email*</label>
                                            <input type="text" class="form-control" name="Price" id="Price" value="" v-model="shop.email">
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
                dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>Upload shop image here"
            },
          product : {},
          cat_array : [],
          shop : {},
          lat : '',
          lng : '',
        }
      },
      mounted(){
          var vm = this;
        mapboxgl.accessToken = 'pk.eyJ1Ijoic2FqZWVyb3p0cmkiLCJhIjoiY2todnh5aHJjMDQ0NzJ4bnhpN2Fyc2FiYyJ9.3bBJ9iZvnWaHkQ_4MCr2LA'; // replace this with your access token
    var map = new mapboxgl.Map({
        container: 'map',
        //   style: 'your-style-URL-here', // replace this with your style URL
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [75.78041038119704 , 11.25426243969865],
        zoom: 13.1
        });
        var marker = new mapboxgl.Marker();
        var popup = new mapboxgl.Popup({ offset: [0, -15] });

        map.on('click', function (e) {
            if(! vm.shop.name){
                alert('please select a product name');
                return;
            }
        // console.log(
        // JSON.stringify(e.lngLat.wrap()));
                console.log(e)
                var point = e.lngLat.wrap();
                vm.lat = point.lat;
                vm.lng = point.lng;
                marker.setLngLat([vm.lng, vm.lat])
                .addTo(map);
                popup.setLngLat([vm.lng, vm.lat])
                .setHTML('<h3>' + vm.shop.name + '</h3><p>freshGo authorized dealer' + '</p>')
                .addTo(map);

        });
      },
      methods : {
          saveProduct(){
            var files = this.$refs.myVueDropzone.getAcceptedFiles();
            console.log(files);
            this.shop.category = this.cat_array;
            this.shop.lat = this.lat;
            this.shop.lng = this.lng;
            var formdata = new FormData();
            
            formdata.append('shop',JSON.stringify(this.shop));
            formdata.append('files_count',files.length);
            for( var i = 0; i < files.length; i++ ){
                let file = files[i];
                formdata.append('files[' + i + ']', file);
            }
                axios.post("/shop/create", formdata,{
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
