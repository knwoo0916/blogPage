@extends('layout/master')

@section('maincontent')

@section('scriptsection')
<script src="/js/editor.js"></script>
@endsection
<form action="/post" method="post" style="width: 1000px; height: 600px; margin: 94px auto;">
    <div class="form-group">
        <label>제목</label>
        <input type="text" class="form-control" name="title" placeholder="제목을 입력하세요">
    </div>
    <div class="form-group">
        <label>내용</label>
        <fieldset>
            <textarea id="editor" placeholder="내용을 입력해주세요" name="content" tabindex="5"></textarea>
        </fieldset>
    </div>
    <button type="submit" class="btn btn-primary">글쓰기</button>
</form>
@endsection