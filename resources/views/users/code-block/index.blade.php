@extends('layouts.app')

@section('content')

    <section id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        Code Block
    </section>




@endsection
<script src="/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/javascript");
</script>