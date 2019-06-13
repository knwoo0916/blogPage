@extends('layout/master');

@section('maincontent');
<form method="post" action="/login" style="width: 350px; height: 440px; margin:150px auto;">
  <div class="form-group">
    <label>아이디</label>
    <input type="text" class="form-control" name="id" placeholder="아이디를 입력하세요">
  </div>
  <div class="form-group">
    <label>비밀번호</label>
    <input type="password" class="form-control" name="pwd" placeholder="비밀번호를 입력하세요">
  </div>
  <button type="submit" class="btn btn-primary">로그인</button>
</form>
@endsection