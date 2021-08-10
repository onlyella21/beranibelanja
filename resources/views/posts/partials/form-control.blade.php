<div class="form-group">
    <input type="file" name="thumbnail" id="thumbnail">
    @error('thumbnail')
        <div class="mt-2 text-danger">
            {{$message}}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" value="{{ old('title') ?? $post->title}}" id="title" class="form-control">
    @error('title')
        <div class="mt-2 text-danger">
            {{$message}}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="category">Category</label>
    <select name="category" class="form-control" id="category">
            <option value="0" selected disabled>- Select one -</option> 
        @foreach ($categories as $category)
            <option {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    @error('category')
        <div class="mt-2 text-danger">
            {{$message}}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="tags">Tag</label>
    <select name="tags[]"  id="tags" class="form-control selectjama" multiple >
        @foreach ($post->tags as $tag)
            <option  selected value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach

        @foreach ($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach

    </select>
    @error('tags')
        <div class="mt-2 text-danger">
            {{$message}}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="body">Body</label>
    <textarea name="body" id="body" class="form-control">{{ old('body') ?? $post->body}}</textarea>
    @error('body')
        <div class="mt-2 text-danger">
            {{$message}}
        </div>
    @enderror
</div>
    <br>
    <button type="submit" class="btn btn-primary">{{$submit ?? 'Update'}}</button>
