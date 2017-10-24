@extends('layouts.app')
@section('content')


    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=8ti9sy5hwrnyd1keswz66t0f6skecvy5wlkxwii3206xt0sp"></script>
    <script type="text/javascript">

        tinymce.init({
            selector: 'textarea',
            theme: 'modern',
            width: 745,
            height: 300,
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
            ],
            content_css: 'css/content.css',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent  | print preview media fullpage ',
        });

    </script>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Approve and Send Email</div>

                    <div class="panel-body">

                        {!! Form::model($emailtemplate, ['method' => 'POST', 'route'=>['emailtemplates.update', $emailtemplate->id], 'class' => 'form-horizontal']) !!}

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            {!! Form::label('To', 'To:', ['class'=>'col-md-3 control-label', ]) !!}
                            <div class="col-lg-9">
                                {!! Form:: !!}
                                {{--{!! Form::text('email_subject', null, ['required'], ['class' => 'form-control']) !!}--}}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Email Subject', '* Email Subject:', ['class'=>'col-md-3 control-label', ]) !!}
                            <div class="col-lg-9">
                                {!! Form::text('email_subject', null, ['required'], ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('Email Header', 'Email Header:', ['class'=>'col-md-3 control-label' ]) !!}

                            <div class="form-group">
                                <!--div class="col-lg-6"-->
                                {!! Form::text('email_header', null, ['required'], ['class' => 'form-control']) !!}
                            </div>
                        </div>


                        <div class="form-group">
                            {!! Form::label('Email Message', '* Email Message:', ['class'=>'col-md-3 control-label' ]) !!}
                        </div>

                        <div class="form-group">
                            <!--div class="col-lg-6"-->
                            {!! Form::textarea('email_message', null, ['required'], ['class' => 'col-md-4 control-label']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Email Footer', 'Email Footer:', ['class'=>'col-md-3 control-label' ]) !!}

                            <div class="form-group">
                                <!--div class="col-lg-6"-->
                                {!! Form::text('email_footer', null, ['required'], ['class' => 'form-control']) !!}
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Approve and Send', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('emailtemplates.index')}}" class="btn btn-primary">Cancel</a>

                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
