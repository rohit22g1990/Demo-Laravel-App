@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3> Edit Blog </h3>
                </div>
                
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="container">
                    
                    <form method="POST" action="{{ route('update_blog', $blog->id) }}">
                        
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="email">Title</label>
                            <input type="input" class="form-control" id="title" placeholder="Enter Title" name="title" style="width:50%;" value="{{ $blog->title }}">
                            @if ($errors->has('title'))
                                <span class="help-block" style="color:red" >
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" placeholder="Enter Description" name="description" style="width:50%;">{{ $blog->description }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block" style="color:red" >
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn btn-default">Update Blog</button>
                        <a href="{{ route('home') }}" type="cancel" class="btn btn-default">Cancel</a>

                    </form>
                    <br/>
                    
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
