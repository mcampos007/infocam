@extends('layouts.app')

@section('title','Imagenes de productos')

@section('body-class','product-page')
@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
                <h2 class="title">Imagenes del Producto {{$product->name}}</h2>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="post" action="" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="file" name="photo" required>
                            <button type="submit" class="btn btn-primary btn-round">Subir Nueva Imagen</button>    
                            <a href="{{ url('/admin/products')}}" class="btn btn-default btn-round">Volver al listado de Productos</a>
                        </form > 
                    </div>    
                </div>

                <div class="row">
                    @foreach($images as $image)
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img src="{{ url($image->url )}}"  width="250">
                                <form method="post" action="">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="image_id" value="{{ $image->id}}">  
                                    <button type="submit" class="btn btn-danger btn-round">Eliminar Imágen</button>
                                    @if ($image->featured)
                                        <button class="btn btn-info btn-fab btn-fav-mini btn-round" rel="tooltip" title="Imagen destacada de este Producto">
                                                <i class="material-icons">check_circle_outline</i>                                        
                                            </button>
                                    @else
                                        <a href=" {{ url('/admin/products/'.$product->id.'/images/select/'.$image->id)}}" class="btn btn-primary btn-fab btn-fav-mini btn-round">
                                            <i class="material-icons">favorite</i>                                        
                                        </a>
                                    
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

        </div>
    </div>
</div>    

@include('includes.footer')
@endsection
