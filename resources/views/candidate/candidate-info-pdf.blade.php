<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
</head>
<body>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">{{ __('Candidate Info') }}</div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td>
                                Name
                            </td>
                            <td>
                                {!! $userInfo['name'] !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Email
                            </td>
                            <td>
                                {!! $userInfo['email'] !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Web Address
                            </td>
                            <td>
                                {!! $userInfo['url'] !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Cover Letter
                            </td>
                            <td>
                                {!! $userInfo['cover_letter'] !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Attachment URL
                            </td>
                            <td>
                                {!! $userInfo['attachment'] !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                IP Address
                            </td>
                            <td>
                                {!! $userInfo['ip'] !!}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
