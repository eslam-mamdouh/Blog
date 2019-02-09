@extends('dashboard.layout')
@section('content')
   
    <button class="add_category btn btn-success" data-toggle="modal" data-target="#addCategory">Add Category</button>
    <table class="table table-hover table-bordered table-responsive-sm">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th class="actions">Actions</th>
            </tr>
            <tbody>
                @foreach ($categories as $category)    
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            <button data-value="{{$category->id}}" class="editCategoryBtn btn btn-info" data-toggle="modal" data-target="#editCategoryModal">Edit</button>
                            <form action="/dashboard/categories/{{$category->id}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </thead>
    </table>
    {{$categories->links()}}

    <div class="modal" id="addCategory">
        <div class="modal-dialog">
            <div class="modal-content">
        
            <div class="modal-header">
                <h4 class="modal-title">Add New Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/categories" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Category Name:</label>
                        <input type="text" id="categoryName" name="categoryName" class="form-control" required>
                        <span class="error">{{$errors->add->first('categoryName')}}</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        
            </div>
        </div>
    </div>
    @if ($errors->add->has('categoryName'))
        <script>
            $("#addCategory").modal();
        </script>
    @endif    

    <div class="modal" id="editCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
        
            <div class="modal-header">
                <h4 class="modal-title">Edit Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Category Name:</label>
                        <input type="text" id="categoryName" name="categoryName" class="form-control" required>
                        <span class="error">{{$errors->edit->first('categoryName')}}</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        
            </div>
        </div>
    </div>
    @if ($errors->edit->has('categoryName'))
        <script>
            $("#editCategoryModal").modal();
            editCategory({{session()->get('id')}});
        </script>
    @endif    
                     
    @if (Session::has('categoryPosts'))

    <div class="modal" id="categoryPosts">
            <div class="modal-dialog">
                <div class="modal-content">
            
                <div class="modal-header">
                    <h6 class="modal-title alert alert-danger">Delete the posts that related to this category</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                        <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th class="actions">Actions</th>
                                    </tr>
                                    <tbody>
                                        @foreach (Session::get('categoryPosts') as $categoryPost)    
                                            <tr>
                                                <td>{{$categoryPost->id}}</td>
                                                <td>{{$categoryPost->title}}</td>
                                                <td>{{$categoryPost->category->name}}</td>
                                                <td>{{$categoryPost->description}}</td>
                                                <td>
                                                    <form action="/dashboard/posts/{{$categoryPost->id}}" method="POST">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </thead>
                            </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            
                </div>
            </div>
        </div>
        <script>
            $("#categoryPosts").modal("show");
        </script>
    @endif


@endsection