@extends('dashboard.layout')
@section('content')

    <button class="add_category btn btn-success"  data-toggle="modal" data-target="#addPost">Add Post</button>
    <table class="table table-hover table-bordered table-responsive-sm">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Description</th>
                <th class="actions">Actions</th>
            </tr>
            <tbody>
                @foreach ($posts as $post)    
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->category->name}}</td>
                        <td>{{$post->description}}</td>
                        <td>
                            <button data-value="{{$post->id}}" class="d-inline editPostBtn btn btn-info"  data-toggle="modal" data-target="#editPostModal">Edit</button>
                            <form action="/dashboard/posts/{{$post->id}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button class="d-inline btn btn-danger">Delete</button>
                            </form>
                        </td>
                            
                    </tr>
                @endforeach
            </tbody>
        </thead>
    </table>
    <script src="/js/editAjax.js"></script>

    <div class="modal" id="addPost">
            <div class="modal-dialog">
                <div class="modal-content">
            
                <div class="modal-header">
                    <h4 class="modal-title">Add New Post</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="/dashboard/posts" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="title" class="form-control" required>
                            <span class="error">{{$errors->add->first('title')}}</span>
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <input type="text" name="description" class="form-control" required>
                            <span class="error">{{$errors->add->first('description')}}</span>
                        </div>
                        <div class="form-group">
                            <label>Content:</label>
                            <textarea name="content" class="form-control" required></textarea>
                            <span class="error">{{$errors->add->first('content')}}</span>
                        </div>
                        <div class="form-group">
                            <label>Category:</label>
                            <select class="form-control" name="category" required>
                                <option value="" selected>Chose Post Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            <span class="error">{{$errors->add->first('category')}}</span>
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
        
        @if ($errors->add->any())
            <script>
                $("#addPost").modal();
            </script>
        @endif    
    <div class="modal" id="editPostModal">
        <div class="modal-dialog">
            <div class="modal-content">
        
            <div class="modal-header">
                <h4 class="modal-title">Edit Post</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editPostForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" name="title" class="form-control" required>
                        <span class="error">{{$errors->edit->first('title')}}</span>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <input type="text" name="description" class="form-control" required>
                        <span class="error">{{$errors->edit->first('description')}}</span>
                    </div>
                    <div class="form-group">
                        <label>Content:</label>
                        <textarea name="content" class="form-control" required></textarea>
                        <span class="error">{{$errors->edit->first('content')}}</span>
                    </div>
                    <div class="form-group">
                        <label>Category:</label>
                        <select class="form-control" name="category" required>
                            <option value="" selected>Chose Post Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <span class="error">{{$errors->edit->first('category')}}</span>
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

    @if ($errors->edit->any())
      <script>
          $("#editPostModal").modal();
          editPost({{session()->get('id')}});
      </script>
  @endif   
@endsection