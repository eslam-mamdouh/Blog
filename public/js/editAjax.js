
    function editCategory(id){
        $.ajax({
            url:"/dashboard/categories/"+id+"/edit",
            type:"get",
            dataType:"json",
            data:{'_token':'{{csrf_token()}}'}
        })
        .done(function(category){
            $("#editForm #categoryName").val(category.name);
            $("#editForm").attr("action","/dashboard/categories/"+category.id);
            
        });
    }
    function editPost(id){
        $.ajax({
            url:"/dashboard/posts/"+id+"/edit",
            type:"get",
            dataType:"json",
            data:{'_token':'{{csrf_token()}}'}
        })
        .done(function(post){
            $("#editPostForm input[name='title']").val(post.title);
            $("#editPostForm input[name='description']").val(post.description);
            $("#editPostForm textarea[name='content']").html(post.content);
            $("#editPostForm option[value='"+post.category_id+"']").attr("selected" , true);
            
            $("#editPostForm").attr("action","/dashboard/posts/"+post.id);
            
        })
    }
    $(".editCategoryBtn").click(function(e){
        console.log("skah");
        e.preventDefault();
        var categoryId = this.attributes['data-value'].nodeValue;
        editCategory(categoryId);
    });
    
    $(".editPostBtn").click(function(e){
        e.preventDefault();
        var postId = this.attributes['data-value'].nodeValue;
        editPost(postId);
    });
