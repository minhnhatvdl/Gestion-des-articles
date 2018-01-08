@extends('layouts.master')

@section('title')
    Personal information
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/formValidation.css">
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="page-header">
                <h2>Personal information</h2>
            </div>

            <form id="defaultForm" method="post" class="form-horizontal" action="target.php">
                <div class="panel-group" id="steps">
                    <!-- Step 1 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#steps" href="#stepOne">Account</a></h4>
                        </div>
                        <div id="stepOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Name</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Email address</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Password</label>
                                    <div class="col-lg-5">
                                        <input type="password" class="form-control" name="password" value="{{ Auth::user()->password }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#steps" href="#stepTwo">Personal</a></h4>
                        </div>
                        <div id="stepTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Full name</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="firstName" placeholder="First name" />
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="lastName" placeholder="Last name" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Gender</label>
                                    <div class="col-lg-5">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" value="male" /> Male
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" value="female" /> Female
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" value="other" /> Other
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Birthday</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="birthday" placeholder="YYYY/MM/DD" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Bio</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control" name="bio" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#steps" href="#stepThree">Contact</a></h4>
                        </div>
                        <div id="stepThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Phone number</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="phoneNumber" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Street</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="street" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">City</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="city" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-9 col-lg-offset-3">
                                        <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Sign up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#defaultForm').formValidation({
        message: 'This value is not valid',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            firstName: {
                validators: {
                    notEmpty: {
                        message: 'The first name is required and cannot be empty'
                    },
                    stringCase: {
                        message: 'The first name must contain upper case characters only',
                        case: 'upper'
                    },
                    regexp: {
                        regexp: /^[A-Z\s]+$/i,
                        message: 'The first name can only consist of alphabetical characters and spaces'
                    }
                }
            },
            lastName: {
                validators: {
                    notEmpty: {
                        message: 'The last name is required and cannot be empty'
                    },
                    stringCase: {
                        message: 'The last name must contain upper case characters only',
                        case: 'upper'
                    },
                    regexp: {
                        regexp: /^[A-Z\s]+$/i,
                        message: 'The last name can only consist of alphabetical characters and spaces'
                    }
                }
            },
            name: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The name is required and cannot be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 255,
                        message: 'The name must be more than 6 and less than 255 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The name can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            email: {
                validators: {
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                    different: {
                        field: 'name',
                        message: 'The password cannot be the same as name'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required'
                    }
                }
            },
            birthday: {
                validators: {
                    date: {
                        format: 'YYYY/MM/DD',
                        message: 'The birthday is not valid'
                    }
                }
            },
            phoneNumber: {
                validators: {
                    digits: {
                        message: 'The value can contain only digits'
                    }
                }
            }
        }
    }).on('err.form.fv', function(e) {
        console.log('error');

        // Active the panel element containing the first invalid element
        var $form         = $(e.target),
            validator     = $form.data('formValidation'),
            $invalidField = validator.getInvalidFields().eq(0),
            $collapse     = $invalidField.parents('.collapse');

        $collapse.collapse('show');
    });
});
</script>
@endsection

@section('js')
    <script type="text/javascript" src="/js/formvalidation/bootstrap.js"></script>
    <script type="text/javascript" src="/js/formvalidation/formValidation.js"></script>
@stop