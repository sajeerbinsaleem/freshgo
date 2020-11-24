@extends('admin_panel.adminLayout') @section('content')
<script src="{{asset('js/dist/jquery.validate.js')}}"></script>

<style>label.error {
  color: #a94442;
  background-color: #f2dede;
  border-color: #ebccd1;
  padding:1px 20px 1px 20px;
}</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a style="color:green;" href="{{url('/admin_panel/categories')}}">
                                < Back to List</a>
                                    <br>
                                    <br>
                                    <h4 >Create Shop Category</h4>
                                    @if(Session::has('message'))
                                        <h5 class="text-success">{{Session::get('message') }} </h5>
                                    @endif
                                    <br>
                                    <form  method="post"  action="{{url('/admin_panel/shop/category')}}" enctype="multipart/form-data">
                                        <input  type="file" name="file" id="inp_files"  >

                                        {{csrf_field()}}
                                        <input id="inp_img" name="img" type="hidden" value="">
                                        <br><br>
                                        <div id="for_extension_error"></div>
                                        <div class="form-group">
                                            <label  >Category Name*</label>
                                            <input type="text" class="form-control" id="name" name="name"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label  for="Description">Description*</label>
                                            <textarea type="textarea" class="form-control" id="Description" name="description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label  for="parent_id">Parent Category*</label>
                                            <select class="form-control form-control-md" id="parent_id" name="parent_id">
                                                @php foreach($catlist->all() as $cat) {
                                                echo "<option value=".$cat->id." >".$cat->name." </option>"; $select_attribute=''; } @endphp
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label  for="Category">Type*</label>
                                            <select class="form-control form-control-md" id="type" name="category_type">
                                                <option value="shop" >Main category (Shop)</option>"
                                                <option value="product" >Sub categgory (Product) </option>"
                                            </select>
                                        </div>
                                        <input type="submit" name="saveButton" class="btn btn-success mr-2"  value="Create"  />
                                    </form>
                                    @if($errors->any())


                                    <ul>
                                        @foreach($errors->all() as $err)
                                        <tr>
                                            <td>
                                                <li class="text-danger">{{$err}}</li>
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
<!--/JQUERY Validation-->    
@endsection
